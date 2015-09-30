define('zfegg/controller/user',
    [
        'require',
        'zfegg/model/view',
        'zfegg/config',
        'zfegg/kendo/restful-data-source'
    ],
    function(req, View, config, Restful) {
        'use strict';

        var restUrl = config.baseUrl + '/roles';

        return new View(
            req.toUrl('./role.html'),
            {
                model: {
                    dataSource: new Restful({
                        url: restUrl,
                        schema: {
                            model: {
                                id: "role_id",
                                fields: {
                                    role_id: {type: "number", editable: false, nullable: true},
                                    name: {validation: {required: true}},
                                    parent: {type: "number", validation: {required: true}},
                                    create_time: {defaultValue: null, editable: false}
                                }
                            }
                        }
                    })
                }
            }
        );
    });