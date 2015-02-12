<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

return array(
    'name' => 'Логотипы брендов',
    'description' => 'Возможность закрепить за каждым брендом логотип-стикер',
    'version'=>'1.0.0',
    'shop_settings' => true,
    'img'=>'img/brandlogos.png',
    'handlers'    => array(
        'frontend_head' => 'frontendHead',
    ),
);