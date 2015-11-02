<?php
return array(
    'service_manager'    => array(
        'invokables' => array(
            'Zfegg\Admin\MvcAuth\Authorization\ResourceAssertion' => 'Zfegg\Admin\MvcAuth\Authorization\ResourceAssertion',
        ),
    ),

    'zf-oauth2' => array(
        'user_id' => 'user_id',
    ),

    'zfegg-admin-mvc-auth' => array(
        'role_whitelists' => array(
            '*' => array(
                'ZfeggAdmin\\V1\\Rpc\\Profile\\Controller::*' => array(),
            ),
        ),
    ),
);