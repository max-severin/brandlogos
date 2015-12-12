<?php

/*
 * Class shopBrlgsPluginBrlgsModel
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopBrlgsPluginBrlgsModel extends waModel {

    protected $table = 'shop_brlgs_logo';

    public function save($brand) {
    	if ($old_data = $this->getByField('brand_id', $brand['id'])) {

            $fields = array(
                'brand_id' => $brand['id'],
            );
            if ( file_exists($brand['logo']) ) {
                $brand['filename'] = $this->saveFile($brand['logo'], $old_data['logo']);
            } else {
                $brand['filename'] = $old_data['logo'];
            }
            $data = array(
                'logo' => $brand['filename'],
            );
            $this->updateByField($fields, $data);

    	} else {

            if ( file_exists($brand['logo']) ) {
                $brand['filename'] = $this->saveFile($brand['logo']);
            } else {
            	$brand['filename'] = '';
            }
            $data = array(
                'brand_id' => $brand['id'],
                'logo' => $brand['filename'],
            );
            $this->insert($data, 1);

    	}
    }

    public function saveFile($file, $old_file = false) {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'brlgs'));

        ($settings['height']) ? $height = $settings['height'] : $height = 64;
        ($settings['width']) ? $width = $settings['width'] : $width = 64;

        $rand = mt_rand();
        $name = "$rand.original.png";
        $filename = wa()->getDataPath("brlgs/{$name}", TRUE, 'shop'); 

        waFiles::move($file, $filename);   

        try {
            $img = waImage::factory($filename);
        } catch(Exception $e) {
            $errors = 'File is not an image ('.$e->getMessage().').';
            return;
        }
        $img->resize($height, $width, waImage::AUTO)->save($filename, 90);

        if ($old_file) {
            waFiles::delete(wa()->getDataPath("brlgs/{$old_file}", TRUE, 'shop'));
        }

        return $name;
    }

    public function getProductListBrands($product_list_brands, $brand_ids) {
        $new_product_list_brands = array();
        $brand_ids_str = '';

        foreach ($brand_ids as $id) {
            if ( empty($brand_ids_str) ) {
                $brand_ids_str .= $id;
            } else {
                $brand_ids_str .= ', ' . $id;
            }
            
        }

        $sql  = "SELECT * FROM `{$this->table}` WHERE `brand_id` IN (" . $brand_ids_str . ")";

        $brand_logos = $this->query($sql)->fetchAll('brand_id');

        foreach ($product_list_brands as $id => $brands) {
            foreach ($brands as &$brand) {
                if ($brand_logos[$brand['id']]){
                    $brand['logo'] = $brand_logos[$brand['id']]['logo'];                    
                }                
            }

            $view = wa()->getView(); 
            $view->assign('brands', $brands);

            $new_product_list_brands[$id] = $view->fetch(realpath(dirname(__FILE__)."/../../").'/templates/Frontend.html');
        }

        return $new_product_list_brands;
    }

}