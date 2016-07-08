# brlgs - Brand logos

![brlgs-settings](https://www.webasyst.com/wa-data/public/baza/products/img/21/1721/4858.970.png)

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
Enable the plugin in settings, select the feature which you want to add logos and upload images for each value of the feature.  
To output the brand logo in shop frontend paste in the product template the following code:  
**{shopBrlgsPlugin::displayProductBrandLogo($product.id)}** - as a method parameter it is necessary to specify the product id.

### The showing of the brand image in the product page:
Add a call to the plugin in the right place in the **product.html** file as shown below:

		<div class="corner top left">  
			{shopBrlgsPlugin::displayProductBrandLogo($product.id)}  
		</div>

![brlgs-product](https://www.webasyst.com/wa-data/public/baza/products/img/21/1721/6873.970.png)

### The showing of the brand image in the categories, lists:
You need to edit the template that generates the product lists. In the basic themes of Shop-Script is used for this **list-thumbs.html** template. Add the next code:

		{$product_brand_logos = shopBrlgsPlugin::displayProductListBrandLogos($products)}

**Warning**: This code should be added **above** the code with **foreach** loop:

		{foreach $products as $p}

Then inside the **foreach** add the next:

		<div class="corner top left">{$product_brand_logos[$p.id]}</div>

![brlgs-list-thumbs](https://www.webasyst.com/wa-data/public/baza/products/img/21/1721/6874.970.png)

*The pictures show the principle and the approximate location of the calling plugin can be added to template files of basic design theme Custom. In other themes the plugin is installed the same way.*