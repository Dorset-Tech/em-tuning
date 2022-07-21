<?php

/** 
 * Filer WooCommerce Flexslider options - Add Navigation Arrows
 */
add_filter( 'woocommerce_single_product_carousel_options', 'enbablesliderArrowNav' );
function enbablesliderArrowNav( $options ) {

    $options['directionNav'] = true;
    return $options;

}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 3 );


/**
 * Display single product information 
 */
add_action( 'woocommerce_after_single_product_summary', 'singleProductInfo', 5 );
function singleProductInfo() { 

	$product_support = get_field( 'product_support', get_the_ID() );

	$product_specs  = get_field_object( 'product_specifications', get_the_ID() );
	// echo "<pre>";
	// print_r($product_specs);
	// echo "</pre>";
?>
	<?php if( !empty($product_support) ): ?>
	<div class="product-support">
		<div class="row">
			<?php for ($i=0; $i < sizeof($product_support); $i++): ?>
			<div class="col-md-2">
				<div class="supportInfo" data-toggle="tooltip" data-placement="bottom" title="<?php echo $product_support[$i]['tooltip_info']; ?>">
					<img src="<?php echo $product_support[$i]['product_image']; ?>">
					<h6><?php _e($product_support[$i]['labelname'], 'azirs' ); ?></h6>
				</div>
			</div>
			<?php endfor; ?>
		</div>
	</div>
	<?php endif; ?>

	<!-- PRODUCT DETAILS GOES HERE -->
	<?php if(get_the_content()): ?>
	<div class="row">
		<div class="product-content">
			<div class="col-md-12">
				<h2><?php _e('Product Details', 'azirs'); ?></h2>
				<?php
				 wp_specialchars_decode(the_content()); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- PRODUCT SPECIFICATIONS -->
	<?php if( isset($product_specs['value']) && !empty($product_specs['value']) ): ?>
	<div class="row">
		<div class="product-specifications">
			<div class="spec-label">
				<div class="col-md-12">
					<h2><?php _e($product_specs['label'], 'azirs'); ?></h2>
				</div>
			</div>

			<div class="spec-info">
			<?php for ($i=0; $i < sizeof($product_specs['value']); $i++) : 
				$specImg   = $product_specs['value'][$i]['spec_image'];
				$specTitle = $product_specs['value'][$i]['spec_title'];
			?>
				<div class="col-md-4">

					<div class="spec-head">
						<div class="specImg">
							<img src="<?php echo $specImg; ?>">
						</div>
						<div class="spec_title">
							<h1><?php echo $specTitle; ?></h1>
						</div>
					</div>

					<ul>
						<?php 
						$specInfo = $product_specs['value'][$i]['spec_information']; 
						for ($j=0; $j < sizeof($specInfo); $j++) : 
						?>
						<li>
							<strong><?php _e( $specInfo[$j]['spec_label'].':', 'azirs' ); ?></strong>
							<span><?php _e( $specInfo[$j]['spec_description'], 'azirs' ); ?></span>
						</li>
						<?php endfor; ?>
					</ul>

				</div>

			<?php endfor; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- Reveiw info head goes here -->
	<?php
		if ( wc_review_ratings_enabled() ):
		global $product;
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
	?>
	<div class="row">
		<div class="product-reviews">
			<div class="col-md-12">
				<!-- <div class="product-review"> -->
					<h1><?php _e('PRODUCT REVIEWS', 'azirs'); ?></h1>
					<span><?php echo wc_get_rating_html( $average, $rating_count ); ?></span>
					<span><a href="#review_form">Write a review</a></span>
				<!-- </div> -->
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- END Reveiw info head goes here -->

<?php }



/**
 * Removes description tab from single product page
 */ 
add_filter( 'woocommerce_product_tabs', 'removeDescTabs', 50 );
function removeDescTabs( $tabs ) {
 	
 	// echo "<pre>";
 	// print_r($tabs);
 	// echo "</pre>";
	unset( $tabs['description'] );
	unset( $tabs['additional_information'] );
	return $tabs;
 
}

remove_action( 'woocommerce_sidebar', 'azirspares_related_products', 50 );

/**
 * YITH wishlist counter shortcode
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
  function yith_wcwl_get_items_count() {
    ob_start();
    ?>
        <span class="yith-wcwl-items-count">
          <i class=""><?php echo esc_html( yith_wcwl_count_all_products() ); ?></i>
          <span class="yith-item-lbl"><?php echo esc_html( yith_wcwl_count_all_products() ) > 1 ? 'Items' : 'Item' ?></span></label>
        </span>
    <?php
    return ob_get_clean();
  }

  add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
  function yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }

  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('.yith-wcwl-items-count').children('i').html( data.count );
              if( data.count > 1 ) { $('.yith-item-lbl').text(' Items') }
            } );
          } );
        } );
      "
    );
  }

  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}


/* keep image res orginal for the product thumb */
// add_filter( 'azirspares_resize_image', 'keep_original_product_img_thumb', 10, 5 );
// function keep_original_product_img_thumb( $attachment_id = null, $width, $height, $crop = true, $use_lazy = false ) {
// 	$original    = false;
// 	$image_src   = array();
// 	$enable_lazy = Azirspares_Functions::azirspares_get_option( 'azirspares_theme_lazy_load' );
// 	if ( $enable_lazy != 1 && $use_lazy == true )
// 		$use_lazy = false;
// 	if ( is_singular() && !$attachment_id ) {
// 		if ( has_post_thumbnail() && !post_password_required() ) {
// 			$attachment_id = get_post_thumbnail_id();
// 		}
// 	}
// 	if ( $attachment_id ) {
// 		$image_src        = wp_get_attachment_image_src( $attachment_id, 'full' );
// 		$actual_file_path = get_attached_file( $attachment_id );
// 	}
// 	print_r($image_src);
// 	if ( $width == false && $height == false ) {
// 		$original = true;
// 	}
// 	if ( !empty( $actual_file_path ) && file_exists( $actual_file_path ) ) {
// 		if ( $original == false && ( $image_src[1] > $width || $image_src[2] > $height ) ) {
// 			$file_info        = pathinfo( $actual_file_path );
// 			$extension        = '.' . $file_info['extension'];
// 			$no_ext_path      = $file_info['dirname'] . '/' . $file_info['filename'];
// 			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
// 			/* start */
// 			if ( file_exists( $cropped_img_path ) ) {
// 				$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
// 				$vt_image        = array(
// 					// 'url'    => $cropped_img_url,
// 					'url'    => $image_src[0],
// 					'width'  => $width,
// 					'height' => $height,
// 					'img'    => $this->azirspares_get_attachment_image( $attachment_id, $cropped_img_url, $width, $height, $use_lazy ),
// 				);

// 				return $vt_image;
// 			}
// 			if ( $crop == false ) {
// 				$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
// 				$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;
// 				if ( file_exists( $resized_img_path ) ) {
// 					$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
// 					$vt_image        = array(
// 						'url'    => $image_src[0],
// 						'width'  => $proportional_size[0],
// 						'height' => $proportional_size[1],
// 						'img'    => $this->azirspares_get_attachment_image( $attachment_id, $resized_img_url, $proportional_size[0], $proportional_size[1], $use_lazy ),
// 					);

// 					return $vt_image;
// 				}
// 			}
// 			/*no cache files - let's finally resize it*/
// 			$img_editor = wp_get_image_editor( $actual_file_path );
// 			if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
// 				return array(
// 					'url'    => '',
// 					'width'  => '',
// 					'height' => '',
// 					'img'    => '',
// 				);
// 			}
// 			$new_img_path = $img_editor->generate_filename();
// 			if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
// 				return array(
// 					'url'    => '',
// 					'width'  => '',
// 					'height' => '',
// 					'img'    => '',
// 				);
// 			}
// 			if ( !is_string( $new_img_path ) ) {
// 				return array(
// 					'url'    => '',
// 					'width'  => '',
// 					'height' => '',
// 					'img'    => '',
// 				);
// 			}
// 			$new_img_size = getimagesize( $new_img_path );
// 			$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
// 			$vt_image     = array(
// 				'url'    => $new_img,
// 				'width'  => $new_img_size[0],
// 				'height' => $new_img_size[1],
// 				'img'    => $this->azirspares_get_attachment_image( $attachment_id, $new_img, $new_img_size[0], $new_img_size[1], $use_lazy ),
// 			);

// 			return $vt_image;
// 		}
// 		$vt_image = array(
// 			'url'    => $image_src[0],
// 			'width'  => $image_src[1],
// 			'height' => $image_src[2],
// 			'img'    => $this->azirspares_get_attachment_image( $attachment_id, $image_src[0], $image_src[1], $image_src[2], $use_lazy ),
// 		);

// 		return $vt_image;
// 	} else {
// 		$width           = $width == false ? 1 : intval( $width );
// 		$height          = $height == false ? 1 : intval( $height );
// 		$url_placeholder = esc_url( '//via.placeholder.com/' . $width . 'x' . $height );
// 		$vt_image        = array(
// 			'url'    => $url_placeholder,
// 			'width'  => $width,
// 			'height' => $height,
// 			'img'    => ( $original == false ) ? $this->azirspares_get_attachment_image( $attachment_id, $url_placeholder, $width, $height, false ) : '',
// 		);

// 		// echo "ggooottooo? ";
// 		// print_r($vt_image);
// 		return $vt_image;
// 	}
// }

/**
 * Sort by name function by WP Helper
 *
 * https://wphelper.site/sort-alphabetically-option-default-woocommerce-sorting/
 */
add_filter( 'woocommerce_get_catalog_ordering_args', 'wphelper_woocommerce_get_catalog_ordering_args' );
function wphelper_woocommerce_get_catalog_ordering_args( $args ) {
    $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
 
    if ( 'alphabetical' == $orderby_value ) {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    }
 
    return $args;
}
 
add_filter( 'woocommerce_default_catalog_orderby_options', 'wphelper_woocommerce_catalog_orderby' );
 
add_filter( 'woocommerce_catalog_orderby', 'wphelper_woocommerce_catalog_orderby' );
function wphelper_woocommerce_catalog_orderby( $sortby ) {
    $sortby['alphabetical'] = __( 'Sort by name' );
    return $sortby;
}

/* Aaron Removing Dashboard Naviation my account */
function dt_login_redirect( $redirect, $user ) {

    $redirect_page_id = url_to_postid( $redirect );
    $checkout_page_id = wc_get_page_id( 'checkout' );

    if ($redirect_page_id == $checkout_page_id) {
        return $redirect;
    }

    return get_permalink(get_option('woocommerce_myaccount_page_id')) . 'orders/';

}

add_action('woocommerce_login_redirect', 'dt_login_redirect', 10, 2);

function dt_account_menu_items($items) {
    unset($items['dashboard']);
    return $items;            
}

add_filter ('woocommerce_account_menu_items', 'dt_account_menu_items');

/* Hide Sku, tags & categories single products */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
