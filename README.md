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
**{shopBrlgsPlugin::displayBrandLogo($product.id)}** - as a method parameter it is necessary to specify the product id.

## The showing of the brand image in the categories, lists:
You need to edit the template that generates the product lists. In the basic themes of Shop-Script is used for this **list-thumbs.html** template:

```&lt;div class="corner top left"&gt;{shopBrlgsPlugin::displayBrandLogo(**$p.id**)}&lt;/div&gt;```

![brlgs-list-thumbs](https://www.webasyst.com/wa-data/public/baza/products/img/21/1721/5440.970.png)

## The showing of the brand image in the product page:
Add a call to the plugin in the right place in the **product.html** file as shown below:

```&lt;div class="corner top left"&gt;  
{shopBrlgsPlugin::displayBrandLogo(**$product.id**)}  
&lt;/div&gt;```

![brlgs-product](https://www.webasyst.com/wa-data/public/baza/products/img/21/1721/5441.970.png)

*The pictures show the principle and the approximate location of the calling plugin can be added to template files of basic design theme Custom. In other themes the plugin is installed the same way.*