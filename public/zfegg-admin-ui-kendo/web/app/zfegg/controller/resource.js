define('zfegg/controller/resource',
    [
        'require',
        'zfegg/model/view',
        'zfegg/config',
        'zfegg/source/resources'
    ],
    function (req, View, config, resources) {
        'use strict';

        return new View(
            req.toUrl('./resource.html'),
            {
                model: {
                    dataSource: resources
                }
            }
        );
    });