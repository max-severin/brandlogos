# brlgs

## Description
Brand logos plugin for Shop-Script 6

## Features
Shop administrators can to add logo file to each brand feature and then to display these images in frontend.

## Installing
### Auto
...

### Manual
1. Get the code into your web server's folder /PATH_TO_WEBASYST/wa-apps/shop/plugins

2. Add the following line into the /PATH_TO_WEBASYST/wa-config/apps/shop/plugins.php file (this file lists all installed shop plugins):

		'brlgs' => true,

3. Done. Configure the plugin in the plugins tab of shop backend.

## Specificity
To output the brand logo in shop frontend paste in the product template the following code:  
**{shopBrlgsPlugin::displayBrandLogo($product.id)}** - by product id  
**{shopBrlgsPlugin::displayBrandLogo($brand_value, 'by_brand_value')}** - by brand value