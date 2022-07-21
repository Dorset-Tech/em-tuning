<?php
/**
 * Azirspares Visual composer setup
 *
 * @author   KHANH
 * @category API
 * @package  Azirspares_Visual_composer
 * @since    1.0.0
 */
if ( !function_exists( 'azirspares_custom_param_vc' ) ) {
    add_filter('vc_google_fonts_get_fonts_filter', 'azirspares_vc_fonts');
    if (!function_exists('azirspares_vc_fonts')) {
        function azirspares_vc_fonts($fonts_list)
        {
            $rubik = new stdClass();
            $rubik->font_family = 'Rubik';
            $rubik->font_styles = "300,300i,400,400i,500,500i,700,700i,900,900i";
            $rubik->font_types = '300 light :300:normal,300 light italic :300:italic,400 regular :400:normal,400 regular italic :400:italic,500 medium :500:normal,500 medium italic :500:italic,700 bold :700:normal,700 bold italic :700:italic,900 black :900:normal,900 black italic :900:italic';
            $fonts_list[] = $rubik;

            return $fonts_list;
        }
    }
	// add_filter( 'azirspares_add_param_visual_composer', 'azirspares_custom_param_vc' );
	function azirspares_custom_param_vc( $param )
	{
        if (get_current_user_id() == 1) {
            echo "<pre>";
            print_r($param);
            exit;
        }
        $param['azirspares_banner']   = array(
            'base'        => 'azirspares_banner',
            'name'        => esc_html__( 'Azirspares: Banner', 'azirspares' ),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/banner.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Custom Banner', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style1.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style2.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 03', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style3.jpg' ),
                        ),
                        'style4' => array(
                            'title'   => esc_html__( 'Style 04', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style4.jpg' ),
                        ),
                        'style5' => array(
                            'title'   => esc_html__( 'Style 05', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style5.jpg' ),
                        ),
                        'style6' => array(
                            'title'   => esc_html__( 'Style 06', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style6.jpg' ),
                        ),
                        'style7' => array(
                            'title'   => esc_html__( 'Style 07', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/banner/style7.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Label text', 'azirspares' ),
                    'param_name'  => 'label_text',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'default' ),
                    ),
                ),
                array(
                    'param_name'  => 'banner',
                    'heading'     => esc_html__( 'Banner Image', 'azirspares' ),
                    'type'        => 'attach_image',
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Border Content', 'azirspares' ),
                    'param_name' => 'border',
                    'value'      => array(
                        esc_html__( 'No Border', 'azirspares' )  => '',
                        esc_html__( 'Has Border', 'azirspares' ) => 'border',
                    ),
                    'std'         => '',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style2' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Content Align', 'azirspares' ),
                    'param_name' => 'align',
                    'value'      => array(
                        esc_html__( 'Content Left', 'azirspares' )    => 'left',
                        esc_html__( 'Content Center', 'azirspares' )  => 'center',
                    ),
                    'std'         => 'left',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Content Position', 'azirspares' ),
                    'param_name' => 'position',
                    'value'      => array(
                        esc_html__( 'Content Top', 'azirspares' )    => 'content-top',
                        esc_html__( 'Content Bottom', 'azirspares' ) => 'content-bottom',
                        esc_html__( 'Content Center', 'azirspares' ) => 'content-center',
                    ),
                    'std'         => 'top',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style5' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Category', 'azirspares' ),
                    'param_name'  => 'category',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title Hightlight', 'azirspares' ),
                    'param_name'  => 'title_hightlight',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1','style2','style3','style4','style5','style6'),
                    ),
                ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Description', 'azirspares' ),
                    'param_name'  => 'content',
                    'description' => esc_html__( 'Strong or em tag to hightlight text.', 'azirspares' ),
                ),
                array(
                    'param_name' => 'link',
                    'heading'    => esc_html__( 'Button', 'azirspares' ),
                    'type'       => 'vc_link',
                ),

            ),
        );
        $param['azirspares_blog'] = array(
            'base' => 'azirspares_blog',
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/blog.png'),
            'name' => esc_html__('Azirspares: Blog', 'azirspares'),
            'category' => esc_html__('Azirspares Shortcode', 'azirspares'),
            'description' => esc_html__('Display Post, Custom Post Type', 'azirspares'),
            'params' => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Use Icon', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'No Icon', 'azirspares' )   => '',
                        esc_html__( 'Use icon', 'azirspares' )   => 'has-icon',
                    ),
                    'param_name'  => 'has_icon',
                    'default'     => '',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                        esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                        esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                        esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                        esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                        esc_html__( 'Material', 'azirspares' )     => 'material',
                        esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                    'dependency'  => array(
                        'element'    => 'has_icon',
                        'value'      => array('has-icon'),
                    ),
                ),
                array(
                    'param_name'  => 'icon_azirsparescustomfonts',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'azirsparescustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'azirsparescustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'azirspares' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Blog List style', 'azirspares'),
                    'param_name' => 'productsliststyle',
                    'value' => array(
                        esc_html__('Grid Bootstrap', 'azirspares') => 'grid',
                        esc_html__('Owl Carousel', 'azirspares') => 'owl',
                    ),
                    'description' => esc_html__('Select a style for list', 'azirspares'),
                    'std' => 'owl',
                ),
                array(
                    'type' => 'loop',
                    'heading' => esc_html__('Option Query', 'azirspares'),
                    'param_name' => 'loop',
                    'save_always' => true,
                    'value' => 'post_type:post|size:5|order_by:date',
                    'settings' => array(
                        'size' => array(
                            'hidden' => false,
                            'value' => 6,
                        ),
                        'order_by' => array('value' => 'date'),
                    ),
                    'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'azirspares'),
                ),
                array(
                    'type' => 'select_preview',
                    'heading' => esc_html__('Blog style', 'azirspares'),
                    'value' => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/blog/default.jpg'),
                        ),
                        'style1' => array(
                            'title' => esc_html__('Style 01', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/blog/style1.jpg'),
                        ),
                    ),
                    'default' => 'default',
                    'admin_label' => true,
                    'param_name' => 'style',
                    'description' => esc_html__('Select a style for blog item', 'azirspares'),
                ),
            ),
        );
        /* Map New Categories */
        $categories_array = array(
            esc_html__( 'All', 'azirspares' ) => '',
        );
        $args             = array();
        $categories       = get_categories( $args );
        foreach ( $categories as $category ) {
            $categories_array[$category->name] = $category->slug;
        }
        $param['azirspares_category']   = array(
            'base'        => 'azirspares_category',
            'name'        => esc_html__( 'Azirspares: Category', 'azirspares' ),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/cat.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Custom Category Product', 'azirspares' ),
            'params'      => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Category List style', 'azirspares'),
                    'param_name' => 'productsliststyle',
                    'value' => array(
                        esc_html__('Grid Bootstrap', 'azirspares') => 'grid',
                        esc_html__('Owl Carousel', 'azirspares') => 'owl',
                    ),
                    'description' => esc_html__('Select a style for list', 'azirspares'),
                    'std' => 'owl',
                ),
                array(
                    'type' => 'select_preview',
                    'heading' => esc_html__('Category style', 'azirspares'),
                    'value' => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/category/default.jpg'),
                        ),
                    ),
                    'default' => 'default',
                    'admin_label' => true,
                    'param_name' => 'style',
                    'description' => esc_html__('Select a style for category', 'azirspares'),
                ),
                array(
                    'type'        => 'taxonomy',
                    'heading'     => esc_html__( 'Product Category', 'azirspares' ),
                    'param_name'  => 'taxonomy',
                    'options'     => array(
                        'multiple'   => true,
                        'hide_empty' => true,
                        'taxonomy'   => 'product_cat',
                    ),
                    'placeholder' => esc_html__( 'Choose category', 'azirspares' ),
                    'description' => esc_html__( 'Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'azirspares' ),
                ),
            ),
        );

        /* Map New Custom menu */
        $all_menu = array();
        $menus    = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( $menus && count( $menus ) > 0 ) {
            foreach ( $menus as $m ) {
                $all_menu[$m->name] = $m->slug;
            }
        }
        require_once vc_path_dir('CONFIG_DIR', 'content/vc-icon-element.php');
        $icon_params = array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link Social', 'azirspares'),
                'param_name' => 'link_social',
                'admin_label' => true,
                'description' => esc_html__('shortcode title.', 'azirspares'),
            ),
        );
        $icon_params = array_merge($icon_params, (array)vc_map_integrate_shortcode(
            vc_icon_element_params(), 'i_', '',
            array(
                // we need only type, icon_fontawesome, icon_.., NOT color and etc
                'include_only_regex' => '/^(type|icon_\w*)/',
            )
        )
        );
        $param['azirspares_custommenu'] = array(
            'base'        => 'azirspares_custommenu',
            'name'        => esc_html__( 'Azirspares: Custom Menu', 'azirspares' ),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/custom-menu.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Custom Menu', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/custommenu/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/custommenu/style1.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Choose type color', 'azirspares' ),
                    'param_name'  => 'type_color',
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )          => 'dark',
                        esc_html__( 'Light', 'azirspares' )         => 'light',
                    ),
                    'std'         => 'dark',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'default' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'azirspares' ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Menu', 'azirspares' ),
                    'value'       => $all_menu,
                    'admin_label' => true,
                    'param_name'  => 'nav_menu',
                    'description' => esc_html__( 'Select menu to display.', 'azirspares' ),
                ),
            ),
        );
        $param['azirspares_heading']    = array(
            'base'        => 'azirspares_heading',
            'name'        => esc_html__( 'Azirspares: Custom Heading', 'azirspares' ),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/section-title.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Custom Heading', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/default.jpg' ),
                        ),
                        'style1'  => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/style1.jpg' ),
                        ),
                        'style2'  => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/style2.jpg' ),
                        ),
                        'style3'  => array(
                            'title'   => esc_html__( 'Style 03', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/style3.jpg' ),
                        ),
                        'style4'  => array(
                            'title'   => esc_html__( 'Style 04', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/style4.jpg' ),
                        ),
                        'style5'  => array(
                            'title'   => esc_html__( 'Style 05', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/heading/style5.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Choose type color', 'azirspares' ),
                    'param_name'  => 'type_color',
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )          => 'dark',
                        esc_html__( 'Light', 'azirspares' )         => 'light',
                    ),
                    'std'         => 'dark',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('default','style1'),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                        esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                        esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                        esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                        esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                        esc_html__( 'Material', 'azirspares' )     => 'material',
                        esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style5'),
                    ),
                ),
                array(
                    'param_name'  => 'icon_azirsparescustomfonts',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'azirsparescustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'azirsparescustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'azirspares' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Descriptions', 'azirspares' ),
                    'param_name'  => 'desc',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link', 'azirspares' ),
                    'param_name'  => 'link',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
            ),
        );
        $param['azirspares_iconbox']    = array(
            'base'        => 'azirspares_iconbox',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/iconbox.png'),
            'name'        => esc_html__( 'Azirspares: Icon Box', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Icon Box', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/default.jpg' ),
                        ),
                        'style1'  => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style1.jpg' ),
                        ),
                        'style2'  => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style2.jpg' ),
                        ),
                        'style3'  => array(
                            'title'   => esc_html__( 'Style 03', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style3.jpg' ),
                        ),
                        'style4'  => array(
                            'title'   => esc_html__( 'Style 04', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style4.jpg' ),
                        ),
                        'style5'  => array(
                            'title'   => esc_html__( 'Style 05', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style5.jpg' ),
                        ),
                        'style6'  => array(
                            'title'   => esc_html__( 'Style 06', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style6.jpg' ),
                        ),
                        'style7'  => array(
                            'title'   => esc_html__( 'Style 07', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style7.jpg' ),
                        ),
                        'style8'  => array(
                            'title'   => esc_html__( 'Style 08', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style8.jpg' ),
                        ),
                        'style9'  => array(
                            'title'   => esc_html__( 'Style 09', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style9.jpg' ),
                        ),
                        'style10'  => array(
                            'title'   => esc_html__( 'Style 10', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style10.jpg' ),
                        ),
                        'style11'  => array(
                            'title'   => esc_html__( 'Style 11', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style11.jpg' ),
                        ),
                        'style12'  => array(
                            'title'   => esc_html__( 'Style 12', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style12.jpg' ),
                        ),
                        'style13'  => array(
                            'title'   => esc_html__( 'Style 13', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style13.jpg' ),
                        ),
                        'style14'  => array(
                            'title'   => esc_html__( 'Style 14', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style14.jpg' ),
                        ),
                        'style16'  => array(
                            'title'   => esc_html__( 'Style 15', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style16.jpg' ),
                        ),
                        'style17'  => array(
                            'title'   => esc_html__( 'Style 16', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style17.jpg' ),
                        ),
                        'style18'  => array(
                            'title'   => esc_html__( 'Style 17', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/iconbox/style18.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Choose type color', 'azirspares' ),
                    'param_name'  => 'type_color',
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )          => 'dark',
                        esc_html__( 'Light', 'azirspares' )         => 'light',
                    ),
                    'std'         => 'dark',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style2','style9','style12'),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select icon or image', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Icon', 'azirspares' )   => 'icon',
                        esc_html__( 'Image', 'azirspares' )  => 'image',
                    ),
                    'param_name'  => 'upload',
                    'default'     => 'icon',
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Image', 'azirspares'),
                    'param_name' => 'image',
                    'dependency'  => array(
                        'element' => 'upload',
                        'value'   => array('image'),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                        esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                        esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                        esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                        esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                        esc_html__( 'Material', 'azirspares' )     => 'material',
                        esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                    'dependency'  => array(
                        'element' => 'upload',
                        'value'   => array( 'icon' ),
                    ),
                ),
                array(
                    'param_name'  => 'icon_azirsparescustomfonts',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'azirsparescustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'azirsparescustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'azirspares' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('default','style3','style4','style5','style6','style7','style8','style9','style12','style13','style14','style15','style16','style17','style18'),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Description', 'azirspares' ),
                    'param_name'  => 'desc',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('default','style2','style3','style4','style5','style6','style7','style9','style11','style12','style13','style14','style15','style18'),
                    ),
                ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Content', 'azirspares' ),
                    'param_name'  => 'content',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style9'),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Text icon', 'azirspares' ),
                    'param_name'  => 'texticon',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style9'),
                    ),
                ),
                array(
                    'param_name' => 'link',
                    'heading'    => esc_html__( 'Button', 'azirspares' ),
                    'type'       => 'vc_link',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style7','style11','style12','style13','style15','style17'),
                    ),
                ),
                array(
                    'param_name' => 'color_btn',
                    'heading'    => esc_html__( 'Color Button', 'azirspares' ),
                    'type'       => 'colorpicker',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style12','style13'),
                    ),
                ),
            ),
        );
        $param['azirspares_popupvideo']    = array(
            'base'        => 'azirspares_popupvideo',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/iconbox.png'),
            'name'        => esc_html__( 'Azirspares: Popup Video', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Popup Video', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/popupvideo/default.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Image', 'azirspares'),
                    'param_name' => 'image',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Description', 'azirspares' ),
                    'param_name'  => 'desc',
                ),
                array(
                    'param_name' => 'link',
                    'heading'    => esc_html__( 'Button', 'azirspares' ),
                    'type'       => 'vc_link',
                ),
            ),
        );
        $param['azirspares_pricing']     = array(
            'base'        => 'azirspares_pricing',
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/fullpage.png'),
            'name'        => esc_html__( 'Azirspares: Pricing', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Pricing', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/pricing/default.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Featured', 'azirspares' ),
                    'param_name'  => 'featured',
                    'value'       => array(
                        esc_html__( 'Normal', 'azirspares' )     => '',
                        esc_html__( 'Featured', 'azirspares' )   => 'featured',
                    ),
                    'std'         => '',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Currency', 'azirspares' ),
                    'param_name'  => 'currency',
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => esc_html__( 'Pricing Items', 'azirspares' ),
                    'param_name' => 'pricing_item',
                    'params'     => array(
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'azirspares' ),
                            'param_name'  => 'title_item',
                            'admin_label' => true,
                        ),
                    ),
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Pricing Link', 'azirspares' ),
                    'param_name' => 'link',
                ),
            ),
        );
        $param['azirspares_instagram']  = array(
            'base'        => 'azirspares_instagram',
            'name'        => esc_html__( 'Azirspares: Instagram', 'azirspares' ),
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/instagram.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Instagram', 'azirspares' ),
            'params'      => array(
                array(
                    'type' => 'select_preview',
                    'heading' => esc_html__('Select style', 'azirspares'),
                    'value' => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/instagram/default.jpg'),
                        ),
                    ),
                    'default' => 'default',
                    'admin_label' => true,
                    'param_name' => 'style',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'description' => esc_html__( 'The title of shortcode', 'azirspares' ),
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Instagram style', 'azirspares' ),
                    'param_name' => 'productsliststyle',
                    'value'      => array(
                        esc_html__( 'Grid Bootstrap', 'azirspares' ) => 'grid',
                        esc_html__( 'Owl Carousel', 'azirspares' )   => 'owl',
                    ),
                    'std'        => 'grid',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Image Resolution', 'azirspares' ),
                    'param_name' => 'image_resolution',
                    'value'      => array(
                        esc_html__( 'Thumbnail', 'azirspares' )           => 'thumbnail',
                        esc_html__( 'Low Resolution', 'azirspares' )      => 'low_resolution',
                        esc_html__( 'Standard Resolution', 'azirspares' ) => 'standard_resolution',
                    ),
                    'std'        => 'thumbnail',
                    'dependency' => array(
                        'element' => 'image_source',
                        'value'   => array( 'instagram' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'ID Instagram', 'azirspares' ),
                    'param_name'  => 'id_instagram',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'image_source',
                        'value'   => array( 'instagram' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Token Instagram', 'azirspares' ),
                    'param_name'  => 'token',
                    'dependency'  => array(
                        'element' => 'image_source',
                        'value'   => array( 'instagram' ),
                    ),
                    'description' => wp_kses( sprintf( '<a href="%s" target="_blank">' . esc_html__( 'Get Token Instagram Here!', 'azirspares' ) . '</a>', 'http://instagram.pixelunion.net' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
                ),
                array(
                    'type'        => 'number',
                    'heading'     => esc_html__( 'Items Instagram', 'azirspares' ),
                    'param_name'  => 'items_limit',
                    'description' => esc_html__( 'the number items show', 'azirspares' ),
                    'std'         => '8',
                    'dependency'  => array(
                        'element' => 'image_source',
                        'value'   => array( 'instagram' ),
                    ),
                ),
            ),
        );
        $param['azirspares_listing']   = array(
            'base'        => 'azirspares_listing',
            'name'        => esc_html__( 'Azirspares: List Item', 'azirspares' ),
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/title-short-desc.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Custom List Item', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/listing/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/listing/style1.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/listing/style2.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 03', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/listing/style3.jpg' ),
                        ),
                        'style4' => array(
                            'title'   => esc_html__( 'Style 04', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/listing/style4.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select type color', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )   => 'dark',
                        esc_html__( 'Light', 'azirspares' )   => 'light',
                    ),
                    'param_name'  => 'type_color',
                    'default'     => 'dark',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style1'),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select type border', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'No Border', 'azirspares' )   => '',
                        esc_html__( 'Has Border', 'azirspares' )   => 'has-border',
                    ),
                    'param_name'  => 'type_border',
                    'default'     => '',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('style3'),
                    ),
                ),
                array(
                    'param_name'  => 'banner',
                    'heading'     => esc_html__( 'Banner Listing', 'azirspares' ),
                    'type'        => 'attach_image',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('default','style3'),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'description' => esc_html__( 'Title shortcode.', 'azirspares' ),
                    'admin_label' => true,
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('default','style1','style3'),
                    ),
                ),
                array(
                    'param_name' => 'link',
                    'heading'    => esc_html__( 'Button', 'azirspares' ),
                    'type'       => 'vc_link',
                    'dependency'  => array(
                        'element'    => 'style',
                        'value'      => array('default','style2','style3'),
                    ),
                ),
                array(
                    'type'       => 'param_group',
                    'heading'    => esc_html__( 'Listing Items', 'azirspares' ),
                    'param_name' => 'listing_item',
                    'params'     => array(
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'azirspares' ),
                            'param_name'  => 'title_item',
                            'admin_label' => true,
                        ),
                        array(
                            'type'       => 'vc_link',
                            'heading'    => esc_html__( 'Link', 'azirspares' ),
                            'param_name' => 'link_item',
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Select icon or image', 'azirspares' ),
                            'value'       => array(
                                esc_html__( 'None', 'azirspares' )   => 'none',
                                esc_html__( 'Icon', 'azirspares' )   => 'icon',
                                esc_html__( 'Image', 'azirspares' )  => 'image',
                            ),
                            'param_name'  => 'upload',
                            'default'     => 'none',
                        ),
                        array(
                            'type'       => 'attach_image',
                            'heading'    => esc_html__('Image', 'azirspares'),
                            'param_name' => 'image',
                            'dependency'  => array(
                                'element' => 'upload',
                                'value'   => array('image'),
                            ),
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                            'value'       => array(
                                esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                                esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                                esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                                esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                                esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                                esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                                esc_html__( 'Material', 'azirspares' )     => 'material',
                                esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                            ),
                            'param_name'  => 'type',
                            'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                            'dependency'  => array(
                                'element' => 'upload',
                                'value'   => array( 'icon' ),
                            ),
                        ),
                        array(
                            'param_name'  => 'icon_azirsparescustomfonts',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                            'type'        => 'iconpicker',
                            'settings'    => array(
                                'emptyIcon' => false,
                                'type'      => 'azirsparescustomfonts',
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'azirsparescustomfonts',
                            ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_fontawesome',
                            'value'       => 'fa fa-adjust',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'fontawesome',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_openiconic',
                            'value'       => 'vc-oi vc-oi-dial',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'type'         => 'openiconic',
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'openiconic',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_typicons',
                            'value'       => 'typcn typcn-adjust-brightness',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'type'         => 'typicons',
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'typicons',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'azirspares' ),
                            'param_name' => 'icon_entypo',
                            'value'      => 'entypo-icon entypo-icon-note',
                            'settings'   => array(
                                'emptyIcon'    => false,
                                'type'         => 'entypo',
                                'iconsPerPage' => 100,
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'entypo',
                            ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_linecons',
                            'value'       => 'vc_li vc_li-heart',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'type'         => 'linecons',
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'linecons',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_monosocial',
                            'value'       => 'vc-mono vc-mono-fivehundredpx',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'type'         => 'monosocial',
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'monosocial',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                        array(
                            'type'        => 'iconpicker',
                            'heading'     => esc_html__( 'Icon', 'azirspares' ),
                            'param_name'  => 'icon_material',
                            'value'       => 'vc-material vc-material-cake',
                            'settings'    => array(
                                'emptyIcon'    => false,
                                'type'         => 'material',
                                'iconsPerPage' => 100,
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => 'material',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                        ),
                    ),
                ),

            ),
        );
        $param['azirspares_map']      = array(
            'base'        => 'azirspares_map',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/gmap.png'),
            'name'        => esc_html__( 'Azirspares: Google Map', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Google Map', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'description' => esc_html__( 'title.', 'azirspares' ),
                    'std'         => 'Azirspares',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Phone', 'azirspares' ),
                    'param_name'  => 'phone',
                    'description' => esc_html__( 'phone.', 'azirspares' ),
                    'std'         => '088-465 9965 02',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Email', 'azirspares' ),
                    'param_name'  => 'email',
                    'description' => esc_html__( 'email.', 'azirspares' ),
                    'std'         => 'famithemes@gmail.com',
                ),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Map Height', 'azirspares' ),
                    'param_name' => 'map_height',
                    'std'        => '400',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Maps type', 'azirspares' ),
                    'param_name' => 'map_type',
                    'value'      => array(
                        esc_html__( 'ROADMAP', 'azirspares' )   => 'ROADMAP',
                        esc_html__( 'SATELLITE', 'azirspares' ) => 'SATELLITE',
                        esc_html__( 'HYBRID', 'azirspares' )    => 'HYBRID',
                        esc_html__( 'TERRAIN', 'azirspares' )   => 'TERRAIN',
                    ),
                    'std'        => 'ROADMAP',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Address', 'azirspares' ),
                    'param_name'  => 'address',
                    'admin_label' => true,
                    'description' => esc_html__( 'address.', 'azirspares' ),
                    'std'         => 'Z115 TP. Thai Nguyen',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Longitude', 'azirspares' ),
                    'param_name'  => 'longitude',
                    'admin_label' => true,
                    'description' => esc_html__( 'longitude.', 'azirspares' ),
                    'std'         => '105.800286',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Latitude', 'azirspares' ),
                    'param_name'  => 'latitude',
                    'admin_label' => true,
                    'description' => esc_html__( 'latitude.', 'azirspares' ),
                    'std'         => '21.587001',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Zoom', 'azirspares' ),
                    'param_name'  => 'zoom',
                    'admin_label' => true,
                    'description' => esc_html__( 'zoom.', 'azirspares' ),
                    'std'         => '14',
                ),
            ),
        );
        $param['azirspares_member'] = array(
            'base' => 'azirspares_member',
            'name' => esc_html__('Azirspares: Team', 'azirspares'),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/product.png'),
            'category' => esc_html__('Azirspares Shortcode', 'azirspares'),
            'description' => esc_html__('Display Person', 'azirspares'),
            'params' => array(
                array(
                    'type' => 'select_preview',
                    'heading' => esc_html__('Select style', 'azirspares'),
                    'value' => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/member/default.jpg'),
                        ),
                    ),
                    'default' => 'default',
                    'admin_label' => true,
                    'param_name' => 'style',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Avatar Person', 'azirspares'),
                    'param_name' => 'avatar',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Name', 'azirspares'),
                    'param_name' => 'name',
                    'description' => esc_html__('Name of Person.', 'azirspares'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Infomation', 'azirspares'),
                    'param_name' => 'positions',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'param_group',
                    'heading' => esc_html__('Social', 'azirspares'),
                    'param_name' => 'social_member',
                    'params' => $icon_params,
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__('Link', 'azirspares'),
                    'param_name' => 'link',
                ),
            ),
        );
        $param['azirspares_newsletter'] = array(
            'base'        => 'azirspares_newsletter',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/newsletter.png'),
            'name'        => esc_html__( 'Azirspares: Newsletter', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Newsletter', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/newsletter/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/newsletter/style1.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/newsletter/style2.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Choose type color', 'azirspares' ),
                    'param_name'  => 'type_color',
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )          => 'dark',
                        esc_html__( 'Light', 'azirspares' )         => 'light',
                    ),
                    'std'         => 'dark',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style1','style2'),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style2'),
                    ),
                ),
                array(
                    'param_name' => 'desc',
                    'heading'    => esc_html__( 'Descriptions', 'azirspares' ),
                    'type'       => 'textarea',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style1','style2'),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Placeholder text', 'azirspares' ),
                    'param_name' => 'placeholder_text',
                    'std'        => esc_html__( 'Enter your email address', 'azirspares' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Style Button', 'azirspares' ),
                    'param_name'  => 'style_button',
                    'value'       => array(
                        esc_html__( 'Text', 'azirspares' )  => 'text',
                        esc_html__( 'Icon', 'azirspares' )  => 'icon',
                    ),
                    'std'         => 'text',
                    'admin_label' => true,
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Button text', 'azirspares' ),
                    'std'        => esc_html__( 'Subscribe', 'azirspares' ),
                    'param_name' => 'button_text',
                    'dependency' => array(
                        'element' => 'style_button',
                        'value'   => array( 'text' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                        esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                        esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                        esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                        esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                        esc_html__( 'Material', 'azirspares' )     => 'material',
                        esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                    ),
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                    'dependency'  => array(
                        'element'  => 'style_button',
                        'value'    => array( 'icon' ),
                    ),
                ),
                array(
                    'param_name'  => 'icon_azirsparescustomfonts',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'azirsparescustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'azirsparescustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'azirspares' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
            ),
        );
        /* GET PINMAP */
        $args_pm        = array(
            'post_type'      => 'azirspares_mapper',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        $pinmap_loop    = new wp_query( $args_pm );
        $pinmap_options = array();
        while ( $pinmap_loop->have_posts() ) {
            $pinmap_loop->the_post();
            $attachment_id                = get_post_meta( get_the_ID(), 'azirspares_mapper_image', true );
            $pinmap_options[get_the_ID()] = array(
                'title'   => get_the_title(),
                'preview' => wp_get_attachment_image_url( $attachment_id, 'medium' ),
            );
        }
        $param['azirspares_pinmapper'] = array(
            'base'        => 'azirspares_pinmapper',
            'name'        => esc_html__( 'Azirspares: Pin Map', 'azirspares' ),
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/pinmapper.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Pin Map', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Pinmaper style', 'azirspares' ),
                    'value'       => $pinmap_options,
                    'admin_label' => true,
                    'param_name'  => 'pinmaper_style',
                    'description' => esc_html__( 'Select a style for pinmaper item', 'azirspares' ),
                ),
            ),
        );
        // CUSTOM PRODUCT OPTIONS
        $layoutDir       = get_template_directory() . '/woocommerce/product-styles/';
        $product_options = array();
        if ( is_dir( $layoutDir ) ) {
            $files = scandir( $layoutDir );
            if ( $files && is_array( $files ) ) {
                foreach ( $files as $file ) {
                    if ( $file != '.' && $file != '..' ) {
                        $fileInfo = pathinfo( $file );
                        if ( $fileInfo['extension'] == 'php' && $fileInfo['basename'] != 'index.php' && $fileInfo['filename'] != 'content-product-list' ) {
                            $file_data                   = get_file_data( $layoutDir . $file, array( 'Name' => 'Name' ) );
                            $file_name                   = str_replace( 'content-product-style-', '', $fileInfo['filename'] );
                            $product_options[$file_name] = array(
                                'title'   => $file_data['Name'],
                                'preview' => get_theme_file_uri( 'woocommerce/product-styles/content-product-style-' . $file_name . '.jpg' ),
                            );
                        }
                    }
                }
            }
        }
        // CUSTOM PRODUCT SIZE
        $product_size_width_list = array();
        $width                   = 320;
        $height                  = 320;
        $crop                    = 1;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size   = wc_get_image_size( 'shop_catalog' );
            $width  = isset( $size['width'] ) ? $size['width'] : $width;
            $height = isset( $size['height'] ) ? $size['height'] : $height;
            $crop   = isset( $size['crop'] ) ? $size['crop'] : $crop;
        }
        for ( $i = 100; $i < $width; $i = $i + 10 ) {
            array_push( $product_size_width_list, $i );
        }
        $product_size_list                         = array();
        $product_size_list[$width . 'x' . $height] = $width . 'x' . $height;
        foreach ( $product_size_width_list as $k => $w ) {
            $w = intval( $w );
            if ( isset( $width ) && $width > 0 ) {
                $h = round( $height * $w / $width );
            } else {
                $h = $w;
            }
            $product_size_list[$w . 'x' . $h] = $w . 'x' . $h;
        }
        $product_size_list['Custom'] = 'custom';
        $param['azirspares_products'] = array(
            'base'        => 'azirspares_products',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/product.png'),
            'name'        => esc_html__( 'Azirspares: Products', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Products', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Product List style', 'azirspares' ),
                    'param_name'  => 'productsliststyle',
                    'value'       => array(
                        esc_html__( 'Grid Bootstrap', 'azirspares' ) => 'grid',
                        esc_html__( 'Owl Carousel', 'azirspares' )   => 'owl',
                    ),
                    'description' => esc_html__( 'Select a style for list', 'azirspares' ),
                    'std'         => 'grid',
                ),
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Product style', 'azirspares' ),
                    'value'       => $product_options,
                    'default'     => '01',
                    'admin_label' => true,
                    'param_name'  => 'product_style',
                    'description' => esc_html__( 'Select a style for product item', 'azirspares' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Image size', 'azirspares' ),
                    'param_name'  => 'product_image_size',
                    'value'       => $product_size_list,
                    'description' => esc_html__( 'Select a size for product', 'azirspares' ),
                ),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Width', 'azirspares' ),
                    'param_name' => 'product_custom_thumb_width',
                    'value'      => $width,
                    'suffix'     => esc_html__( 'px', 'azirspares' ),
                    'dependency' => array( 'element' => 'product_image_size', 'value' => array( 'custom' ) ),
                ),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Height', 'azirspares' ),
                    'param_name' => 'product_custom_thumb_height',
                    'value'      => $height,
                    'suffix'     => esc_html__( 'px', 'azirspares' ),
                    'dependency' => array( 'element' => 'product_image_size', 'value' => array( 'custom' ) ),
                ),

                /* Products */
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Enable Load More', 'azirspares' ),
                    'param_name' => 'loadmore',
                    'value'      => array(
                        esc_html__( 'Enable', 'azirspares' )  => 'enable',
                        esc_html__( 'Disable', 'azirspares' ) => 'disable',
                    ),
                    'std'        => 'disable',
                    'group'      => esc_html__( 'Products options', 'azirspares' ),
                ),
                array(
                    'type'        => 'taxonomy',
                    'heading'     => esc_html__( 'Product Category', 'azirspares' ),
                    'param_name'  => 'taxonomy',
                    'options'     => array(
                        'multiple'   => true,
                        'hide_empty' => true,
                        'taxonomy'   => 'product_cat',
                    ),
                    'placeholder' => esc_html__( 'Choose category', 'azirspares' ),
                    'description' => esc_html__( 'Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'azirspares' ),
                    'group'       => esc_html__( 'Products options', 'azirspares' ),
                    'dependency'  => array( 'element' => 'target', 'value' => array( 'top-rated', 'recent-product', 'product-category', 'featured_products', 'on_sale', 'on_new' ) ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Target', 'azirspares' ),
                    'param_name'  => 'target',
                    'value'       => array(
                        esc_html__( 'Best Selling Products', 'azirspares' ) => 'best-selling',
                        esc_html__( 'Top Rated Products', 'azirspares' )    => 'top-rated',
                        esc_html__( 'Recent Products', 'azirspares' )       => 'recent-product',
                        esc_html__( 'Product Category', 'azirspares' )      => 'product-category',
                        esc_html__( 'Products', 'azirspares' )              => 'products',
                        esc_html__( 'Featured Products', 'azirspares' )     => 'featured_products',
                        esc_html__( 'On Sale', 'azirspares' )               => 'on_sale',
                        esc_html__( 'On New', 'azirspares' )                => 'on_new',
                    ),
                    'description' => esc_html__( 'Choose the target to filter products', 'azirspares' ),
                    'std'         => 'recent-product',
                    'group'       => esc_html__( 'Products options', 'azirspares' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Order by', 'azirspares' ),
                    'param_name'  => 'orderby',
                    'value'       => array(
                        esc_html__( 'Date', 'azirspares' )          => 'date',
                        esc_html__( 'ID', 'azirspares' )            => 'ID',
                        esc_html__( 'Author', 'azirspares' )        => 'author',
                        esc_html__( 'Title', 'azirspares' )         => 'title',
                        esc_html__( 'Modified', 'azirspares' )      => 'modified',
                        esc_html__( 'Random', 'azirspares' )        => 'rand',
                        esc_html__( 'Comment count', 'azirspares' ) => 'comment_count',
                        esc_html__( 'Menu order', 'azirspares' )    => 'menu_order',
                        esc_html__( 'Sale price', 'azirspares' )    => '_sale_price',
                    ),
                    'std'         => 'date',
                    'description' => esc_html__( 'Select how to sort.', 'azirspares' ),
                    'dependency'  => array( 'element' => 'target', 'value' => array( 'top-rated', 'recent-product', 'product-category', 'featured_products', 'on_sale', 'on_new', 'product_attribute' ) ),
                    'group'       => esc_html__( 'Products options', 'azirspares' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Order', 'azirspares' ),
                    'param_name'  => 'order',
                    'value'       => array(
                        esc_html__( 'ASC', 'azirspares' )  => 'ASC',
                        esc_html__( 'DESC', 'azirspares' ) => 'DESC',
                    ),
                    'std'         => 'DESC',
                    'description' => esc_html__( 'Designates the ascending or descending order.', 'azirspares' ),
                    'dependency'  => array( 'element' => 'target', 'value' => array( 'top-rated', 'recent-product', 'product-category', 'featured_products', 'on_sale', 'on_new', 'product_attribute' ) ),
                    'group'       => esc_html__( 'Products options', 'azirspares' ),
                ),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Product per page', 'azirspares' ),
                    'param_name' => 'per_page',
                    'value'      => 6,
                    'dependency' => array( 'element' => 'target', 'value' => array( 'best-selling', 'top-rated', 'recent-product', 'product-category', 'featured_products', 'product_attribute', 'on_sale', 'on_new' ) ),
                    'group'      => esc_html__( 'Products options', 'azirspares' ),
                ),
                array(
                    'type'        => 'autocomplete',
                    'heading'     => esc_html__( 'Products', 'azirspares' ),
                    'param_name'  => 'ids',
                    'settings'    => array(
                        'multiple'      => true,
                        'sortable'      => true,
                        'unique_values' => true,
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'Enter List of Products', 'azirspares' ),
                    'dependency'  => array( 'element' => 'target', 'value' => array( 'products' ) ),
                    'group'       => esc_html__( 'Products options', 'azirspares' ),
                ),
            ),
        );
        $attributes_tax = array();
        if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
            $attributes_tax = wc_get_attribute_taxonomies();
        }
        $attributes = array();
        if ( is_array( $attributes_tax ) && count( $attributes_tax ) > 0 ) {
            foreach ( $attributes_tax as $attribute ) {
                $attributes[$attribute->attribute_label] = $attribute->attribute_name;
            }
        }
        $param['azirspares_products_total'] = array(
            'base'        => 'azirspares_products_total',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/product.png'),
            'name'        => esc_html__( 'Azirspares: Products Total', 'azirspares' ),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display Products Total', 'azirspares' ),
            'params'      => array(
                array(
                    'type'          => 'checkbox',
                    'heading'     => esc_html__( 'Product Attribute', 'azirspares' ),
                    'param_name'  => 'product_attribute',
                    'value'       => $attributes,
                    'description' => esc_html__( 'Select a Attribute for product', 'azirspares' ),
                ),
            ),
        );
        $param['azirspares_slide']    = array(
            'base'                    => 'azirspares_slide',
            'icon'                    => get_theme_file_uri('assets/images/vc-shortcodes-icons/slide.png'),
            'name'                    => esc_html__( 'Azirspares: Slide', 'azirspares' ),
            'category'                => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description'             => esc_html__( 'Display Slide', 'azirspares' ),
            'as_parent'               => array(
                'only' => 'vc_single_image, vc_custom_heading, azirspares_member, vc_column_text, azirspares_iconbox, azirspares_listing, azirspares_socials, azirspares_testimonial, azirspares_category, vc_row',
            ),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'slider_title',
                    'admin_label' => true,
                ),
            ),
        );
		$socials             = array();
		$all_socials         = Azirspares_Functions::azirspares_get_option( 'user_all_social' );
		if ( !empty( $all_socials ) ) {
			foreach ( $all_socials as $key => $social ) {
				$socials[$social['title_social']] = $key;
			}
		}
		$param['azirspares_socials']    = array(
			'base'        => 'azirspares_socials',
            'icon'        => get_theme_file_uri('assets/images/vc-shortcodes-icons/socials.png'),
			'name'        => esc_html__( 'Azirspares: Socials', 'azirspares' ),
			'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
			'description' => esc_html__( 'Display Socials', 'azirspares' ),
			'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/socials/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/socials/style1.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Choose type color', 'azirspares' ),
                    'param_name'  => 'type_color',
                    'value'       => array(
                        esc_html__( 'Dark', 'azirspares' )          => 'dark',
                        esc_html__( 'Light', 'azirspares' )         => 'light',
                    ),
                    'std'         => 'dark',
                ),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'azirspares' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'List Social', 'azirspares' ),
					'param_name' => 'socials',
					'value'      => $socials,
				),
			),
		);
        $param['azirspares_tabs']     = array(
            'base'                    => 'azirspares_tabs',
            'icon'                    => get_theme_file_uri('assets/images/vc-shortcodes-icons/tabs.png'),
            'name'                    => esc_html__( 'Azirspares: Tabs', 'azirspares' ),
            'category'                => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description'             => esc_html__( 'Display Tabs', 'azirspares' ),
            'is_container'            => true,
            'show_settings_on_create' => false,
            'as_parent'               => array(
                'only' => 'vc_tta_section',
            ),
            'params'                  => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/default.jpg' ),
                        ),
                        'style1'  => array(
                            'title'   => esc_html__( 'Style 01', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style1.jpg' ),
                        ),
                        'style2'  => array(
                            'title'   => esc_html__( 'Style 02', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style2.jpg' ),
                        ),
                        'style3'  => array(
                            'title'   => esc_html__( 'Style 03', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style3.jpg' ),
                        ),
                        'style4'  => array(
                            'title'   => esc_html__( 'Style 04', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style4.jpg' ),
                        ),
                        'style5'  => array(
                            'title'   => esc_html__( 'Style 05', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style5.jpg' ),
                        ),
                        'style6'  => array(
                            'title'   => esc_html__( 'Style 06', 'azirspares' ),
                            'preview' => get_theme_file_uri( 'assets/images/shortcode-preview/tabs/style6.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Use Icon', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'No Icon', 'azirspares' )   => '',
                        esc_html__( 'Use icon', 'azirspares' )   => 'has-icon',
                    ),
                    'param_name'  => 'has_icon',
                    'default'     => '',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'azirspares' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'azirspares' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'azirspares' )  => 'openiconic',
                        esc_html__( 'Typicons', 'azirspares' )     => 'typicons',
                        esc_html__( 'Entypo', 'azirspares' )       => 'entypo',
                        esc_html__( 'Linecons', 'azirspares' )     => 'linecons',
                        esc_html__( 'Mono Social', 'azirspares' )  => 'monosocial',
                        esc_html__( 'Material', 'azirspares' )     => 'material',
                        esc_html__( 'Azirspares Fonts', 'azirspares' )  => 'azirsparescustomfonts',
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'azirspares' ),
                    'dependency'  => array(
                        'element'    => 'has_icon',
                        'value'      => array('has-icon'),
                    ),
                ),
                array(
                    'param_name'  => 'icon_azirsparescustomfonts',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'azirsparescustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'azirsparescustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'azirspares' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'azirspares' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'tab_title',
                    'description' => esc_html__( 'The title of shortcode', 'azirspares' ),
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'default','style1','style4','style6' ),
                    ),
                ),
                vc_map_add_css_animation(),
                array(
                    'param_name' => 'ajax_check',
                    'heading'    => esc_html__( 'Using Ajax Tabs', 'azirspares' ),
                    'type'       => 'dropdown',
                    'value'      => array(
                        esc_html__( 'Yes', 'azirspares' ) => '1',
                        esc_html__( 'No', 'azirspares' )  => '0',
                    ),
                    'std'        => '0',
                ),
                array(
                    'param_name' => 'using_loop',
                    'heading'    => esc_html__( 'Using Loop', 'azirspares' ),
                    'type'       => 'dropdown',
                    'value'      => array(
                        esc_html__( 'Yes', 'azirspares' ) => '1',
                        esc_html__( 'No', 'azirspares' )  => '0',
                    ),
                    'std'        => '1',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style2','style3' ),
                    ),
                ),
                array(
                    'type'       => 'number',
                    'heading'    => esc_html__( 'Active Section', 'azirspares' ),
                    'param_name' => 'active_section',
                    'std'        => 0,
                ),
            ),
            'js_view'                 => 'VcBackendTtaTabsView',
            'custom_markup'           => '
                    <div class="vc_tta-container" data-vc-action="collapse">
                        <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
                            <div class="vc_tta-tabs-container">'
                . '<ul class="vc_tta-tabs-list">'
                . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
                . '</ul>
                            </div>
                            <div class="vc_tta-panels vc_clearfix {{container-class}}">
                              {{ content }}
                            </div>
                        </div>
                    </div>',
            'default_content'         => '
                        [vc_tta_section title="' . sprintf( '%s %d', esc_attr__( 'Tab', 'azirspares' ), 1 ) . '"][/vc_tta_section]
                        [vc_tta_section title="' . sprintf( '%s %d', esc_attr__( 'Tab', 'azirspares' ), 2 ) . '"][/vc_tta_section]
                    ',
            'admin_enqueue_js'        => array(
                vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
            ),
        );
        $param['azirspares_testimonial'] = array(
            'base'          => 'azirspares_testimonial',
            'icon'          => get_theme_file_uri('assets/images/vc-shortcodes-icons/testimonial.png'),
            'name'          => esc_html__('Azirspares: Testimonial', 'azirspares'),
            'category'      => esc_html__('Azirspares Shortcode', 'azirspares'),
            'description'   => esc_html__('Display Testimonial', 'azirspares'),
            'params'        => array(
                array(
                    'type' => 'select_preview',
                    'heading' => esc_html__('Select style', 'azirspares'),
                    'value' => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/testimonial/default.jpg'),
                        ),
                        'style1' => array(
                            'title' => esc_html__('Style 01', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/testimonial/style1.jpg'),
                        ),
                        'style2' => array(
                            'title' => esc_html__('Style 02', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/testimonial/style2.jpg'),
                        ),
                    ),
                    'default' => 'default',
                    'admin_label' => true,
                    'param_name' => 'style',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Star Rating', 'azirspares'),
                    'param_name' => 'rating',
                    'value'      => array(
                        esc_html__('1 Star', 'azirspares')  => 'rating-1',
                        esc_html__('2 Stars', 'azirspares') => 'rating-2',
                        esc_html__('3 Stars', 'azirspares') => 'rating-3',
                        esc_html__('4 Stars', 'azirspares') => 'rating-4',
                        esc_html__('5 Stars', 'azirspares') => 'rating-5',
                    ),
                    'std' => 'rating-5',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'azirspares'),
                    'param_name' => 'title',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('default','style1'),
                    ),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Description', 'azirspares'),
                    'param_name' => 'desc',
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__('Image', 'azirspares'),
                    'param_name' => 'image',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array('style1','style2'),
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Name', 'azirspares'),
                    'param_name' => 'name',
                    'description' => esc_html__('Name', 'azirspares'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Position', 'azirspares'),
                    'param_name' => 'position',
                    'description' => esc_html__('Position', 'azirspares'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__('Link', 'azirspares'),
                    'param_name' => 'link',
                ),
            ),
        );
        $param['azirspares_verticalmenu'] = array(
            'name'        => esc_html__( 'Azirspares: Vertical Menu', 'azirspares' ),
            'base'        => 'azirspares_verticalmenu',
            'icon' => get_theme_file_uri('assets/images/vc-shortcodes-icons/custom-menu.png'),
            'category'    => esc_html__( 'Azirspares Shortcode', 'azirspares' ),
            'description' => esc_html__( 'Display a vertical menu.', 'azirspares' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Style', 'azirspares' ),
                    'value'       => array(
                        'default' => array(
                            'title' => esc_html__('Default', 'azirspares'),
                            'preview' => get_theme_file_uri('assets/images/shortcode-preview/verticalmenu/default.jpg'),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Position absolute menu', 'azirspares' ),
                    'param_name' => 'position_menu',
                    'std'        => 'yes',
                    'value'      => array(
                        esc_html__( 'Yes', 'azirspares' ) => 'yes',
                        esc_html__( 'No', 'azirspares' )  => 'no',
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'azirspares' ),
                    'param_name'  => 'title',
                    'description' => esc_html__( 'The title of shortcode', 'azirspares' ),
                    'admin_label' => true,
                    'std'         => 'Departments',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Menu', 'azirspares' ),
                    'param_name'  => 'menu',
                    'value'       => $all_menu,
                    'description' => esc_html__( 'Select menu to display.', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button close text', 'azirspares' ),
                    'param_name'  => 'button_close_text',
                    'description' => esc_html__( 'Button close text', 'azirspares' ),
                    'admin_label' => true,
                    'std'         => esc_html__( 'Close', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Button all text', 'azirspares' ),
                    'param_name'  => 'button_all_text',
                    'description' => esc_html__( 'Button all text', 'azirspares' ),
                    'admin_label' => true,
                    'std'         => esc_html__( 'Go To All Departments', 'azirspares' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Limit items', 'azirspares' ),
                    'param_name'  => 'limit_items',
                    'description' => esc_html__( 'Limit item for showing', 'azirspares' ),
                    'admin_label' => true,
                    'std'         => '9',
                ),
            ),
        );
        return $param;
	}
}