<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

return array(
    'view_manager' => array(
        'display_exceptions' => true,
    ),
    'validator_metadata' => array(
        'Zend\Captcha\Image' => array(
            'font' => 'string',
            'imgDir' => 'string',
            'imgUrl' => 'string',
            'imgAlt' => 'string',
            'width' => 'int',
            'height' => 'int',
            'fsize' => 'int',
            'dotNoiseLevel' => 'int',
            'lineNoiseLevel' => 'int',
            'timeout' => 'int',
            'wordlen' => 'int',
            'expiration' => 'int',
        ),
    ),
);
