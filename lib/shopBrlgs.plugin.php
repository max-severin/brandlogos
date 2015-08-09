<?php

/*
 * Class shopBrlgsPlugin
 * Brand logo plugin for Webasyst Shop-Script
 * Shop administrators can to add logo file to brand features and then to display them in frontend
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrlgsPlugin extends shopPlugin {
    
    /**
     * Frontend method that displays brand logo image
     * @return string
     */
    static function displayBrandLogo($product_id) {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brlgs'));

        if (isset($settings['status']) && $settings['status'] === 'on' && isset($settings['feature_id']) && $settings['feature_id']) {
            $feature_model = new shopFeatureModel();
            $brand_feature = $feature_model->getById($settings['feature_id']);

            if ($brand_feature) {
                $feature_value_model = $feature_model->getValuesModel($brand_feature['type']);
                $product_brands = $feature_value_model->getProductValues($product_id, $brand_feature['id']);                  

                if ($product_brands) {
                    $brands = array();
                    $brlgs_model = new shopBrlgsPluginBrlgsModel();

                    foreach ($product_brands as $value) {
                        $brand_id      = $feature_value_model->getValueId($brand_feature['id'], $value);
                        $brand         = $brlgs_model->getByField('brand_id', $brand_id);
                        $brand['id']   = $brand_id;
                        $brand['name'] = $value;
               		              		
                        $brands[$brand_id] = $brand;
                    }

                    $view = wa()->getView(); 
                    $view->assign('brands', $brands);

                    $html = $view->fetch(realpath(dirname(__FILE__)."/../").'/templates/Frontend.html');

                    return $html;
                }
            }
        }

        return;
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

    /**
     * Generates the HTML code for the user control with ID settingFeatureSelectControl for feature select parametrs
     * @param string $name
     * @param array $params
     * @return string
     */
    static public function settingFeatureSelectControl($name, $params = array()) {
        $feature_model = new shopFeatureModel();
        $features = $feature_model->select('*')->where('selectable = 1')->order('id DESC')->fetchAll();

        $app_settings_model = new waAppSettingsModel();
        $feature_id = $app_settings_model->get(array('shop', 'brlgs'), 'feature_id');
        if (!$feature_id) {
            $ids = array('brand', 'manufacturer', 'make');
            foreach ($features as $f) {
                if (in_array($f['code'], $ids)) {
                    $feature_id = $f['id'];
                    break;
                }
            }
        }

        $control = '';

        $control_name = htmlentities($name, ENT_QUOTES, 'utf-8');

        $control .= "<select name=\"{$control_name}\" autocomplete=\"off\"";
        $control .= self::addCustomParams(array('class', 'style', 'id', 'readonly', 'autofocus'), $params);
        $control .= ">\n";

        foreach ($features as $feature) {
            $control .= "<option value=\"{$feature['id']}\"";
            if ($feature['id'] == $feature_id) {
                $control .= " selected=\"true\"";
            }
            $control .= ">{$feature['name']}</option>\n";
        }

        $control .= "</select>";

        return $control;
    }

    /**
     * Generates the HTML parts of code for the params in user controls added by plugin
     * @param array $list
     * @param array $params
     * @return string
     */
    private static function addCustomParams($list, $params = array()) {
        $params_string = '';

        foreach ($list as $param => $target) {
            if (is_int($param)) {
                $param = $target;
            }
            if (isset($params[$param])) {
                $param_value = $params[$param];
                if (is_array($param_value)) {
                    if (isset($param_value['title'])) {
                        $param_value = $param_value['title'];
                    } else {
                        $param_value = implode(' ', $param_value);
                    }
                }
                if ($param_value !== false) {
                    $param_value = htmlentities((string)$param_value, ENT_QUOTES, 'utf-8');
                    if (in_array($param, array('autofocus'))) {                     
                        $params_string .= " {$target}";
                    } else {                        
                        $params_string .= " {$target}=\"{$param_value}\"";
                    }
                }
            }
        }

        return $params_string;
    }

}