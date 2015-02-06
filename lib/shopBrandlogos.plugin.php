<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopBrandlogosPlugin extends shopPlugin {

	public function frontendHead() {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brandlogos'));

        if ($settings['status']) {

        	$view = wa()->getView();
        	$html = $view->fetch(realpath(dirname(__FILE__)."/../").'/templates/FrontendHead.html');

        	return $html;

    	} else {

            return;

        } 
    }

    static function displayBrandLogo($id, $page = "product") {

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
                		$brand = $brand_logos_model->getByField('brand_value_id', $brand_id);
                		$brand['id'] = $brand_id;
                		$brand['name'] = $value;

                		switch ($page) {
	             			case 'product':
	             				switch ($brand['position']) {
		                			case 'TR':
		                				$brand['class'] = "bl-product-top-right";
		                				break;
		                			case 'TL':
		                				$brand['class'] = "bl-product-top-left";
		                				break;
		                			case 'BR':
		                				$brand['class'] = "bl-product-bottom-right";
		                				break;
		                			case 'BR':
		                				$brand['class'] = "bl-product-bottom-left";
		                				break;                			
		                			default:
		                				$brand['class'] = "bl-product-top-right";
		                				break;
		                		}  
	             				break;
	             			case 'category':
	             				switch ($brand['position']) {
		                			case 'TR':
		                				$brand['class'] = "bl-category-top-right";	                		
		                				break;
		                			case 'TL':
		                				$brand['class'] = "bl-category-top-left";
		                				break;
		                			case 'BR':
		                				$brand['class'] = "bl-category-bottom-right";
		                				break;
		                			case 'BR':
		                				$brand['class'] = "bl-category-bottom-left";
		                				break;                			
		                			default:
		                				$brand['class'] = "bl-category-top-right";	
		                				break;
		                		}  	             					             				
	             				break;
	             		}                		              		
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