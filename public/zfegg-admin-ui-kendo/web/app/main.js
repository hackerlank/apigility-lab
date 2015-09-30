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
        'zfegg/config',
        'zfegg/model/view',
        //'zfegg/source/roles',
        //'zfegg/source/user-roles',
        'require'
    ], function($, kendo, config, View, roles, userRoles) {

        //roles.dataSource.promise();
        //var s = (new userRoles({user_id:1}));
        //$('#treeview').kendoTreeView({
        //    dataSource: s.hierarchicalDataSource,
        //    dataTextField: 'name'
        //});
        ////roles.hierarchicalDataSource.fetch(function () {
        ////    console.log(this.data());
        ////});
        //
        //s.promise().then(function () {
        //    console.log('roles loaded');
        //});
        //console.log(s);
        //
        //return ;

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
                console.log('onSelectTabstrip');
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
        //
        //tabs.init();
        //
        //menus.fetch(function () {
        //    var panel = $("#left-panel").kendoPanelBar({
        //        dataSource: menus.data().toJSON(),
        //        select: function (e) {
        //            e.preventDefault();
        //
        //            var $item = $(e.item);
        //            if (!$item.has('ul').size()) {
        //                var $a = $item.find('a');
        //                if (/^##\w/i.test($a.attr('href'))) {
        //                    var href = $a.attr('href').substr(2);
        //
        //                    if ($item.data('zfegg.tab')) {
        //                        tabs.$el.activateTab($item.data('zfegg.tab'));
        //                    } else {
        //                        require([href], function (view) {
        //                            if (typeof(view.render) == 'function') {
        //                                view.render();
        //                            }
        //
        //                            $item.data('zfegg.tab');
        //                        });
        //                    }
        //
        //
        //                }
        //            }
        //        }
        //    });
        //    var kPanel = panel.data('kendoPanelBar');
        //});

    });
});
