define('zfegg/source/resources',
    [
        'kendo',
        'zfegg/config',
        'zfegg/kendo/restful-data-source'
    ],
    function(kendo, config, Restful) {
        'use strict';

        var restUrl = config.baseUrl + '/resources';
        return new Restful({
            url: restUrl,
            schema: {
                model: {
                    id: "resource",
                    fields: {
                        resource: {type: "string", editable: false},
                        description: {},
                        privileges: {}
                    }
                }
            }
        });
    });