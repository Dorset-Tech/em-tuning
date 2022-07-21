<?php
global $post;
$azirspares_enable_popup            = Azirspares_Functions::azirspares_get_option( 'azirspares_enable_popup' );
$azirspares_popup_title             = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_title', '' );
$azirspares_popup_highlight         = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_highlight', '' );
$azirspares_popup_subtitle          = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_subtitle', '' );
$azirspares_popup_desc              = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_desc', '' );
$azirspares_popup_input_submit      = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_input_submit', '' );
$azirspares_popup_input_placeholder = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_input_placeholder', '' );
$azirspares_popup_close             = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_close', '' );
$azirspares_popup_background        = Azirspares_Functions::azirspares_get_option( 'azirspares_popup_background' );
$azirspares_page_newsletter         = Azirspares_Functions::azirspares_get_option( 'azirspares_select_newsletter_page' );
if ( isset( $post->ID ) ) {
	$id = $post->ID;
}
if ( isset( $post->post_type ) ) {
	$post_type = $post->post_type;
}
if ( is_array( $azirspares_page_newsletter ) && in_array( $id, $azirspares_page_newsletter ) && $post_type == 'page' && $azirspares_enable_popup == 1 ) :?>
    <!--  Popup Newsletter-->
    <div class="modal fade" id="popup-newsletter" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-inner">
					<?php if ( $azirspares_popup_background ) : ?>
						<?php
						$image_thumb = wp_get_attachment_image_src( $azirspares_popup_background, 'full' );
						$img_lazy    = "data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%20" . $image_thumb[1] . "%20" . $image_thumb[2] . "%27%2F%3E";
						?>
                        <div class="modal-thumb"
                             style="background-image:url('<?php echo esc_url( $image_thumb[0] ) ?>')"></div>
					<?php endif; ?>
                    <div class="modal-info">
						<?php if ( $azirspares_popup_title ): ?>
                            <h4 class="title"><?php echo esc_html( $azirspares_popup_title ); ?></h4>
						<?php endif; ?>
						<?php if ( $azirspares_popup_highlight ): ?>
                            <h2 class="highlight"><?php echo esc_html( $azirspares_popup_highlight ); ?></h2>
						<?php endif; ?>
						<?php if ( $azirspares_popup_subtitle ): ?>
                            <p class="subtitle"><?php echo esc_html( $azirspares_popup_subtitle ); ?></p>
						<?php endif; ?>
						<?php if ( $azirspares_popup_desc ): ?>
                            <p class="des"><?php echo wp_specialchars_decode( $azirspares_popup_desc ); ?></p>
						<?php endif; ?>
                        <div class="newsletter-form-wrap">
                            <input class="email" type="email" name="email"
                                   placeholder="<?php echo esc_attr( $azirspares_popup_input_placeholder ); ?>">
                            <button type="submit" name="submit_button" class="btn-submit submit-newsletter">
								<?php echo esc_html( $azirspares_popup_input_submit ); ?>
                            </button>
                        </div>
						<?php if ( $azirspares_popup_close ): ?>
                            <div class="checkbox btn-checkbox">
                                <label>
                                    <input class="azirspares_disabled_popup_by_user" type="checkbox">
                                    <span></span>
                                </label>
								<?php if ( $azirspares_popup_close ): ?>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<?php echo esc_html( $azirspares_popup_close ); ?>
                                    </button>
								<?php endif; ?>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!--  Popup Newsletter-->
<?php endif;