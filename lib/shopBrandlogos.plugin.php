<?php

/*
 * Class shopBrandlogosPlugin
 * Brand logo plugin for Webasyst Shop-Script
 * Shop administrators can to add logo file to brand features and then to display them in frontend
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrandlogosPlugin extends shopPlugin {
    
    /**
     * Frontend method that displays brand logo image
     * @return string
     */
    static function displayBrandLogo($id) {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brandlogos'));

        if ($settings['status'] === 'on') {

            $feature_model = new shopFeatureModel();
            $brand_feature = $feature_model->getByCode('brand');
            if ($brand_feature) {

                $feature_value_model = $feature_model->getValuesModel($brand_feature['type']);
                $product_brands = $feature_value_model->getProductValues($id, $brand_feature['id']);                  

                if ($product_brands) {

                    $brand_logos_model = new shopBrandlogosPluginBrandlogosModel();

                    foreach ($product_brands as $value) {
                        $brand_id = $feature_value_model->getValueId($brand_feature['id'], $value);
                        $brand = $brand_logos_model->getByField('brand_id', $brand_id);
                        $brand['id'] = $brand_id;
                        $brand['name'] = $value;
               		              		
                        $brands[$brand_id] = $brand;
                    }

                    $view = wa()->getView(); 
                    $view->assign('brands', $brands);

                    $html = $view->fetch(realpath(dirname(__FILE__)."/../").'/templates/Frontend.html');

                    return $html;

                }  else {

                    return;

                } 

            }  else {

                return;

            }             

        } else {

            return;

        }        

    }

    /**
     * Generates the HTML code for the user control with ID settingNumberControl for number parametrs
     * @param string $name
     * @param array $params
     * @return string
     */
    static public function settingNumberControl($name, $params = array()) {

        $control = '';

        $control_name = htmlentities($name, ENT_QUOTES, 'utf-8');

        $control .= "<input id=\"{$params['id']}\" type=\"number\" name=\"{$control_name}\" ";
        $control .= self::addCustomParams(array('class', 'placeholder', 'value',), $params);
        $control .= self::addCustomParams(array('min', 'max', 'step',), $params['options']);
        $control .= ">";

        return $control;

    }

}