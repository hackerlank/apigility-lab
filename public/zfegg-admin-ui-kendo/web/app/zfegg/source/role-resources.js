define('zfegg/source/role-resources',
    [
        'jquery',
        'kendo',
        'zfegg/config',
        'zfegg/kendo/restful-data-source',
        'zfegg/source/resources'
    ],
    function($, kendo, config, Restful, resources) {
        'use strict';

        var Assigner = function (role) {
            var self = this;
            var url = config.baseUrl + '/roles/' + role.role_id + '/resources';
            var assignerSource = new Restful({
                url:  url,
                transport: {
                    destroy: {
                        url: function (e) {
                            return url + "/" + e['resource'];
                        }
                    }
                },
                schema: {
                    parse: function (response) {
                        if (response._embedded && response._embedded.role_resources) {
                            var data = response._embedded.role_resources;

                            $.map(data, function (o) {
                                o.non_id = kendo.guid();
                                return o;
                            });

                            data.non_id = kendo.guid();
                            return data;
                        }

                        return response;
                    },
                    model: {
                        id: "non_id",
                        fields: {
                            non_id: {},
                            role_id: {},
                            name: {},
                            parent_id: {}
                        }
                    }
                }
            });

            var flatData = [];
            var hierarchicalDataSource = new kendo.data.HierarchicalDataSource({
                transport: {
                    read: function(options) {
                        var id = options.data.role_id || 0;

                        self.dataSource.promise().then(function () {

                            resources.promise().then(function () {
                                flatData = resources.data().toJSON();

                                $.map(flatData, function(x) {
                                    if (self.getByResource(x.resource)) {
                                        x.checked = true;
                                    }
                                    return x;
                                });
                                options.success($.grep(flatData, function(x) {
                                    return x.parent_id == id;
                                }));
                            });
                        });
                    }
                },
                schema: {
                    parse: function(response) {
                        return $.map(response, function(x) {
                            x.expanded = true;
                            return x;
                        });
                    },
                    model: {
                        id: "role_id",
                        hasChildren: function(x) {
                            var id = x.role_id;

                            for (var i = 0; i < flatData.length; i++) {
                                if (flatData[i].parent_id == id) {
                                    return true;
                                }
                            }
                            return false;
                        }
                    }
                }
            });

            this.dataSource = assignerSource;
            this.hierarchicalDataSource = hierarchicalDataSource;
        };

        Assigner.prototype.assign = function (resourceItem) {
            if (resourceItem.checked) {
                this.dataSource.add({resource: resourceItem.resource});
            } else {
                var item = this.getByResource(resourceItem.resource);
                this.dataSource.remove(item);
            }
            return this.dataSource.sync();
        };

        Assigner.prototype.getByResource = function (resource) {
            return this.dataSource.data().find(function (m) {return m.resource == resource;});
        };

        Assigner.prototype.fetchItems = function (callback) {

            var httpOptions = {
                'POST'   : '增',
                'DELETE' : '删',
                'PUT'    : '改',
                'PATCH'  : '改',
                'GET'    : '查'
            };

            var self = this;
            self.dataSource.promise().then(function () {

                resources.promise().then(function () {
                    var data = resources.data().toJSON();

                    $.map(data, function(x) {
                        var privileges = [];
                        $.each(x.privileges, function (i, privilege) {
                            privileges.push(httpOptions[privilege]);
                        });
                        privileges = $.unique(privileges);




                        if (self.getByResource(x.resource)) {
                            x.checked = true;
                        }
                        return x;
                    });
                });
            });

            callback(items);
            return this.dataSource.data().find(function (m) {return m.role_id == resource;});
        };

        return Assigner;
    });