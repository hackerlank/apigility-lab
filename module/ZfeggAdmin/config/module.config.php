<?php
return array(
    'zf-versioning' => array(
        'default_version' => 1,
        'uri' => array(
            3 => 'zfegg-admin.rest.resources',
            4 => 'zfegg-admin.rest.role-resources',
            5 => 'zfegg-admin.rest.user-roles',
            7 => 'zfegg-admin.rest.oauth-clients',
            8 => 'zfegg-admin.rest.menus',
            9 => 'zfegg-admin.rpc.profile',
            0 => 'zfegg-admin.rest.admin-user',
            10 => 'zfegg-admin.rest.admin-role',
            11 => 'zfegg-admin.rpc.app',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zfegg-admin.rest.resources' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/resources[/:resource]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\Resources\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rest.role-resources' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/roles/:role_id/resources[/:resource]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rest.user-roles' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users/:user_id/roles[/:role_id]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rest.oauth-clients' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/clients[/:client_id]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rest.menus' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/menus[/:menu_id]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\Menus\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rpc.profile' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/profile[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller',
                        'action' => 'index',
                    ),
                ),
            ),
            'zfegg-admin.rest.admin-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:user_id]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rest.admin-role' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/roles[/:role_id]',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller',
                    ),
                ),
            ),
            'zfegg-admin.rpc.app' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'ZfeggAdmin\\V1\\Rpc\\App\\Controller',
                        'action' => 'app',
                    ),
                ),
            ),
        ),
    ),
    'zf-rest' => array(
        'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesResource',
            'route_name' => 'zfegg-admin.rest.resources',
            'route_identifier_name' => 'resource',
            'collection_name' => 'resources',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesCollection',
            'service_name' => 'Resources',
        ),
        'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesResource',
            'route_name' => 'zfegg-admin.rest.role-resources',
            'route_identifier_name' => 'resource',
            'collection_name' => 'role_resources',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
                2 => 'PUT',
                3 => 'PATCH',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesCollection',
            'service_name' => 'RoleResources',
        ),
        'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesResource',
            'route_name' => 'zfegg-admin.rest.user-roles',
            'route_identifier_name' => 'role_id',
            'collection_name' => 'user_roles',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesCollection',
            'service_name' => 'UserRoles',
        ),
        'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsResource',
            'route_name' => 'zfegg-admin.rest.oauth-clients',
            'route_identifier_name' => 'client_id',
            'collection_name' => 'oauth_clients',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsCollection',
            'service_name' => 'oauth_clients',
        ),
        'ZfeggAdmin\\V1\\Rest\\Menus\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\Menus\\MenusResource',
            'route_name' => 'zfegg-admin.rest.menus',
            'route_identifier_name' => 'menu_id',
            'collection_name' => 'menus',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\Menus\\MenusEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\Menus\\MenusCollection',
            'service_name' => 'Menus',
        ),
        'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserResource',
            'route_name' => 'zfegg-admin.rest.admin-user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'admin_user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserCollection',
            'service_name' => 'admin_user',
        ),
        'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller' => array(
            'listener' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleResource',
            'route_name' => 'zfegg-admin.rest.admin-role',
            'route_identifier_name' => 'role_id',
            'collection_name' => 'admin_role',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleEntity',
            'collection_class' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleCollection',
            'service_name' => 'admin_role',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rest\\Menus\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => 'Json',
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller' => 'HalJson',
            'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\Menus\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
                3 => 'application/x-www-form-urlencoded',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => array(
                0 => 'text/html',
                1 => 'application/xhtml+xml',
                2 => 'application/xml',
            ),
        ),
        'content_type_whitelist' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\Menus\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
            'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => array(
                0 => 'application/vnd.zfegg-admin.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesEntity' => array(
                'entity_identifier_name' => 'resource',
                'route_name' => 'zfegg-admin.rest.resources',
                'route_identifier_name' => 'resource',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesCollection' => array(
                'entity_identifier_name' => 'resource',
                'route_name' => 'zfegg-admin.rest.resources',
                'route_identifier_name' => 'resource',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesEntity' => array(
                'entity_identifier_name' => 'resource',
                'route_name' => 'zfegg-admin.rest.role-resources',
                'route_identifier_name' => 'resource',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesCollection' => array(
                'entity_identifier_name' => 'resource',
                'route_name' => 'zfegg-admin.rest.role-resources',
                'route_identifier_name' => 'resource',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesEntity' => array(
                'entity_identifier_name' => 'role_id',
                'route_name' => 'zfegg-admin.rest.user-roles',
                'route_identifier_name' => 'role_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesCollection' => array(
                'entity_identifier_name' => 'role_id',
                'route_name' => 'zfegg-admin.rest.user-roles',
                'route_identifier_name' => 'role_id',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsEntity' => array(
                'entity_identifier_name' => 'client_id',
                'route_name' => 'zfegg-admin.rest.oauth-clients',
                'route_identifier_name' => 'client_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsCollection' => array(
                'entity_identifier_name' => 'client_id',
                'route_name' => 'zfegg-admin.rest.oauth-clients',
                'route_identifier_name' => 'client_id',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\Menus\\MenusEntity' => array(
                'entity_identifier_name' => 'menu_id',
                'route_name' => 'zfegg-admin.rest.menus',
                'route_identifier_name' => 'menu_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\Menus\\MenusCollection' => array(
                'entity_identifier_name' => 'menu_id',
                'route_name' => 'zfegg-admin.rest.menus',
                'route_identifier_name' => 'menu_id',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserEntity' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'zfegg-admin.rest.admin-user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserCollection' => array(
                'entity_identifier_name' => 'user_id',
                'route_name' => 'zfegg-admin.rest.admin-user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleEntity' => array(
                'entity_identifier_name' => 'role_id',
                'route_name' => 'zfegg-admin.rest.admin-role',
                'route_identifier_name' => 'role_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleCollection' => array(
                'entity_identifier_name' => 'role_id',
                'route_name' => 'zfegg-admin.rest.admin-role',
                'route_identifier_name' => 'role_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsResource' => array(
                'adapter_name' => 'ZfeggOauth',
                'table_name' => 'oauth_clients',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller',
                'entity_identifier_name' => 'client_id',
                'table_service' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\OauthClientsResource\\Table',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserResource' => array(
                'adapter_name' => 'ZfeggAdmin',
                'table_name' => 'admin_user',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller',
                'entity_identifier_name' => 'user_id',
                'table_service' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\AdminUserResource\\Table',
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleResource' => array(
                'adapter_name' => 'ZfeggAdmin',
                'table_name' => 'admin_role',
                'hydrator_name' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller',
                'entity_identifier_name' => 'role_id',
                'table_service' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\AdminRoleResource\\Table',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\Resources\\Validator',
        ),
        'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\Validator',
        ),
        'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\Validator',
        ),
        'ZfeggAdmin\\V1\\Rest\\OauthClients\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\OauthClients\\Validator',
        ),
        'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\AdminUser\\Validator',
        ),
        'ZfeggAdmin\\V1\\Rest\\AdminRole\\Controller' => array(
            'input_filter' => 'ZfeggAdmin\\V1\\Rest\\AdminRole\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'ZfeggAdmin\\V1\\Rest\\AdminUser\\Validator' => array(
            0 => array(
                'name' => 'account',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'ZF\\ContentValidation\\Validator\\DbNoRecordExists',
                        'options' => array(
                            'adapter' => 'ZfeggAdmin',
                            'table' => 'admin_user',
                            'field' => 'account',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '255',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    2 => array(
                        'name' => 'ZfeggAdmin\\Filter\\Bcrypt',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '255',
                        ),
                    ),
                ),
            ),
            2 => array(
                'name' => 'real_name',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '255',
                        ),
                    ),
                ),
            ),
            3 => array(
                'name' => 'email',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '255',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
            ),
            4 => array(
                'name' => 'status',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
            5 => array(
                'name' => 'create_time',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
        'ZfeggAdmin\\V1\\Rest\\AdminRole\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'ZF\\ContentValidation\\Validator\\DbNoRecordExists',
                        'options' => array(
                            'adapter' => 'ZfeggAdmin',
                            'table' => 'admin_role',
                            'field' => 'name',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '30',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'parent_id',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\Digits',
                    ),
                ),
                'validators' => array(),
            ),
        ),
        'ZfeggAdmin\\V1\\Rest\\Resources\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'resource',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'methods',
            ),
        ),
        'ZfeggAdmin\\V1\\Rest\\RoleResources\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'resource',
            ),
            1 => array(
                'required' => true,
                'type' => 'Zend\\InputFilter\\ArrayInput',
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\InArray',
                        'options' => array(
                            'haystack' => array(
                                0 => 'GET',
                                1 => 'POST',
                                2 => 'PUT',
                                3 => 'PATCH',
                                4 => 'DELETE',
                            ),
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'StringToUpper',
                    ),
                ),
                'name' => 'methods',
                'description' => '权限',
            ),
        ),
        'ZfeggAdmin\\V1\\Rest\\UserRoles\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\ToInt',
                        'options' => array(),
                    ),
                ),
                'name' => 'role_id',
            ),
            1 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
            2 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\ToInt',
                        'options' => array(),
                    ),
                ),
                'name' => 'parent',
            ),
        ),
        'ZfeggAdmin\\V1\\Rest\\OauthClients\\Validator' => array(
            0 => array(
                'name' => 'client_secret',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                    2 => array(
                        'name' => 'ZfeggAdmin\\Filter\\Bcrypt',
                        'options' => array(),
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '80',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'redirect_uri',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '2000',
                        ),
                    ),
                ),
            ),
            2 => array(
                'name' => 'grant_types',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '80',
                        ),
                    ),
                ),
            ),
            3 => array(
                'name' => 'scope',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '2000',
                        ),
                    ),
                ),
            ),
            4 => array(
                'name' => 'user_id',
                'required' => false,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '255',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => array(
                'actions' => array(
                    'profile' => array(
                        'GET' => true,
                        'POST' => true,
                        'PUT' => true,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
            'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => array(
                'actions' => array(
                    'App' => array(
                        'GET' => false,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
            'ZfeggAdmin\\V1\\Rest\\AdminUser\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesResource' => 'ZfeggAdmin\\V1\\Rest\\Resources\\ResourcesResourceFactory',
            'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesResource' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesResourceFactory',
            'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesResource' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesResourceFactory',
            'ZfeggAdmin\\V1\\Rest\\Menus\\MenusResource' => 'ZfeggAdmin\\V1\\Rest\\Menus\\MenusResourceFactory',
        ),
    ),
    'zf-rpc' => array(
        'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => array(
            'service_name' => 'profile',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
                2 => 'PUT',
            ),
            'route_name' => 'zfegg-admin.rpc.profile',
        ),
        'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => array(
            'service_name' => 'App',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'zfegg-admin.rpc.app',
        ),
    ),
    'zf-oauth2' => array(
        'user_id' => 'user_id',
    ),
    'controllers' => array(
        'invokables' => array(
            'ZfeggAdmin\\V1\\Rpc\\App\\Controller' => 'ZfeggAdmin\\V1\\Rpc\\App\\AppController',
            'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller' => 'ZfeggAdmin\\V1\\Rpc\\Profile\\ProfileController',
        ),
    ),
    'zfegg-admin' => array(
        'ui_modules' => array(),
        'menus' => array(
            0 => array(
                'text' => '系统',
                'index' => 0,
                'expanded' => true,
                'items' => array(
                    0 => array(
                        'text' => '用户管理',
                        'index' => 0,
                        'url' => '#/zfegg/admin/user',
                    ),
                    1 => array(
                        'text' => '角色管理',
                        'index' => 1,
                        'url' => '#/zfegg/admin/role',
                    ),
                    2 => array(
                        'text' => '权限列表',
                        'index' => 2,
                        'url' => '#/zfegg/admin/resource',
                    ),
                    3 => array(
                        'text' => '个人信息',
                        'index' => 4,
                        'url' => '#/zfegg/admin/profile',
                    ),
                ),
            ),
            1 => array(
                'text' => '模型管理',
                'expanded' => true,
                'items' => array(
                    0 => array(
                        'text' => '数据源添加',
                        'index' => 0,
                        'url' => '/model-manager/data-source-config/add',
                    ),
                    1 => array(
                        'text' => '数据源管理',
                        'index' => 0,
                        'url' => '/model-manager/data-source-config/index',
                    ),
                    2 => array(
                        'text' => '模型UI配置',
                        'index' => 1,
                        'url' => '/ui/model-manager/ui-config/index',
                    ),
                    3 => array(
                        'text' => '模型UI列表',
                        'index' => 1,
                        'url' => '/ui/model-manager/ui-config/list',
                    ),
                    4 => array(
                        'text' => '菜单配置',
                        'url' => '/model-manager/source/view/id/4',
                    ),
                    5 => array(
                        'text' => '数据源权限',
                        'url' => './model-manager/source/view/id/2',
                    ),
                ),
            ),
        ),
    ),
);
