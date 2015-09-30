<?php
return array(
    'router'             => array(
        'routes' => array(
            'zfegg-auth.controller.login' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'ZfeggAuth\Controller\Login',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),
    ),
    'service_manager'    => array(
        'aliases'   => array(
            'authentication' => 'Zend\Authentication\AuthenticationService',
            'ZfeggAuth\RoleResourceTable' => 'ZfeggAdmin\V1\Rest\AdminRole\AdminRoleResource\Table',
            'ZfeggAuth\UserRolesResource' => 'ZfeggAdmin\\V1\\Rest\\UserRoles\\UserRolesResource',
            'ZfeggAuth\RoleResourcesResource' => 'ZfeggAdmin\\V1\\Rest\\RoleResources\\RoleResourcesResource',
        ),
        'factories' => array(
            'ZF\MvcAuth\Authorization\AclAuthorization' => 'ZF\MvcAuth\Factory\AclAuthorizationFactory',
            'ZfeggAuth\AuthenticationAdapter' => 'ZfeggAuth\Factory\AuthenticationAdapterFactory',
            'ZfeggAuth\Acl' => 'ZfeggAuth\Factory\AclAuthorizationFactory',

            'ZF\MvcAuth\Authorization\DefaultResourceResolverListener' => 'ZF\MvcAuth\Factory\DefaultResourceResolverListenerFactory',
        ),
        'invokables' => array(
            'ZfeggAuth\AuthListener' => 'ZfeggAuth\AuthListener',
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'ZfeggAuth\Controller\Login' => 'ZfeggAuth\Controller\LoginControllerFactory',
        ),
    ),

//    'form_elements' => array(
//        'abstract_factories' => array(
//            'Zend\Form\FormAbstractServiceFactory',
//        ),
//    ),

    'input_filter_specs' => array(
        'ZfeggAuth\Login' => array(
            array(
                'required'   => true,
                'validators' => array(
                    0 => array(
                        'name'    => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                ),
                'filters'    => array(
                    0 => array(
                        'name'    => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                    1 => array(
                        'name'    => 'Zend\\Filter\\StringToLower',
                        'options' => array(),
                    ),
                ),
                'name'       => 'username',
            ),
            array(
                'required'   => true,
                'validators' => array(),
                'filters'    => array(),
                'name'       => 'password',
            ),
        ),
    ),

    'forms' => array(
        'ZfeggAuth\Login' => array(
//            'hydrator' => 'ObjectProperty',
            'type'     => 'Zend\Form\Form',
            'elements' => array(
                array(
                    'spec' => array(
                        'type' => 'Zend\Form\Element\Text',
                        'name' => 'username',
                        'options' => array(
                            'label' => 'Username',
                        ),
                    ),
                ),
                array(
                    'spec' => array(
                        'type' => 'Zend\Form\Element\Password',
                        'name' => 'password',
                        'options' => array(
                            'label' => 'Password',
                        ),
                    ),
                ),
            ),
            'input_filter' => array(
                array(
                    'required'   => true,
                    'validators' => array(
                        array(
                            'name'    => 'Zend\\I18n\\Validator\\Alnum',
                            'options' => array(),
                        ),
                    ),
                    'filters'    => array(
                        array(
                            'name'    => 'Zend\\Filter\\StringTrim',
                            'options' => array(),
                        ),
                        array(
                            'name'    => 'Zend\\Filter\\StringToLower',
                            'options' => array(),
                        ),
                    ),
                    'name'       => 'username',
                ),
                array(
                    'required'   => true,
                    'validators' => array(),
                    'filters'    => array(),
                    'name'       => 'password',
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'zfegg-auth' => array(
        'authentication' => array(
            'adapter' => 'ZfeggOauth',
            'table' => 'oauth_users',
            'identity_column' => 'username',
            'credential_column' => 'password',
        ),
        'user_id' => 'user_id',
    ),
);