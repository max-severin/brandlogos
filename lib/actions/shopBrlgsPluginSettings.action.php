<?php

/*
 * Class shopBrlgsPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrlgsPluginSettingsAction extends waViewAction {

    public function execute() {
        $model = new waModel();

        try {

            $model->query('SELECT * FROM shop_brlgs_logo WHERE 0');

        } catch (waDbException $e) {

            $file_db = realpath(dirname(__FILE__)).'/../config/db.php';

            if (file_exists($file_db)) {
                $schema = include($file_db);
                $model->createSchema($schema);
            }

        }

        $plugin = wa('shop')->getPlugin('brlgs');
        $namespace = 'shop_brlgs';

        $params = array();
        $params['id'] = 'brlgs';
        $params['namespace'] = $namespace;
        $params['title_wrapper'] = '%s';
        $params['description_wrapper'] = '<br><span class="hint">%s</span>';
        $params['control_wrapper'] = '<div class="name">%s</div><div class="value">%s %s</div>';

        $settings = $plugin->getSettings();
        $settings_controls = $plugin->getControls($params);

        $feature_model      = new shopFeatureModel();
        $brand_logos_model  = new shopBrlgsPluginBrlgsModel();

        $brands = array();

        if ( isset($settings['feature_id']) && $settings['feature_id'] ) {
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
        }

        $this->view->assign('brands', $brands);
        $this->view->assign('settings', $settings);
        $this->view->assign('settings_controls', $settings_controls);

        parent::execute();
    }

}