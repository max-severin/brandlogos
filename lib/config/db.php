<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

return array(
    'shop_brand_logos' => array(
        'brand_value_id' => array('int', 11, 'null' => 0),
        'logo' => array('text', 'null' => 0),
        'position' => array('text', 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'brand_value_id',
        ),
    ),
);