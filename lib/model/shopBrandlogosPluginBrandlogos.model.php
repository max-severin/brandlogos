<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopBrandlogosPluginBrandlogosModel extends waModel {

    protected $table = 'shop_brand_logos';

    public function save($brand) {
    	if ($old_data = $this->getByField('brand_value_id', $brand['id'])) {
    		$fields = array(
			    'brand_value_id' => $brand['id'],
			);
    		if ( file_exists($brand['logo']) ) {
                $brand['filename'] = $this->saveFile($brand['logo'], $old_data['logo']);
            } else {
            	$brand['filename'] = $old_data['logo'];
            }
			$data = array(
			    'logo' => $brand['filename'],
			    'position' => $brand['position'],
			);
			$this->updateByField($fields, $data);
    	} else {
    		if ( file_exists($brand['logo']) ) {
                $brand['filename'] = $this->saveFile($brand['logo']);
            } else {
            	$brand['filename'] = '';
            }
    		$data = array(
			    'brand_value_id' => $brand['id'],
			    'logo' => $brand['filename'],
			    'position' => $brand['position'],
			);
			$this->insert($data, 1);
    	}
    }

    public function saveFile($file, $old_file = false) {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brandlogos'));

        if ($settings['height'])
            $height = $settings['height'];
        else 
            $height = 64;

        if ($settings['width'])
            $width = $settings['width'];
        else 
            $width = 64;

        $rand = mt_rand();
        $name = "$rand.original.png";
        $filename = wa()->getDataPath("brandlogos/{$name}", TRUE, 'shop'); 

        waFiles::move($file, $filename);   

        try {
            $img = waImage::factory($filename);
        } catch(Exception $e) {
            $errors = 'File is not an image ('.$e->getMessage().').';
            return;
        }
        $img->resize($height, $width, waImage::AUTO)->save($filename, 90);

        if ($old_file) {
            waFiles::delete(wa()->getDataPath("brandlogos/{$old_file}", TRUE, 'shop'));
        }

        return $name;
    }

}