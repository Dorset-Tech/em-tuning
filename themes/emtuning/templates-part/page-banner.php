<?php
/* Data MetaBox */
$data_meta                    = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
?>
<!-- Banner page -->
<div class="container">
	<?php
	if ( !is_front_page() ) {
		$args = array(
			'container'     => 'div',
			'before'        => '',
			'after'         => '',
			'show_on_front' => true,
			'network'       => false,
			'show_title'    => true,
			'show_browse'   => false,
			'post_taxonomy' => array(),
			'labels'        => array(),
			'echo'          => true,
		);
		do_action( 'azirspares_breadcrumb', $args );
	}
	?>
</div>
<?php
if ( isset( $data_meta['bg_banner_page'] ) && $data_meta['bg_banner_page'] != '' ):
    $banner     = $data_meta['bg_banner_page'];
    $banner_url = wp_get_attachment_image_url( $banner, 'full' );?>
    <div class="inner-page-banner"><img alt="<?php echo esc_attr__('banner','azirspares')?>" src="<?php echo esc_url( $banner_url )?>"/></div>
<?php endif; ?>
<div class="container title-wrap">
    <h1 class="page-title"><?php single_post_title(); ?></h1>
</div>
<!-- /Banner page -->