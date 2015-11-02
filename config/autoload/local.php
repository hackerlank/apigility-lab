<?php
return array(
    'zf-mvc-auth' => array(
        'authentication' => array(
            'adapters' => array(
                'users' => array(
                    'adapter' => 'ZF\\MvcAuth\\Authentication\\OAuth2Adapter',
                    'storage' => array(
                        'adapter' => 'pdo',
                        'dsn' => 'mysql:dbname=zfegg-oauth;host=192.168.39.18;charset=utf8',
                        'route' => '/oauth',
                        'username' => 'root',
                        'password' => 'ztgame@123',
                        'storage_settings' => array(
                            'auth_code_lifetime' => '2800',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'db' => array(
        'adapters' => array(
            'ZfeggAdmin' => array(
                'database' => 'zfegg-admin',
                'driver' => 'PDO_Mysql',
                'hostname' => '',
                'username' => 'root',
                'password' => 'ztgame@123',
                'dsn' => 'mysql:dbname=zfegg-admin;host=192.168.39.18;charset=utf8',
            ),
            'ZfeggOauth' => array(
                'database' => 'zfegg-oauth',
                'driver' => 'PDO_Mysql',
                'username' => 'root',
                'password' => 'ztgame@123',
                'dsn' => 'mysql:dbname=zfegg-oauth;host=192.168.39.18;charset=utf8',
            ),
        ),
    ),

    'zfegg-admin-mvc-auth' => array(
        'role_whitelists' => array(
            '6' => array(
                '*' => array(),
            ),
        ),
    ),
);
