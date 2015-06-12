<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'name' => /*_wp*/('Brand logos'),
    'description' => /*_wp*/('The ability to add image with logo for each brand'),
    'version' => '1.0.0',
    'shop_settings' => true,
    'img'=>'img/brandlogos.png',
    'handlers'    => array(
        'frontend_head' => 'frontendHead',
    ),
);