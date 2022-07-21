<?php
/**
 * Name:  Header style 06
 **/
?>
<?php
$azirspares_icon = Azirspares_Functions::azirspares_get_option('header_icon');
$azirspares_phone = Azirspares_Functions::azirspares_get_option('header_phone');
$azirspares_text = Azirspares_Functions::azirspares_get_option('header_text');
$enable_sticky = Azirspares_Functions::azirspares_get_option('azirspares_enable_sticky_menu');
$enable_header_mobile = Azirspares_Functions::azirspares_get_option('enable_header_mobile');
$class = array('header', 'style6');
if ($enable_sticky == 1)
    $class[] = 'header-sticky';
if (($enable_header_mobile == 1) && (azirspares_is_mobile())) {
    get_template_part('templates/header', 'mobile');
} else { ?>
    <header id="header" class="<?php echo esc_attr(implode(' ', $class)); ?>">
        <?php azirspares_header_background(); ?>
        <?php if (has_nav_menu('top_left_menu') || has_nav_menu('top_right_menu')): ?>
            <div class="header-top style1">
                <div class="container">
                    <div class="header-top-inner">
                        <?php
                        if (has_nav_menu('top_left_menu')) {
                            wp_nav_menu(array(
                                    'menu' => 'top_left_menu',
                                    'theme_location' => 'top_left_menu',
                                    'depth' => 1,
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => 'azirspares-nav top-bar-menu',
                                    'fallback_cb' => 'Azirspares_navwalker::fallback',
                                    'walker' => new Azirspares_navwalker(),
                                )
                            );
                        }
                        if (has_nav_menu('top_right_menu')) {
                            wp_nav_menu(array(
                                    'menu' => 'top_right_menu',
                                    'theme_location' => 'top_right_menu',
                                    'depth' => 1,
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => 'azirspares-nav top-bar-menu right',
                                    'fallback_cb' => 'Azirspares_navwalker::fallback',
                                    'walker' => new Azirspares_navwalker(),
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="header-wrap-stick">
            <div class="header-position">
                <div class="header-middle">
                    <div class="container">
                        <div class="header-middle-inner">
                            <div class="header-logo">
								<?php azirspares_search_form(); ?>
                            </div>
                            <div class="logocont">
                                 <?php azirspares_get_logo(); ?>
                             </div>
                            <div class="header-control">
                                <div class="header-control-inner">
									<div class="meta-woo">
                                        <?php azirspares_header_burger(); ?>
                                        <div class="block-menu-bar">
                                            <a class="menu-bar menu-toggle" href="#">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a>
                                        </div>
                                        <div class="block-wishlist block-woo">
                                            <?php 
                                            if ( !is_user_logged_in() ) { ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/usericon.png">
                                                <div class="cartright">
                                                    <label>Guest</label>
                                                    <span>My Account</span>
                                                </div>
                                            </a>
                                            <?php } else { global $current_user; wp_get_current_user();
                                                ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/usericon.png">
                                                <div class="cartright">
                                                    <label><?php echo $current_user->display_name; ?></label>
                                                    <span>My Account</span>
                                                </div>
                                            </a>
                                            <?php 
                                            } 
                                        ?>
                                        </div>
                                        <div class="menu-item block-user block-woo">
                                            <a href="/wishlist/">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wishlisticon.png">
                                                <div class="cartright">
                                                    <label><?php echo do_shortcode('[yith_wcwl_items_count]'); ?> 
                                                    <!-- <span class="yith-item-lbl">Item</span></label> -->
                                                    <span>Wishlist</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="menu-item block-user block-woo">
                                            <a href="<?php global $woocommerce; echo wc_get_cart_url() ?>">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/carticon.png">
                                                <div class="cartright">
                                                    <label><?php echo $woocommerce->cart->cart_contents_count; ?><?php echo $woocommerce->cart->cart_contents_count > 1 ? ' Items' : ' Item'; ?></label>
                                                    <span>Basket</span>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                            /*do_action('azirspares_header_wishlist');
                                            azirspares_user_link();
                                            do_action('azirspares_header_mini_cart');*/
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="sticky-cart"><?php do_action('azirspares_header_mini_cart'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav style1">
            <div class="container">
                <div class="azirspares-menu-wapper"></div>
                <div class="header-nav-inner">
                    <div class="box-header-nav">
                        <?php
                        wp_nav_menu(array(
                                'menu' => 'primary',
                                'theme_location' => 'primary',
                                'depth' => 3,
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'clone-main-menu azirspares-clone-mobile-menu azirspares-nav main-menu',
                                'fallback_cb' => 'Azirspares_navwalker::fallback',
                                'walker' => new Azirspares_navwalker(),
                            )
                        );
                        ?>
                    </div>
                    <?php if ($azirspares_phone) : ?>
                        <div class="phone-header style1">
                            <div class="phone-inner">
                                <?php if ($azirspares_icon) : ?>
                                    <span class="phone-icon">
                                        <span class="<?php echo esc_attr($azirspares_icon); ?>"></span>
                                    </span>
                                <?php endif; ?>
                                <div class="phone-number">
                                    <p><?php echo esc_html($azirspares_text); ?></p>
                                    <p><?php echo esc_html($azirspares_phone); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
<?php } ?>