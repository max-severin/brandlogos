<?php

/*
 * Class shopBrlgsPluginBackendGetbrandsController
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrlgsPluginBackendGetbrandsController extends waJsonController {

    public function execute() {

        $plugin = wa('shop')->getPlugin('brlgs');
        $settings = $plugin->getSettings();

        if ( isset($settings['feature_id']) && $settings['feature_id'] ) {

            $feature_model      = new shopFeatureModel();
            $brand_logos_model  = new shopBrlgsPluginBrlgsModel();

            $brands = array();

            $feature_id = $settings['feature_id'];

            $brand_feature = $feature_model->getById($feature_id);
            $brand_values  = $feature_model->getFeatureValues($brand_feature);

            foreach ($brand_values as $id => $name) {
                $brand = $brand_logos_model->getByField('brand_id', $id);
                $brands[$id] = array(
                    'id'   => $id,
                    'name' => $name,
                    'logo' => $brand['logo'],                   
                );
            }

            $view = wa()->getView();
            $view->assign('settings', $settings);
            $view->assign('brands', $brands);
            $html = $view->fetch(realpath(dirname(__FILE__)."/../../").'/templates/BackendBrands.html');
            
            $this->response = $html;

        } else {

            $this->response = false;

        }

    }

}