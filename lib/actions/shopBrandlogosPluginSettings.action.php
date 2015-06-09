<?php

/*
 * Class shopBrandlogosPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrandlogosPluginSettingsAction extends shopPluginsSettingsAction {

    public function execute() {
        $_GET['id'] = 'brandlogos';

        $app_settings_model = new waAppSettingsModel();
        $feature_model      = new shopFeatureModel();
        $brand_logos_model  = new shopBrandlogosPluginBrandlogosModel();

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

        $view = wa()->getView(); 
        $view->assign('settings', $settings);
        $this->view->assign('brands', $brands);

        parent::execute();
    }

}