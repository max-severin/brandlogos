<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'status' => array(
        'title'        => _wp('Status'),
        'value'        => 'off',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'off' => _wp('Off'),
            'on'  => _wp('On'),
        ),
    ),
    'feature_id' => array(
        'title'        => _wp('Brand feature'),
        'description'  => _wp('Select the feature you want to add logo'),
        'value'        => '',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopBrlgsPlugin::settingFeatureSelectControl',
    ),
    'width' => array(
        'title'        => _wp('Width (px)'),
        'description'  => _wp('Width of the uploaded image'),
        'placeholder'  => '64',
        'value'        => '64',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopBrlgsPlugin::settingNumberControl',
        'options'      => array(
            'step' => '1',
        ),
    ),
    'height' => array(
        'title'        => _wp('Height (px)'),
        'description'  => _wp('Height of the uploaded image'),
        'placeholder'  => '64',
        'value'        => '64',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopBrlgsPlugin::settingNumberControl',
        'options'      => array(
            'step' => '1',
        ),
    ),
);