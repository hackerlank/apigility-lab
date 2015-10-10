define('zfegg/controller/role',
    [
        'require',
        'zfegg/model/view',
        'zfegg/config',
        'zfegg/kendo/restful-data-source',
        'zfegg/source/roles',
        'zfegg/source/role-resources',
        'zfegg/kendo/binder-window-center'
    ],
    function (req, View, config, Restful, roles, RoleResourcesAssigner) {
        'use strict';

        var restUrl = config.baseUrl + '/roles';

        var kGrid;
        return new View(
            req.toUrl('./role.html'),
            {
                model: {
                    roles: roles.hierarchicalDataSource,
                    isAssignDisabled: true,
                    isVisible: true,
                    selectedNode: null,
                    onSelect: function (e) {
                        var kTree = e.sender.element.data('kendoTreeView');
                        this.selectedNode = kTree.dataItem(e.node);
                        this.set('isAssignDisabled', false);
                    },
                    onClickAssign: function (e) {

                        console.log('onClickAssign', this, e, this.selectedNode);

                        var resourcesAssigner = new RoleResourcesAssigner(this.selectedNode);

                        var view = new View(
                            req.toUrl('./assign-resource.html'),
                            {
                                model: {
                                    isVisible: true,
                                    onCheckResource: function (e) {
                                        var role = e.sender.dataItem(e.node);
                                        resourcesAssigner.assign(role);
                                    },
                                    onWindowClose: function (e) {
                                        e.sender.destroy();
                                    }
                                },
                                init: function (e) {
                                    var $tree = e.sender.element.find('[data-role=treeview]'),
                                        kTree = $tree.data('kendoTreeView');

                                    resourcesAssigner.fetchItems(function (items) {
                                        kTree.setDataSource(items);
                                    });
                                }
                            }
                        );

                        view.render();

                    }
                },
                init: function () {
                    var $tree = this.element.children('[data-role=treeview]'),
                        kTree = $tree.data('kendoTreeView');

                    kTree.options.template = kendo.template('<span>#:item.name#</span>  <span class="k-icon k-add"></span> <span class="k-icon k-delete"></span>');

                    $tree.on('click', '.k-delete', function () {
                        var node  = $(this).closest('.k-item'),
                            item = kTree.dataItem(node),
                            nodes = node.find('.k-item').andSelf();

                        nodes.each(function () {
                            var n = roles.dataSource.get(kTree.dataItem(this).role_id);
                            if (n) {
                                roles.dataSource.remove(n);
                            } else {
                                console.log(item, n);
                            }
                        });
                        roles.dataSource.sync().then(function () {
                            kTree.remove(node);
                        });
                    });

                    $tree.on('click', '.k-add', function () {
                        var node  = $(this).closest('.k-item'),
                            item = kTree.dataItem(node),
                            name;

                        if (name = window.prompt('请输入角色名')) {
                            roles.dataSource.add({name: name, parent_id: item.role_id});
                            roles.dataSource.sync().then(function () {
                                var newItem = roles.dataSource.data().slice(-1)[0];
                                kTree.append(newItem.toJSON(), node);
                            });
                        }
                    });
                }
            }
        );
    });