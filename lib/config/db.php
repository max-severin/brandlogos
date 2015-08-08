<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'shop_brlgs_logo' => array(
        'brand_id' => array('int', 11, 'null' => 0),
        'logo' => array('text', 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'brand_id',
        ),
    ),
);