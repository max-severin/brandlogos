# Logo for brands
Plugin for Webasyst Shop-Script 5 that adds logo to brands and shows them on product pictures in frontend.
To include plugin in theme template you need to put next code in template:
{shopBrandlogosPlugin::displayBrandLogo($p.id, "category")} - for product brief template in catalog (for example "list-thumbs.html" in "custom" theme).
{shopBrandlogosPlugin::displayBrandLogo($p.id, "product")} - for product main template (for example "product.html" in "custom" theme).
This code must be placed under next helper: {$wa->shop->productImgHtml}.