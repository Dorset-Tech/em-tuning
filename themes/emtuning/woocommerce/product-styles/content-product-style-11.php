<?php
/**
 * Name: Product style 11
 * Slug: content-product-style-11
 **/

$args = isset( $args ) ? $args : null;

?>
<?php
remove_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_woocommerce_group_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
?>
    <div class="product-inner">
        <div class="product-thumb">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked azirspares_woocommerce_group_flash - 10
			 * @hooked azirspares_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title', $args );
			?>
        </div>
        <div class="product-info equal-elem">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked azirspares_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );
			?>
			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
            <div class="add-to-cart">
				<?php
				/**
				 * woocommerce_after_shop_loop_item hook.
				 *
				 * @removed woocommerce_template_loop_product_link_close - 5
				 * @hooked  woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
				?>
            </div>
        </div>
    </div>
<?php
add_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_woocommerce_group_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );