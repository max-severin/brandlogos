<?php

/*
 * Class shopBrandlogosPlugin
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopBrandlogosPlugin extends shopPlugin {

    static function displayBrandLogo($id) {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brandlogos'));

        if ($settings['status']) {

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

}