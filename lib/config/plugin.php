<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

return array(
    'name' => 'Логотипы брендов',
    'description' => 'Возможность закрепить за каждым брендом логотип-картинку, которая будет располагаться в виде стикера у товара, а также можно задать положение логотипа относительно изображения товара',
    'version'=>'1.0.0',
    'shop_settings' => true,
    'img'=>'img/brandlogos.png',
    'handlers'    => array(
        'frontend_head' => 'frontendHead',
    ),
);