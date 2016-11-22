<?php get_header(); ?>

	<?php
	$term = get_term_by( 'slug', get_query_var( 'portfolio-category' ), 'portfolio-category' ) ;
    
	$args = array(
		'post_type' => 'portfolio',
		'taxonomy'=>'portfolio-category',
		'term'=>$term->slug,
		'posts_per_page' => -1
	);
	
	$the_query = new WP_Query( $args );
	
	?>
	
	<section class="items-container-single">
		<div class="search-single">
		
			<div class="archive-title"><span class="archive-type-icon"></span><h5><?php printf(__('All posts in &#8220;<span class="search-query">%s</span>&#8221;', 'spnoy'), $term->name ); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>

			<?php if ( $the_query->have_posts() ) : ?>
			
			<ul class="search-result-container">
				<span class="portfolio-type-icon"></span>
				<?php
					while( $the_query->have_posts() ) : $the_query->the_post(); 
						$the_search_excerpt = get_the_excerpt();
						if ( function_exists( 'wp_trim_words' ) ) {
							$the_search_excerpt = wp_trim_words( $the_search_excerpt, $num_words = 10, $more = null );
							$the_search_excerpt = ltrim(str_replace(array(' ','&nbsp;'),' ',$the_search_excerpt));
						}
						printf('<li><h5><a href="%1$s">%2$s</a></h5><p>%3$s</p></li>', get_permalink(), get_the_title(), $the_search_excerpt); 
					endwhile;
				?>
			</ul>
			
			<?php endif; ?>
			
		</div>
	</section>
	
<?php get_footer(); ?>