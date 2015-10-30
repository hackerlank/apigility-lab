<?php
return array(
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ),
                'type' => 'regex',
            ),
        ),
    ),
    'db' => array(
        'adapters' => array(
            'ZfeggAdmin' => array(),
            'ZfeggOauth' => array(),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'ZfeggAdmin\\V1' => 'users',
            ),
        ),
    ),
);
