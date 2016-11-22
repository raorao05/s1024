<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header() ?>
			
			<?php
				if ( function_exists( 'ot_get_option' ) ) {
					$portfolio_post_per_page_query = ot_get_option( 'portfolio_post_per_page', '10' );
				} else {
					$portfolio_post_per_page_query  = '10';
				}
			?>
			<?php query_posts('post_type=portfolio&posts_per_page=' . $portfolio_post_per_page_query ); ?>
			
			<!-- Begin .top-filter-bar-container -->
			<div class="top-filter-bar-container">
				<div class="top-filter-bar border-box-star">
					<ul>
						<li class="selected-tinyNav"><a class="top-filter-bar-selected" href="#" data-filter=".item">show all</a></li>
							<?php
								$args = array(
									'type' => 'portfolio',
									'taxonomy' => 'portfolio-category',
									);
								$filterBarTerms = get_categories( $args );
								foreach ($filterBarTerms as $term) {
									echo '<li><a href="#" data-filter=".' . $term->slug . '" >'.$term->name.'</a></li>';
								}
							?>
					</ul>
				</div>
			<!-- End .top-filter-bar-container -->
			</div>
			
			<!-- Begin .items-container-wrap -->
			<section class="items-container-wrap">
				<div class="items-container">
					<div class="items-container-responsive">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php
								$comma_separated = array();
								$postTerms = wp_get_post_terms( $post->ID, 'portfolio-category'); 
								foreach ($postTerms as $term) { array_push($comma_separated, $term->slug); }
								$comma_separated = implode(" ", $comma_separated);
							?>
							<div id="portfolio-<?php the_ID(); ?>" <?php post_class('folio-item item ' . $comma_separated ); ?>>
								<?php if ( has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('portfolio-thumb'); ?>
								<?php endif; ?>
								<div class="folio-item-hover animate-opacity">
									<div class="folio-item-info-container border-box">
										<h2 class="folio-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<h4 class="folio-item-cat"><?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' ); ?></h4>
									</div>
								</div>
								<?php
									$fullSizeImageSrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
									$fullSizeImageSrc = $fullSizeImageSrc['0'];
								?>
								<?php
									$fVideo = trim(get_post_meta( $post->ID, 'folio_video_url', true ));
									if ($fVideo === "") {
								?>		
									<a class="folio-item-view animate-folio-hover" rel="prettyPhoto[portfolio-gallery]" href="<?php echo $fullSizeImageSrc; ?>"><div class="folio-item-view"></div></a>
									<a class="folio-item-link animate-folio-hover" href="<?php the_permalink(); ?>"><div class="folio-item-link"></div></a>
								<?php
									} else {
								?>
									<a class="folio-item-play animate-folio-hover" rel="prettyPhoto[portfolio-gallery]" href="<?php echo $fVideo; ?>"><div class="folio-item-play"></div></a>
									<a class="folio-item-link animate-folio-hover" href="<?php the_permalink(); ?>"><div class="folio-item-link"></div></a>
								<?php
									}
								?>
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
