define(function() {
    'use strict';

    requirejs.config({
        //By default load any module IDs from js/lib
        baseUrl: 'app',
        //except, if the module ID starts with "app",
        //load it from the js/app directory. paths
        //config is relative to the baseUrl, and
        //never includes a ".js" extension since
        //the paths config could be for a directory.
        paths: {
            "jquery": "../../bower_components/jquery/dist/jquery.min",
            "kendo": "../../libs/kendo/js/kendo.web.min"
        },
        shim: {
            'kendo': {
                deps: ['jquery']
            }
        }
    });

    require([
        'jquery',
        'kendo',
        'zfegg/config'
    ], function($, kendo, config) {

        var $panel = $("#left-panel"), $tabs = $("#main-tabs");
        var viewModel = kendo.observable({
            onSelectPanel: function(e) {
                e.preventDefault();

                var $item = $(e.item);
                var kTabStrip = $tabs.data('kendoTabStrip');

                if (!$item.has('ul').size()) {
                    var $a = $item.find('a'), title = $a.html();
                    var ctrl = $a.attr('href').replace(/^\/+/, '').replace(/\/+$/, '');

                    if ($item.data('zfegg.tab')) {
                        kTabStrip.activateTab($item.data('zfegg.tab'));
                    } else {
                        require([ctrl], function (view) {
                            if (typeof(view.render) == 'function') {
                                view.render(function ($container) {
                                    kTabStrip.append([{
                                        text: title,
                                        content: ''
                                    }]).activateTab('li:last');

                                    var li = kTabStrip.items()[kTabStrip.items().length-1];
                                    var $tabContent = $(kTabStrip.contentElement(kTabStrip.items().length-1));
                                    $tabContent.empty();
                                    $tabContent.append($container);

                                    $item.data('zfegg.tab', li);
                                });
                            }
                        });
                    }
                }

            },
            onSelectTabstrip: function(e) {
                //console.log('onSelectTabstrip');
            }
        });
        kendo.bind(document.body, viewModel);

        var url = config.baseUrl;
        var menus = new kendo.data.DataSource({
            autoSync: true,
            transport: {
                read:  {
                    url: url + "/profile/menus",
                    type: "GET"
                }
            }
        });
        menus.fetch(function () {
            $("#left-panel").data('kendoPanelBar').append(menus.data().toJSON());
        });

        $.ajaxSetup({
            error: function (xhr) {
                if (xhr.responseJSON) {
                    require(['zfegg/ui/notification'], function (notification) {
                        notification.error('<span>错误('+ xhr.status +'): '+xhr.statusText + '</span><br />'+xhr.responseJSON.detail);
                    });
                }
            }
        });
    });
});
define('zfegg/ui/notification', ['jquery', 'kendo'], function($) {
    'use strict';
    return $('#notification').data('kendoNotification');
});