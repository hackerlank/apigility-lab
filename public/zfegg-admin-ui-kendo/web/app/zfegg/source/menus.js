define('zfegg/source/menus', ['kendo', 'zfegg/config'], function(kendo, config) {
    'use strict';

    var url = config.baseUrl;

    return new kendo.data.DataSource({
        autoSync: true,
        transport: {
            read:  {
                url: url + "/profile/menus",
                type: "GET"
            }
        }
    });
});