<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'status' => array(
        'title'        => 'Статус плагина',
        'value'        => 'off',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'off' => 'Выключен',
            'on'  => 'Включен',
        ),
    ),
    'width' => array(
        'title'        => 'Ширина (px)',
        'description'  => 'Ширина загружаемого файла изображения',
        'placeholder'  => '64',
        'value'        => '64',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopCallbPlugin::settingNumberControl',
        'options'      => array(
            'step' => '1',
        ),
    ),
    'height' => array(
        'title'        => 'Высота (px)',
        'description'  => 'Высота загружаемого файла изображения',
        'placeholder'  => '64',
        'value'        => '64',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopCallbPlugin::settingNumberControl',
        'options'      => array(
            'step' => '1',
        ),
    ),
);