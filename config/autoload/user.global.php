<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'filters' => array(
        'invokables' => array(
            'ZfeggAdmin\Filter\Bcrypt' => 'ZfeggAdmin\Filter\Bcrypt',
        ),
    ),


    'zf-mvc-auth' => array(
        'authentication' => array(
            'adapters' => array(
//                'users' => array(
//                    'adapter' => 'ZF\\MvcAuth\\Authentication\\OAuth2Adapter',
//                    'storage' => array(
//                        'adapter' => 'pdo',
//                        'dsn' => 'mysql:dbname=zfegg-oauth;host=192.168.39.18;charset=utf8',
//                        'route' => '/oauth',
//                        'username' => 'root',
//                        'password' => 'ztgame@123',
//                        'storage_settings' => array(
//                            'auth_code_lifetime' => '2800',
//                        ),
//                    ),
//                ),
            ),
        ),
    ),
);
