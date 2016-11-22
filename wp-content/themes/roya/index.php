<?php get_header() ?>

			<?php
				if ( function_exists( 'ot_get_option' ) ) {
					$blog_post_per_page_query = ot_get_option( 'blog_post_per_page', '10' );
				}
			?>
			<?php query_posts( 'posts_per_page=' . $blog_post_per_page_query ); ?>
			
			<!-- Begin .top-filter-bar-container -->
			<div class="top-filter-bar-container">
				<div class="top-filter-bar border-box-star">
					<ul>
						<li><a class="top-filter-bar-selected" href="#" data-filter=".item">show all</a></li>
							<?php
								$args = array(
									'type' => 'post',
									'taxonomy' => 'category',
									);
								$filterBarTerms = get_categories( $args );
								foreach($filterBarTerms as $term) {
									echo '<li><a href="#" data-filter=".' . $term->slug . '" >'.$term->name.'</a></li>';
								}
							?>
					</ul>
				</div>
			<!-- End .top-filter-bar-container -->
			</div>
			
			<!-- Begin .items-container-wrap -->
			<section class="items-container-wrap">
				<div class="items-container items-container-blog">
					<div class="items-container-responsive">
						<?php if(have_posts()): while(have_posts()):the_post(); ?>
						<?php $postTerms = wp_get_post_terms( $post->ID, 'category'); ?>
						<?php 
							$comma_separated = array();
							foreach ($postTerms as $term) { array_push($comma_separated, $term->slug); }
							$comma_separated = implode(" ", $comma_separated);
						?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item item ' . $comma_separated ); ?>>
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('blog-thumb'); ?>
								<?php endif; ?>
							</a>
							<div class="blog-item-content-bg">
								<div class="blog-item-infos">
									<span class="blog-item-date border-box"><?php the_time('d M'); ?></span>
									<span class="blog-item-likes-ico border-box"></span>
									<span class="blog-item-likes border-box"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></span>
									<span class="blog-item-comments-ico border-box"></span>
									<span class="blog-item-comments border-box"><?php comments_popup_link( '0', '1', '%', '', '-' ); ?></span>
								</div>
								<div class="blog-item-content border-box">
									<h2 class="blog-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<div class="blog-item-short-content">
									<?php 
										global $more;
										$more = 0;
										$old_content = get_the_content(""); 
										$new_content = strip_tags($old_content, '<p><a><b><br /><li><ol><ul><i><strong><br/>');
										$new_content = str_replace(array(' ','&nbsp;'),' ',$new_content);
										echo ltrim(strip_shortcodes($new_content));
									?>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
						
						<!--Begin .page-navigation -->
						<!-- Using Ajax so we don't need it -->
						<div class="page-navigation">
						<?php 
							global $wp_query;
							$number = 999999999;
							echo paginate_links( array(
								'base' => str_replace( $number, '%#%', get_pagenum_link( $number ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,
								'prev_text' => __('Prev Page', 'spnoy'),
								'next_text' => __('Next Page', 'spnoy')
							) ); ?>
						<!--End .page-navigation -->
						</div>
						
						<?php endif; ?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			<!-- End .items-container-wrap -->
			</section>
			
<?php get_footer(); ?>