<?php

/*
 * Class shopBrandlogosPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopBrandlogosPluginSettingsAction extends waViewAction {

    public function execute() {

        $feature_model = new shopFeatureModel();
        $app_settings_model = new waAppSettingsModel();
        $brand_logos_model = new shopBrandlogosPluginBrandlogosModel();

        $brands = array();

        $settings = $app_settings_model->get(array('shop', 'brandlogos'));

        $brand_feature = $feature_model->getByCode('brand');

        if ($brand_feature) {
            $brand_values = $feature_model->getFeatureValues($brand_feature);
            foreach ($brand_values as $id => $name) {
                $brand = $brand_logos_model->getByField('brand_id', $id);
                $brands[$id] = array(
                    'id' => $id,
                    'name' => $name,
                    'logo' => $brand['logo'],                   
                );
            }
        }             

        $this->view->assign('settings', $settings);
        $this->view->assign('brands', $brands);

    }

}