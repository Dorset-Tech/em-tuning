<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Azirspares
 * @since Azirspares 1.0
 */
get_header();
?>
    <div class="fullwidth-template">
        <div class="container">
			<?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
        </div>
    </div>
<?php
get_footer();