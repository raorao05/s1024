<?php get_header() ?>

			<!-- Begin .items-container-single -->
			<section class="items-container-single">
				
				<?php if( have_posts() ): while( have_posts() ) : the_post(); ?>
				<div <?php post_class('blog-single'); ?> id="post-<?php the_ID(); ?>">
					<header class="blog-single-header">
						<?php if ( get_post_meta( $post->ID, 'disable_hdate', true ) !== 'disable') { ?>
							<span class="blog-single-date"><?php the_time('d M'); ?></span>
						<?php } ?>
						<h1 class="blog-single-title"><?php the_title(); ?></h1>
						<?php
							global $post;  
							$page_deatil_text = get_post_meta( $post->ID, 'page_detail_text', true );

						?>
						<span class="blog-single-category"><?php echo $page_deatil_text; ?></span>
					</header>
					<div class="blog-single-content">
						<div class="blog-single-para"> 
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => '<p class="single-paginate"><strong>'.__('Pages:', 'spnoy').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						</div>
					</div>
					
					<?php
						if ( get_post_meta( $post->ID, 'disable_footer', true ) !== 'disable') {
					?>
					
					<div class="blog-single-footer">
						<div class="blog-single-footer-lcont">
							<span class="blog-single-likes-but"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
							<span class="blog-single-likes-num border-box"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
							<span class="blog-single-comments-ico"></span>
							<span class="blog-single-comments-num border-box"><?php comments_popup_link( '0', '1', '%', '', '-' ); ?></span>
						</div>
						<div class="blog-single-footer-rcont border-box">
							<span class="blog-single-footer-infos">
								<?php _e('Posted: ', 'spnoy'); the_time('F j, Y g:i a'); ?>
							</span>
							
							<?php
								if ( function_exists( 'ot_get_option' ) AND ot_get_option( 'sharing_buttons', 'disable' ) === "enable" ) {
							?>

							<span class="blog-single-footer-social-buttons">
								
								<?php $page_sharing_buttons_type = ot_get_option( 'page_sharing_buttons_type', array() ); ?>
								<?php foreach( $page_sharing_buttons_type as $type ) { ?>
									<?php
										switch ($type) {
											case 'facebook_share':
												if ( function_exists('dd_fblike_generate') ) { dd_fblike_generate('Recommend Button Count'); }
												break;
											case 'twitter':
												if ( function_exists('dd_twitter_generate') ) { dd_twitter_generate('Compact'); }
												break;
											case 'google_plus':
												if ( function_exists('dd_google1_generate') ) { dd_google1_generate('Compact (20px)'); }
												break;
											case 'linkedin':
												if ( function_exists('dd_linkedin_generate') ) { dd_linkedin_generate('Compact'); }
												break;
											case 'pinterest':
												if ( function_exists('dd_pinterest_generate') ) { dd_pinterest_generate('Compact'); }
												break;
										}
									?>
								<?php } ?>
								
							</span>
							
							<?php } ?>
							
						</div>
					</div>
					
					<?php } ?>
					
					<div class="blog-single-comments">
						<?php comments_template('', true); ?>
					</div>
				</div>
				<?php endwhile; endif; ?>

				
			<!-- End .items-container-single -->
			</section>
			
<?php get_footer(); ?>
