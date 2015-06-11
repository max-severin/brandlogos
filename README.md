# brandlogos

## Description
Brand logo plugin for Webasyst Shop-Script

## Features
Shop administrators can to add logo file to brand features and then to display them in frontend.

## Installing
### Auto
...

### Manual
1. Get the code into your web server's folder /PATH_TO_WEBASYST/wa-apps/shop/plugins

2. Add the following line into the /PATH_TO_WEBASYST/wa-config/apps/shop/plugins.php file (this file lists all installed shop plugins):

		'brandlogos' => true,

3. Done. Configure the plugin in the plugins tab of shop backend.

## Specificity
To output the brand logo in shop frontend paste in the product template the following code: **{shopBrandlogosPlugin::displayBrandLogo($product.id)}**