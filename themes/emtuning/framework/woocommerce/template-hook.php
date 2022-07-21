<?php
/***
 * Core Name: WooCommerce
 * Version: 1.0.0
 * Author: Fami Themes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
include_once dirname( __FILE__ ) . '/template-functions.php';
/**
 * HOOK TEMPLATE
 */
add_action( 'init', 'product_per_page_request' );
add_action( 'init', 'product_display_mode_request' );
add_action( 'wp_loaded', 'azirspares_action_wp_loaded' );
add_action( 'azirspares_function_shop_loop_item_countdown', 'azirspares_function_shop_loop_item_countdown', 10 );
add_action( 'azirspares_function_shop_loop_process_variable', 'azirspares_function_shop_loop_process_variable', 10 );
/**
 * HOOK LOOP
 */
add_filter( 'woocommerce_loop_add_to_cart_link', 'azirspares_loop_add_to_cart_link', 10, 2 );

/**
 *
 * HOOK MINI CART
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'azirspares_cart_link_fragment' );
add_action( 'azirspares_header_mini_cart', 'azirspares_header_mini_cart' );
add_action( 'azirspares_header_wishlist', 'azirspares_header_wishlist' );
/**
 *
 * WRAPPER CONTENT
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'woocommerce_before_main_content', 'azirspares_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_before_main_content', 'azirspares_woocommerce_before_loop_content', 50 );
add_action( 'woocommerce_after_main_content', 'azirspares_woocommerce_after_loop_content', 50 );
add_action( 'woocommerce_sidebar', 'azirspares_woocommerce_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'azirspares_woocommerce_after_main_content', 100 );
add_action( 'woocommerce_before_shop_loop', 'azirspares_woocommerce_before_shop_loop', 50 );
add_action( 'woocommerce_after_shop_loop', 'azirspares_woocommerce_after_shop_loop', 10 );
add_action( 'woocommerce_before_main_content', 'woocommerce_product_archive_description', 60 );
// add_action( 'template_redirect', 'azirspares_custom_track_product_view', 20 ); // woocommerce_after_single_product
add_action( 'woocommerce_sidebar', 'azirspares_recently_viewed_product', 60 );
/**
 *
 * SHOP SINGLE
 */
/**
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_before_single_product_summary', 'azirspares_before_main_content_left', 5 );
add_action( 'woocommerce_before_single_product_summary', 'azirspares_after_main_content_left', 50 );
add_action( 'woocommerce_after_single_product_summary', 'azirspares_woocommerce_after_single_product_summary_1', 5 );
add_action( 'woocommerce_after_single_product_summary', 'azirspares_single_product_policy', 5 );
add_action( 'woocommerce_after_single_product_summary', 'azirspares_woocommerce_before_single_product_summary_2', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 2 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 3 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4 );
add_action( 'woocommerce_single_product_summary', 'azirspares_template_single_available', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );
add_action( 'woocommerce_single_product_summary', 'azirspares_product_share', 7 );
/**
 *
 * SHOP CATEGORY PAGE
 */
add_action( 'woocommerce_before_main_content', 'azirspares_woocommerce_shop_banner', 59 );
add_action( 'woocommerce_before_main_content', 'azirspares_woocommerce_category_description', 60 );
/**
 *
 * SHOP CONTROL
 */
add_action( 'azirspares_control_before_content', 'azirspares_shop_display_mode_tmp', 10 );
add_action( 'azirspares_control_before_content', 'woocommerce_catalog_ordering', 20 );
add_action( 'azirspares_control_before_content', 'azirspares_product_per_page_tmp', 30 );
add_action( 'azirspares_control_after_content', 'azirspares_custom_pagination', 10 );
add_action( 'azirspares_control_after_content', 'woocommerce_catalog_ordering', 20 );
add_action( 'azirspares_control_after_content', 'azirspares_product_per_page_tmp', 30 );
/**
 * CUSTOM SHOP CONTROL
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_before_shop_loop', 'azirspares_before_shop_control', 20 );
add_action( 'woocommerce_after_shop_loop', 'azirspares_after_shop_control', 50 );
add_action( 'woocommerce_archive_description', 'woocommerce_result_count', 5 );

/**
 * CUSTOM PRODUCT POST PER PAGE
 */
add_filter( 'loop_shop_per_page', 'azirspares_loop_shop_per_page', 20 );
add_filter( 'woof_products_query', 'azirspares_woof_products_query', 20 );
/**
 *
 * CUSTOM PRODUCT RATING
 */
add_filter( 'woocommerce_product_get_rating_html', 'azirspares_product_get_rating_html', 10, 3 );
/**
 *
 * REMOVE CSS
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
/**
 *
 * CUSTOM PRODUCT NAME
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'azirspares_add_categories_product', 20 );
add_action( 'woocommerce_shop_loop_item_title', 'azirspares_template_loop_product_title', 30 );
/**
 *
 * PRODUCT THUMBNAIL
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_template_loop_product_thumbnail', 10, 1 );
/**
 * REMOVE "woocommerce_template_loop_product_link_open"
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
/**
 *
 * CUSTOM FLASH
 */
add_action( 'azirspares_group_flash_content', 'woocommerce_show_product_loop_sale_flash', 5 );
add_action( 'azirspares_group_flash_content', 'azirspares_custom_new_flash', 10 );
add_filter( 'woocommerce_sale_flash', 'azirspares_custom_sale_flash' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_woocommerce_group_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'azirspares_woocommerce_group_flash', 10 );
/**
 *
 * BREADCRUMB
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'azirspares_woocommerce_breadcrumb', 20 );
/**
 *
 * RELATED
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_sidebar', 'azirspares_related_products', 50 );
/**
 *
 * UPSELL
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_sidebar', 'azirspares_upsell_display', 50 );
/**
 *
 * CROSS SELL
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'azirspares_cross_sell_products' );
/**
 *
 * STICKY ADD TO CART
 */
add_action( 'single_product_addtocart', 'woocommerce_template_single_title', 7 );
add_action( 'single_product_addtocart', 'woocommerce_template_single_price', 8 );
add_action( 'single_product_addtocart', 'woocommerce_template_single_rating', 9 );
add_action( 'single_product_addtocart_thumb', 'azirspares_single_thumbnail_addtocart', 10 );
add_action( 'woocommerce_sidebar', 'azirspares_add_to_cart_sticky', 100 );
/**
 *
 * CHECKOUT
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_action( 'woocommerce_before_checkout_form', 'azirspares_checkout_login_open', 1 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 5 );
add_action( 'woocommerce_before_checkout_form', 'azirspares_checkout_login_close', 6 );
add_action( 'woocommerce_before_checkout_form', 'azirspares_checkout_coupon_open', 7 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_before_checkout_form', 'azirspares_checkout_coupon_close', 11 );
/**
 *
 * CART
 */
add_action( 'woocommerce_before_cart_table', 'azirspares_title_cart', 1 );

remove_action( 'xoo_cp_related_products', 'woocommerce_template_loop_product_thumbnail', 15 );
add_action( 'xoo_cp_related_products', 'azirspares_xoo_wc_template_loop_product_thumbnail', 15 );