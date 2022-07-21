<div class="post-inner">
    <div class="post-thumb">
        <?php
        $thumb = apply_filters('azirspares_resize_image', get_post_thumbnail_id(), 440, 321, true, true);
        echo wp_specialchars_decode($thumb['img']);
        ?>
    </div>
    <div class="post-content">
        <div class="post-info equal-elem">
            <?php
            azirspares_post_date();
            azirspares_post_title();
            echo wp_trim_words(apply_filters('the_excerpt', get_the_excerpt()), 15, '');
            ?>
        </div>
        <div class="post-meta">
            <?php
            azirspares_post_author();
            azirspares_post_comment_icon();
            ?>
        </div>
    </div>
</div>