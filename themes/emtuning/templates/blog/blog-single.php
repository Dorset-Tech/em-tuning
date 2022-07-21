<?php
$post_format = get_post_format();
do_action('azirspares_before_single_blog_content');
?>
    <article <?php post_class('post-item post-single'); ?>>
        <div class="single-post-thumb">
            <?php azirspares_post_thumbnail(); ?>
        </div>
        <div class="single-post-info">
            <?php
            azirspares_post_title();
            ?>
            <div class="post-meta">
                <?php
                azirspares_post_date();
                azirspares_post_author();
                ?>
            </div>
        </div>
        <?php
        azirspares_post_full_content();
        ?>
        <?php azirspares_post_tags(); ?>
        <div class="post-footer">
            <?php
            azirspares_share_button();
            azirspares_post_category();
            ?>
        </div>
    </article>
<?php
do_action('azirspares_after_single_blog_content');