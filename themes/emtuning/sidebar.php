<?php
$azirspares_blog_used_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_blog_used_sidebar', 'widget-area' );
if ( is_single() ) {
	$azirspares_blog_used_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_single_used_sidebar', 'widget-area' );
}
?>
<?php if ( is_active_sidebar( $azirspares_blog_used_sidebar ) ) : ?>
    <div id="widget-area" class="widget-area sidebar-blog">
		<?php dynamic_sidebar( $azirspares_blog_used_sidebar ); ?>
    </div><!-- .widget-area -->
<?php endif; ?>