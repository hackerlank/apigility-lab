define('zfegg/kendo/restful-data-source', ['kendo'], function (kendo) {

    var MIME_JSON = 'application/json';

    var defaultsSchema = {
        data: function (d) {
            if (d._embedded) {  //GET
                if (this.dataKey) {
                    return d._embedded[this.dataKey];
                } else {
                    for (var i in d._embedded) {
                        return d._embedded[i];
                    }
                }
            } else { //POST && PUT
                return d;
            }
        },
        dataKey: null,
        total: 'total_items'
    };

    var DataSource = kendo.data.DataSource.extend({
        init: function (options) {
            var primary = (options.schema.model && options.schema.model.id) || 'id';
            var extendTransport1 = {read: {url: options.url}, create: {url: options.url}};
            var extendTransport2 = {
                read: {
                    url: null,
                    type: "GET",
                    dataType: "json"
                },
                create: {
                    url:  null,
                    type: "POST",
                    dataType: "json",
                    contentType: MIME_JSON
                },
                update: {
                    url: function (e) {
                        return options.url + "/" + e[primary];
                    },
                    type: "PUT",
                    dataType: "json",
                    contentType: MIME_JSON
                },
                destroy: {
                    url: function (e) {
                        return options.url + "/" + e[primary];
                    },
                    type: "DELETE",
                    dataType: "json",
                    contentType: MIME_JSON
                },
                parameterMap: function (options, operation) {
                    if (operation == 'create' || operation == 'update' || operation == 'destroy') {
                        return JSON.stringify(options);
                    }

                    return options;
                }
            };

            options.schema = $.extend(defaultsSchema, options.schema || {});
            options.transport = $.extend(extendTransport1, options.transport || {});
            options.transport = $.extend(true, extendTransport2, options.transport);

            console.log(options);
            kendo.data.DataSource.fn.init.call(this, options);
        },
        promise: function () {
            if (!this._promiseCaller) {
                this._promiseCaller = this.fetch();
            }

            return this._promiseCaller;
        },
        _promiseCaller: null
    });

    DataSource.gridErrorStatusListener = function (e, kGrid) {
        if (e.xhr.status == 422 && e.xhr.responseJSON && e.xhr.responseJSON.validation_messages) {
            var v = kGrid.editable.element.data('kendoValidator');
            var messages = e.xhr.responseJSON.validation_messages;

            for (var name in messages) {
                var input = v.element.find('[name='+name+']');

                for (var errorKey in messages[name]) {
                    var msg = messages[name][errorKey];
                    $(kendo.template(v.options.errorTemplate)({message: msg})).insertAfter(input);
                    input.focus();
                }
            }
        }
    };

    return DataSource;
});