<?php
/**
	* The template for displaying product content within loops
	* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
	* HOWEVER, on occasion WooCommerce will need to update template files and you
	* (the theme developer) will need to copy the new files to your theme to
	* maintain compatibility. We try to do this as little as possible, but it does
	* happen. When this occurs the version of the template file will be bumped and
	* the readme will list any important changes.
	* @see     https://docs.woocommerce.com/document/template-structure/
	* @package WooCommerce/Templates
	* @version 3.6.0
*/

if (! defined('ABSPATH')){
	exit;
}
global $product;
if (! empty($product) || $product->is_visible()){
	$azirspares_animate_class = 'famiau-wow-continuous wow fadeInUp product-item';
	$azirspares_woo_bg_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_bg_items', 3);
	$azirspares_woo_lg_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_lg_items', 3);
	$azirspares_woo_md_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_md_items', 4);
	$azirspares_woo_sm_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_sm_items', 6);
	$azirspares_woo_xs_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_xs_items', 6);
	$azirspares_woo_ts_items  = Azirspares_Functions::azirspares_get_option('azirspares_woo_ts_items', 12);
	$shop_display_mode        = Azirspares_Functions::azirspares_get_option('azirspares_shop_list_style', 'grid');
	$classes[]                = 'product-item';
	$classes[]                = $azirspares_animate_class;
	$azirspares_shop_product_style = Azirspares_Functions::azirspares_get_option('azirspares_shop_product_style', 'style-01');
	$enable_shop_mobile       = Azirspares_Functions::azirspares_get_option('enable_shop_mobile');
	if ($shop_display_mode == 'list'){
		$classes[] = 'list col-sm-12';
	} else {
		$classes[] = 'rows-space-40';
		$classes[] = 'col-bg-' . $azirspares_woo_bg_items;
		$classes[] = 'col-lg-' . $azirspares_woo_lg_items;
		$classes[] = 'col-md-' . $azirspares_woo_md_items;
		$classes[] = 'col-sm-' . $azirspares_woo_sm_items;
		$classes[] = 'col-xs-' . $azirspares_woo_xs_items;
		$classes[] = 'col-ts-' . $azirspares_woo_ts_items;
	}
	if ($shop_display_mode == 'grid'){
		$classes[] = $azirspares_shop_product_style;
	}
	if (($enable_shop_mobile == 1) && (azirspares_is_mobile())){
		$classes[] = 'shop-mobile';
	}
?>

    <li <?php post_class($classes); ?> data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
		<?php if ($shop_display_mode == 'list'):
			get_template_part('woocommerce/product-styles/content-product', 'list');
		else:
			if (($enable_shop_mobile == 1) && (azirspares_is_mobile())){
				get_template_part('woocommerce/product-styles/content-product', 'style-01');
			} else {
				get_template_part('woocommerce/product-styles/content-product', $azirspares_shop_product_style);
			}
		endif; ?>
    </li>
	<?php
}