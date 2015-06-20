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

        $settings   = $app_settings_model->get(array('shop', 'brandlogos'));
        $feature_id = $settings['feature_id'];

        if ($feature_id) {
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
        }

        $this->view->assign('brands', $brands);
        $this->view->assign('settings', $settings);

        parent::execute();
    }

}