<?php
/**
 * Name: Product style 06
 * Slug: content-product-style-06
 **/

$args = isset( $args ) ? $args : null;

?>
<?php
remove_action( 'woocommerce_shop_loop_item_title', 'azirspares_add_categories_product', 20 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_woocommerce_group_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 1 );
?>
    <div class="product-inner" data-items="2">
        <div class="product-thumb">
            <div class="label-deal"><span><?php echo esc_html__( 'LIMITED TIME', 'azirspares' ) ?></span></div>
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
        <div class="product-info">
            <div class="product-info-inner">
                <h3 class="title">
                    <span class="icon-wrap">
                        <span class="icon"><span class="flaticon-coupon"></span></span>
                    </span>
                    <span class="text">
                    <?php echo esc_html__( 'Deals', 'azirspares' ); ?>
                        <span><?php echo esc_html__( 'OF THE DAYS', 'azirspares' ); ?></span>
                </span>
                </h3>
				<?php
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked azirspares_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );
				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
            </div>
            <div class="hurry-title">
                <span><?php echo esc_html__( 'Hurry up !', 'azirspares' ) ?></span><?php echo esc_html__( ' DEAL END IN :', 'azirspares' ) ?>
            </div>
			<?php do_action( 'azirspares_function_shop_loop_item_countdown' ); ?>
        </div>
    </div>
<?php
add_action( 'woocommerce_shop_loop_item_title', 'azirspares_add_categories_product', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'azirspares_woocommerce_group_flash', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 1 );