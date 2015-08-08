<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'name' => /*_wp*/('Brand logos'),
    'description' => /*_wp*/('The ability to add image with logo for each brand'),
    'img'=>'img/brlgs.png',
    'vendor' => 1020720,
    'version' => '1.0.0',
    'shop_settings' => true,
    'handlers'    => array(
        'frontend_head' => 'frontendHead',
    ),
);