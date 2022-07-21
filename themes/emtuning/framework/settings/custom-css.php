<?php
if ( !function_exists( 'azirspares_custom_inline_css' ) ) {
	function azirspares_custom_inline_css()
	{
		$css     = azirspares_theme_color();
		$css     .= azirspares_vc_custom_css_footer();
		$content = preg_replace( '/\s+/', ' ', $css );
		wp_add_inline_style( 'azirspares-style', $content );
	}
}
add_action( 'wp_enqueue_scripts', 'azirspares_custom_inline_css', 999 );
if ( !function_exists( 'azirspares_theme_color' ) ) {
	function azirspares_theme_color()
	{
		$main_color                         = Azirspares_Functions::azirspares_get_option( 'azirspares_main_color', '#eeab10' );
		$phone_bg                           = Azirspares_Functions::azirspares_get_option( 'header_phone_bg');
		$azirspares_enable_typography       = Azirspares_Functions::azirspares_get_option( 'azirspares_enable_typography' );
		$azirspares_typography_group        = Azirspares_Functions::azirspares_get_option( 'typography_group' );
        $azirspares_single_product_policy   = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_policy' );
		$css                     = '';
		if ( $azirspares_enable_typography == 1 && !empty( $azirspares_typography_group ) ) {
			foreach ( $azirspares_typography_group as $item ) {
				$css .= '
					' . $item['azirspares_element_tag'] . '{
						font-family: ' . $item['azirspares_typography_font_family']['family'] . ';
						font-weight: ' . $item['azirspares_typography_font_family']['variant'] . ';
						font-size: ' . $item['azirspares_typography_font_size'] . 'px;
						line-height: ' . $item['azirspares_typography_line_height'] . 'px;
						color: ' . $item['azirspares_body_text_color'] . ';
					}
				';
			}
		}
		$css .= '
		    .azirspares-banner.style4 .banner-inner .button,
			.post-password-form input[type="submit"]:hover,
            .woocommerce-error .button:hover, .woocommerce-info .button:hover, .woocommerce-message .button:hover,
            .widget_shopping_cart .woocommerce-mini-cart__buttons .button.checkout,
            #widget-area .widget .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit:hover,
            .fami-btn:hover,
            .slick-dots li button:hover,
            .slick-dots li.slick-active button,
            .block-menu-bar .menu-bar:hover span,
            .block-search .form-search .btn-submit,
            .chosen-results > .scroll-element .scroll-bar:hover,
            .block-minicart .cart_list > .scroll-element .scroll-bar:hover,
            .block-minicart .link-dropdown .count,
            .phone-header.style4 .phone-icon span,
            .header-nav.style1 .vertical-wrapper.block-nav-category .block-title::before,
            .burger-inner > .scroll-element .scroll-bar:hover,
            .header.style5 .header-middle-inner,
            .header.style5 .sticky-cart .block-minicart .link-dropdown .count,
            a.backtotop,
            .blog-grid .datebox a,
            .comment-form .form-submit #submit:hover,
            .page-title::before,
            .widget-azirspares-mailchimp .newsletter-form-wrap .submit-newsletter,
            #widget-area .widget_product_categories .widgettitle,
            .woocommerce-products-header .prdctfltr_wc .prdctfltr_filter_title .prdctfltr_title_selected,
            #yith-wcwl-popup-message,
            .product-item.style-06 .product-info .product-info-inner,
            .product-item.style-06 .product-info .product-info-inner:before,
            .product-item.style-07 .product-info .title .icon::before,
            .product-item.style-07 .product-info .title .icon span,
            .product-item.style-08 .product-info,
            a.xoo-cp-btn-ch,
            a.xoo-cp-btn-vc,
            a.xoo-cp-btn-vc,
            .entry-summary .cart .single_add_to_cart_button:hover,
            .sticky_info_single_product .azirspares-single-add-to-cart-btn:hover,
             #tab-description.active::before,
            body.woocommerce-cart .return-to-shop a:hover,
            .woocommerce-cart-form .shop_table .actions button.button:hover,
            .wc-proceed-to-checkout .checkout-button:hover,
            .checkout_coupon .button:hover,
            #place_order:hover,
            #customer_login > div > h2::before,
            form.woocommerce-form-login .button:hover,
            form.register .button:hover,
            .woocommerce-MyAccount-content fieldset ~ p .woocommerce-Button:hover,
            .woocommerce-ResetPassword .form-row .woocommerce-Button:hover,
            .woocommerce table.wishlist_table td.product-add-to-cart a:hover,
            .track_order .button:hover,
            body.error404 .error-404 .button:hover,
            .azirspares-banner .button,
            .azirspares-custommenu.style1 .widgettitle,
            .azirspares-iconbox.style1 .icon::before,
            .azirspares-iconbox.style1 .icon span,
            #widget-area .widget .select2-container--default .select2-selection--multiple .select2-selection__choice,
            .woocommerce-widget-layered-nav-dropdown .woocommerce-widget-layered-nav-dropdown__submit,
            .widget_price_filter .button,
            .widget_price_filter .ui-slider-range,
            .loadmore-product:hover span:first-child,
            .vertical-wrapper.block-nav-category .block-title,
            .azirspares-verticalmenu.block-nav-category .block-title,
            #widget-area .widget_azirspares_nav_menu .widgettitle,
            .fami-prdctfltr-product-filter .prdctfltr_woocommerce.pf_default .prdctfltr_woocommerce_filter_submit,
            body .fami-prdctfltr-product-filter .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label:hover,
            body .fami-prdctfltr-product-filter .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label.prdctfltr_active,
            .hebe .tp-bullet.selected::before,
            .hebe .tp-bullet:hover::before,
            .cart-link-mobile .count,
            .header-mobile .vertical-wrapper.block-nav-category .block-title::before,
            .azirspares-iconbox.style3 .iconbox-inner,
            .azirspares-iconbox.style7 .button,
            .azirspares-iconbox.style8 .icon::before,
            .azirspares-iconbox.style8 .icon span,
            .azirspares-iconbox.style9 .iconbox-inner,
            .azirspares-iconbox.style11 .button,
            .azirspares-iconbox.style14 .icon,
            .azirspares-blog.style1 .datebox a,
            .azirspares-iconbox.style15 .button:hover,
             .azirspares-listing.default .button,
            .azirspares-listing.style2 .button:hover,
            .wpcf7-form .wpcf7-submit:hover,
            .azirspares-newsletter.default .submit-newsletter,
            .azirspares-newsletter.style1 .submit-newsletter,
            .azirspares-newsletter.style2 .widgettitle,
            .azirspares-popupvideo .button:hover,
            .azirspares-socials.default .socials-list li a::before,
            #popup-newsletter .newsletter-form-wrap .submit-newsletter:hover,
            .azirspares-tabs.default .tab-link li a:hover,
            .azirspares-tabs.default .tab-link li.active a,
            .product-item.style-07 .onsale,
            .famiau-single-wrap .famiau-entry-header .famiau-title .famiau-price-html,
            .famiau-slider-nav .slick-arrow:hover,
            .famiau-tabs-wrap .famiau-tabs .famiau-box .famiau-box-heading,
            .azirspares-pricing.default .button,
            .azirspares-pricing.default.featured .pricing-inner,
            .famiau-item .famiau-price,
            .famiau-my-listing-wrap .famiau-button:hover,
            .product-item.style-06 .product-info .title::after,
            .widget_search .search-form button,
            .header.style6 .phone-header.style1 {
                background-color: ' . $main_color . ';
            }
            body div .ares .tp-bullet:hover,
            body div .ares .tp-bullet.selected,
            .hermes .tp-bullet::after,
            .hermes .tp-bullet:hover::after {
                background-color: ' . $main_color . ' !important;
            }
            .widget_shopping_cart .woocommerce-mini-cart__buttons .button:not(.checkout):hover,
            a:hover, a:focus, a:active,
            .nav-bottom-left .slick-arrow:hover,
            .nav-center .slick-arrow:hover,
            .header-top-inner .top-bar-menu > .menu-item a:hover,
            .header-top-inner .top-bar-menu > .menu-item:hover > a > span,
            .header-top-inner .top-bar-menu > .menu-item:hover > a,
            .wcml-dropdown .wcml-cs-submenu li:hover > a,
            .box-header-nav .main-menu .menu-item:hover > a,
            .box-header-nav .main-menu .menu-item .submenu .menu-item:hover > a,
            .box-header-nav .main-menu .menu-item:hover > .toggle-submenu,
            .box-header-nav .main-menu > .menu-item.menu-item-right:hover > a,
            .azirspares-live-search-form .product-price ins,
            .category .chosen-container .chosen-results li.highlighted,
            .category .chosen-container .chosen-results li.highlighted::before,
            .phone-header .phone-number p:last-child,
            .phone-header.style5 .phone-icon span,
            .burger-top-menu .phone-icon,
            .burger-icon-menu .menu-item .icon,
            .burger-list-menu .menu-item.show-sub > .toggle-submenu,
            .burger-list-menu .menu-item.show-sub > a,
            .burger-list-menu .menu-item:hover > .toggle-submenu,
            .burger-list-menu .menu-item:hover > a,
            .woocommerce-widget-layered-nav-list li.chosen a,
            .widget_categories .cat-item.current-cat > a,
            .widget_pages .page_item.current_page_item > a,
            .widget_product_categories .cat-item.current-cat > a,
            #widget-area .widget_product_categories .cat-item .carets:hover,
            body .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label:hover,
            body .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label.prdctfltr_active,
            .woocommerce-products-header .prdctfltr_wc .prdctfltr_filter_title > span.prdctfltr_woocommerce_filter_title:hover,
            .woocommerce-products-header .prdctfltr_wc .prdctfltr_filter_title .prdctfltr_active ~ span.prdctfltr_woocommerce_filter_title,
            .price ins,
            .post-item .slick-arrow:hover,
            .product-item.style-07 .gallery-dots .slick-arrow:hover,
            .product-item.style-08 .gallery-dots .slick-arrow:hover,
            .product-item.style-08 .product-info .title .icon span,
            span.xoo-cp-close:hover,
            .xcp-chng:hover,
            a.xoo-cp-close:hover,
            .product-360-button a,
            .single-left .product-video-button a,
            .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover,
            .entry-summary .yith-wcwl-add-to-wishlist a:hover::before,
            .entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:hover::before,
            .entry-summary .compare:hover::before,
            .famibt-wrap .total-price-html,
            .famibt-price ins,
            .shop_table .product-name a:not(.button):hover,
            .woocommerce-MyAccount-navigation > ul li.is-active a,
            .azirspares-banner .banner-info strong,
            .azirspares-banner .banner-info em,
            .azirspares-banner.style1 .banner-cat,
            .azirspares-banner.style2 .banner-inner .banner-info strong,
            .azirspares-banner.style2 .banner-inner .banner-info em,
            .azirspares-banner.style2 .title-hightlight,
            .azirspares-banner.style3 .title-hightlight,
            .azirspares-banner.style5 .title-hightlight,
            .azirspares-custommenu.style1 .menu > .menu-item.show-submenu > a,
            .azirspares-custommenu.style1 .menu > .menu-item:hover > a,
            .azirspares-iconbox.style2 .icon,
            .azirspares-iconbox.style4 .icon,
            .azirspares-iconbox.style5 .icon,
            .azirspares-iconbox.style8 .title,
            .azirspares-iconbox.style9 .icon span,
            .azirspares-iconbox.style16 .icon,
            #popup-newsletter .highlight,
            #popup-newsletter button.close:hover,
            .vertical-menu.default .menu-item.parent:hover > a::after,
            .vertical-menu.default > .menu-item:hover > a,
            .vertical-menu.default > .menu-item.show-submenu > a,
            .vertical-menu.default > .menu-item.parent:hover > a::after,
            .vertical-menu.default > .menu-item.show-submenu > a::after,
            .vertical-menu.default .menu-item.parent:hover > .toggle-submenu,
            .vertical-menu.default .menu-item.show-submenu > .toggle-submenu,
            .vertical-menu.style1 .menu-item:hover > a,
            .vertical-menu.style1 .menu-item.show-submenu > a,
            .vertical-menu.style1 .menu-item.parent:hover > a::after,
            .vertical-menu.style1 .menu-item.show-submenu > a::after,
            .vertical-menu.style1 .menu-item.parent:hover > .toggle-submenu,
            .vertical-menu.style1 .menu-item.show-submenu > .toggle-submenu,
            body .vc_toggle_default.vc_toggle_active .vc_toggle_title > h4,
            #order_review .shop_table tfoot tr.order-total td strong,
            .famiau-dealer-info .dealer-contact-unit i,
            .famiau-dealer-info .famiau-show-number:hover,
            .famiau-play-video,
            .famiau-filter-menu .famiau-menu-item .famiau-sub-nav .famiau-menu-item .famiau-filter-item.famiau-active-filter,
            .famiau-filter-menu .famiau-menu-item .famiau-sub-nav .famiau-menu-item .famiau-filter-item:hover,
            .header.style6 .phone-header.style1 .phone-icon span,
            .hurry-title span {
                color: ' . $main_color . ';
            }
            body.wpb-js-composer .vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a {
                color: ' . $main_color . ' !important;
            }
            .countdown-product .azirspares-countdown > span .number,
            .header.style4 .vertical-wrapper.block-nav-category .block-content,
            #widget-area .widget_product_categories .product-categories,
             body .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label:hover > span::before,
            .product-item.style-07 .gallery-dots .slick-current img,
            .product-item.style-08 .gallery-dots .slick-current img,
            .azirspares-custommenu.style1 .widget,
            .woocommerce-product-gallery .flex-control-nav.flex-control-thumbs li img.flex-active,
            #popup-newsletter .newsletter-form-wrap .email,
            .azirspares-testimonial.style1 figure,
            .widget_azirspares_nav_menu .vertical-menu.style1,
            .azirspares-verticalmenu.block-nav-category .block-content,
            .famiau-dealer-info .famiau-show-number:hover::before {
                border-color: ' . $main_color . ';
            }
            .hebe .tp-bullet.selected,
            .hebe .tp-bullet:hover {
                border-color: ' . $main_color . ' !important;
            }
            .menu-social a:hover,
            .header.style5 .header-burger .burger-icon,
            .phone-header.style3 .phone-icon span,
            .famibt-wrap .btn-primary:hover,
            .azirspares-iconbox.default .icon span,
            .azirspares-socials.style1 .content-socials .socials-list li a:hover {
                border-color: ' . $main_color . ';
                color: ' . $main_color . ';
            }
            .nav-top-right .slick-arrow:hover,
            .nav-center.square .slick-arrow:hover,
            .azirspares-tabs.style2 .tab-link .slick-arrow:hover,
            body .prdctfltr_wc.prdctfltr_round .prdctfltr_filter label.prdctfltr_active > span::before,
            .product-item.style-01 .group-button .yith-wcwl-add-to-wishlist:hover,
            .product-item.style-01 .group-button .compare-button:hover,
            .product-item.style-01 .group-button .yith-wcqv-button:hover,
            .product-item.style-03 .group-button .add-to-cart:hover,
            .product-item.style-03 .group-button .compare-button:hover,
            .product-item.style-03 .group-button .yith-wcqv-button:hover,
            .product-item.style-04 .group-button .yith-wcwl-add-to-wishlist:hover,
            .product-item.style-04 .group-button .compare-button:hover,
            .product-item.style-04 .group-button .yith-wcqv-button:hover,
            .product-item.style-10 .group-button .yith-wcwl-add-to-wishlist:hover,
            .product-item.style-10 .group-button .compare-button:hover,
            .product-item.style-10 .group-button .yith-wcqv-button:hover,
            .product-item.list .group-button .add-to-cart:hover,
            .product-item.list .group-button .compare-button:hover,
            .product-item.list .group-button .yith-wcwl-add-to-wishlist:hover,
            .categories-product-woo .block-title a:hover,
            .categories-product-woo .slick-arrow:hover,
            a.dokan-btn-theme,
            a.dokan-btn-theme:hover,
            input[type="submit"].dokan-btn-theme,
            input[type="submit"].dokan-btn-theme:hover,
            .azirspares-heading.style1 .button:hover,
            .azirspares-listing.style2 .listing-list li:hover a,
            .azirspares-tabs.style1 .tab-link li a:hover,
            .azirspares-tabs.style1 .tab-link li.active a,
            .azirspares-tabs.style4 .tab-link li:hover a,
            .azirspares-tabs.style4 .tab-link li.active a,
            .azirspares-tabs.style5 .tab-link li a:hover,
            .azirspares-tabs.style5 .tab-link li.active a,
            .famiau-filter-menu > .famiau-menu-item > .famiau-filter-item.famiau-active-filter,
            .famiau-filter-menu > .famiau-menu-item > .famiau-filter-item:hover,
            .famiau-filter-menu > .famiau-menu-item:hover > .famiau-filter-item,
            .widget-azirspares-socials .socials-list li a:hover {
                background-color: ' . $main_color . ';
                border-color: ' . $main_color . ';
            }
            .azirspares-mapper .azirspares-pin .azirspares-popup-footer a:hover {
                background: ' . $main_color . ' !important;
                border-color: ' . $main_color . ' !important;
            }
            .azirspares-live-search-form.loading .search-box::before {
                border-top-color: ' . $main_color . ';
            }
            .header-nav.style1 .vertical-wrapper.block-nav-category .block-title::after {
                border-color: transparent ' . $main_color . ' transparent transparent;
            }
            .product-item.style-06 .product-info .product-info-inner:after {
                border-color: ' . $main_color . ' transparent transparent transparent;
            }
             .blog-grid .datebox a::before,
            .azirspares-blog.style1 .datebox a::before {
                border-color: ' . $main_color . ' transparent ' . $main_color . ' transparent;
            }
            .blog-grid .datebox a span::before,
            .azirspares-blog.style1 .datebox a span::before {
                border-color: transparent transparent ' . $main_color . ' transparent;
            }
            .azirspares-iconbox.style15 .icon .product-video-button a::after,
            .azirspares-popupvideo .icon .product-video-button a::after {
                border-color: transparent transparent transparent ' . $main_color . ';
            }
            .burger-mid-menu .burger-title > span span,
            .menu-social h4::before,
            .blog-grid .title span::before,
            .wc-tabs li a::before,
            .azirspares-blog.default .post-title::before,
            .azirspares-blog.style1 .title span::before,
            .azirspares-heading.default .title span::before,
            .azirspares-heading.style2 .title::before,
            .azirspares-heading.style3 .title::before,
            .azirspares-heading.style4 .title::before,
            .azirspares-iconbox.style15 .title::before,
            .azirspares-iconbox.style16 .iconbox-inner::before,
            .azirspares-instagram .widgettitle::before,
            .azirspares-listing.style1 .cat-name::before,
            .azirspares-popupvideo .title::before,
            .azirspares-tabs.style4 .tab-head .title::before,
            .azirspares-tabs.style6 .tab-link li a::before {
                border-bottom-color: ' . $main_color . ';
            }
            blockquote, q,
            .azirspares-tabs.style2 .tab-link li a::before {
                border-left-color: ' . $main_color . ';
            }
            .azirspares-tabs.default .tab-head .title::before,
            h3.title-share::before {
                border-bottom-color: ' . $main_color . ';
            }
            .famiau-slider-range-wrap .ui-slider .ui-slider-handle,
            .button-share:hover {
                background:  ' . $main_color . ';
            }
            .famiau-filter-box-left label::before {
                border-color: transparent transparent transparent  ' . $main_color . ';
            }
            @media (min-width: 1200px) {
                .header.style5 .header-position.fixed {
                    background-color: ' . $main_color . ';
                }
            }
            @media (max-width: 1199px) {
                .product-item.style-08 .product-inner::before {
                    background-color: ' . $main_color . ';
                }
            } 
            @media (max-width: 767px) {
            .woocommerce-products-header .prdctfltr_wc .prdctfltr_filter_title span.prdctfltr_title_selected {
                    background-color: ' . $main_color . ';
                }
            }      
		';
        if(isset($phone_bg) && $phone_bg != '') {
            $css .= '
            .phone-header.style1,
            .phone-header.style1.style2,
            .header.style6 .phone-header.style1 {
                background-color: ' . $phone_bg . ';
            }
            .phone-header.style1 .phone-icon span,
            .phone-header.style1.style2 .phone-icon span,
            .header.style6 .phone-header.style1 .phone-icon span {
                color: ' . $phone_bg . ';
            }
            ';
        }
        /* GET CUSTOM POLICY */
        if ( $azirspares_single_product_policy )
            $css .= get_post_meta( $azirspares_single_product_policy, '_Azirspares_Shortcode_custom_css', true );
		return apply_filters( 'azirspares_main_custom_css', $css );
	}
}
if ( !function_exists( 'azirspares_vc_custom_css_footer' ) ) {
	function azirspares_vc_custom_css_footer()
	{
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$footer_options      = Azirspares_Functions::azirspares_get_option( 'azirspares_footer_options' );
		$footer_options      = isset( $data_meta['metabox_azirspares_footer_options'] ) && $data_meta['metabox_azirspares_footer_options'] != '' ? $data_meta['metabox_azirspares_footer_options'] : $footer_options;
		if ( !$footer_options ) {
			$query = new WP_Query( array( 'p' => $footer_options, 'post_type' => 'footer', 'posts_per_page' => 1 ) );
			while ( $query->have_posts() ): $query->the_post();
				$footer_options = get_the_ID();
			endwhile;
		}
		$shortcodes_custom_css = get_post_meta( $footer_options, '_Azirspares_Shortcode_custom_css', true );

		return $shortcodes_custom_css;
	}
}
if ( !function_exists( 'azirspares_write_custom_js ' ) ) {
	function azirspares_write_custom_js()
	{
		$azirspares_custom_js = Azirspares_Functions::azirspares_get_option( 'azirspares_custom_js', '' );
		$content         = preg_replace( '/\s+/', ' ', $azirspares_custom_js );
		wp_add_inline_script( 'azirspares-script', $content );
	}
}
add_action( 'wp_enqueue_scripts', 'azirspares_write_custom_js' );