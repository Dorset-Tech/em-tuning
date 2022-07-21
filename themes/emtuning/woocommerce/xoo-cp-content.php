<?php
	if(!defined('ABSPATH')){
		return;
	}
	global $xoo_cp_gl_qtyen_value,$xoo_cp_ad_rl_en_value,$xoo_cp_ad_rl_enm_value,$xoo_cp_ad_rl_tl_value,$xoo_cp_gl_splk_value,$xoo_cp_gl_fullcart_value;
	$cart_contents = WC()->cart->get_cart();
	$show_full_cart = $xoo_cp_gl_fullcart_value ? true : false;
	if(!$show_full_cart){
		if(isset($cart_contents[$cart_item_key])){
			foreach ($cart_contents as $key => $value) {
				if($key != $cart_item_key) unset($cart_contents[$key]);
			}
		}else{
			return false;
		}
	}
	$cart_data = $cart_contents; 
	if(empty($cart_data)): 
?>
	<span class="xoo-cp-empty-cart-notice"><?php esc_html_e('Your cart is empty','azirspares'); ?></span>

	<a class="xcp-btn xoo-cp-sn-btn" href="<?php echo $xoo_cp_gl_splk_value  ? $xoo_cp_gl_splk_value : get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php esc_html_e('Shop Now','azirspares'); ?></a>


<?php else: ?>

	<table class="xoo-cp-cart">
		<?php if($show_full_cart): ?>
			<tr class="xoo-cp-ths">
				<th class="xcp-rhead"><?php esc_html_e('Remove','azirspares'); ?></th>
				<th><?php esc_html_e('Image','azirspares'); ?></th>
				<th><?php esc_html_e('Title','azirspares'); ?></th>
				<th class="xcp-phead"><?php esc_html_e('Price','azirspares'); ?></th>
				<th><?php esc_html_e('Quantity','azirspares'); ?></th>
				<th><?php esc_html_e('Total','azirspares'); ?></th>
			</tr>
		<?php endif; ?>

	<?php

	foreach ( $cart_data as $cart_item_key => $cart_item ) {
			if(function_exists('wc_pb_is_bundled_cart_item')){
				if(wc_pb_is_bundled_cart_item($cart_item)) continue;
			}
			$_product  = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item) : '', $cart_item, $cart_item_key);
			$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
			$product_name =  apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;';
			$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
			$product_subtotal = apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity']), $cart_item, $cart_item_key);
			$attributes = wc_get_formatted_variation($_product);
			$attributes .=  WC()->cart->get_item_data($cart_item);
			$max_value = apply_filters('woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product);
			$min_value = apply_filters('woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product );
			$step      = apply_filters('woocommerce_quantity_input_step', 1, $_product );
			$pattern   = apply_filters('woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval') ? '[0-9]*' : '');
	?>

		<tr class="xoo-cp-pdetails" data-xoo_cp_key="<?php echo esc_attr($cart_item_key); ?>">
			<td class="xoo-cp-remove"><span class="xoo-cp-icon-close xoo-cp-remove-pd"></span></td>
			<td class="xoo-cp-pimg"><?php echo wp_specialchars_decode($thumbnail); ?></td>
			<td class="xoo-cp-ptitle"><a href="<?php echo esc_url($product_permalink); ?>"><?php echo esc_html($product_name); ?></a>

				<?php if($attributes): ?>
					<div class="xoo-cp-variations"><?php echo esc_html($attributes); ?></div>
				<?php endif; ?>

			</td>
			<td class="xoo-cp-pprice"><?php echo wp_specialchars_decode($product_price); ?></td>
			<td class="xoo-cp-pqty">

				<?php if ( $_product->is_sold_individually() || !$xoo_cp_gl_qtyen_value ): ?>
					<span><?php echo esc_html($cart_item['quantity']); ?></span>
				<?php else: ?>
					<div class="xoo-cp-qtybox">
					<span class="xcp-minus xcp-chng">-</span>
					<input type="number" class="xoo-cp-qty" max="<?php esc_attr_e( 0 < $max_value ? $max_value : '' ); ?>" min="<?php esc_attr_e($min_value); ?>" step="<?php echo esc_attr_e($step); ?>" value="<?php echo esc_attr($cart_item['quantity']); ?>" pattern="<?php esc_attr_e( $pattern ); ?>">
					<span class="xcp-plus xcp-chng">+</span></div>
				<?php endif; ?>

			</td>
			<td class="xoo-cp-ptotal"><?php echo wp_specialchars_decode($product_subtotal); ?></td>
		</tr>
	<?php }; ?>

	</table>

	<div class="xoo-cp-table-bottom">
		
		<?php if($show_full_cart): ?>
			<a class="xoo-cp-empct"><span class="xoo-cp-icon-close"></span><?php esc_html_e('Empty Cart','azirspares'); ?></a>
		<?php endif; ?>

		<div class="xoo-cp-cart-total">
			<span class="xcp-totxt"><?php esc_html_e('Total','azirspares');?> : </span><span class="xcp-ctotal"><?php echo wp_specialchars_decode(wc_price(WC()->cart->subtotal)); ?></span></div>
	</div>
    <?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>
	<a class="xoo-cp-btn-vc xcp-btn" href="<?php echo wc_get_cart_url(); ?>"><?php esc_html_e('View Cart','azirspares'); ?></a>
	<a class="xoo-cp-btn-ch xcp-btn" href="<?php echo wc_get_checkout_url(); ?>"><?php esc_html_e('Checkout','azirspares'); ?></a>
	<a class="xoo-cp-close xcp-btn" href="<?php echo esc_url($shop_page_url); ?>"><?php esc_html_e('Continue Shopping','azirspares'); ?></a>
<?php endif; ?>