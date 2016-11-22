<?php get_header(); ?>
		
	<section class="items-container-single">
		<div class="search-single">
		
	<?php
	
	/*-----------------------------------------------------------------------------------*/
	/*	set page to load all returned results
	/*-----------------------------------------------------------------------------------*/
	
		global $query_string;
		query_posts( $query_string . '&posts_per_page=-1');
		if( have_posts() ) :
		
	?>	
			<div class="search-title"><span class="search-icon"></span><h5><?php _e('Search Results for: ', 'spnoy') ?> &#8220;<span class="search-query"><?php the_search_query(); ?></span>&#8221;</h5><p><?php _e('W P LO CKE R .C OM - We did what we could, and we found these for you.', 'spnoy') ?></p></div>
			
			<ul class="search-result-container">
				<span class="post-type-icon"></span>
			<?php
				$i = 0;
				while( have_posts() ) : the_post(); 
					if( $post->post_type == 'post' ) {
						$i++;
						$the_search_excerpt = get_the_excerpt();
						if ( function_exists( 'wp_trim_words' ) ) {
							$the_search_excerpt = wp_trim_words( $the_search_excerpt, $num_words = 10, $more = null ); 
							$the_search_excerpt = ltrim(str_replace(array(' ','&nbsp;'),' ',$the_search_excerpt));
						}
						printf('<li><h5><a href="%1$s">%2$s</a></h5><p>%3$s</p></li>', get_permalink(), get_the_title(), $the_search_excerpt); 
					}
				endwhile;
				if( $i == 0 ) { printf('<li>%s</li>', __('No posts match the search terms', 'spnoy')); }
			?>
			</ul>
			<ul class="search-result-container search-result-container-portfolio">
				<span class="portfolio-type-icon"></span>
			<?php 

			/*-----------------------------------------------------------------------------------*/
			/*	Rewind posts to filter for portfolio items
			/*-----------------------------------------------------------------------------------*/
			
				rewind_posts();
				$i = 0;
				while( have_posts() ) : the_post();
					if( $post->post_type == 'portfolio' ) {
						$i++;
						$the_search_excerpt = get_the_excerpt();
						if ( function_exists( 'wp_trim_words' ) ) {
							$the_search_excerpt = wp_trim_words( $the_search_excerpt, $num_words = 10, $more = null ); 
							$the_search_excerpt = ltrim(str_replace(array(' ','&nbsp;'),' ',$the_search_excerpt));
						}
						printf('<li><h4><a href="%1$s">%2$s</a></h4><p>%3$s</p></li>', get_permalink(), get_the_title(), $the_search_excerpt); 
					}
				endwhile;
				
				if( $i == 0 ) { printf('<li><h4>%s</h4><p>It seems there is no match from portfolio section.</p></li>', __('No portfolio match.', 'spnoy')); }
				
			?>
			</ul>
			
			<?php else : ?>
			
			<div class="search-title"><span class="search-icon"></span><h5><?php _e('Search Results for: ', 'spnoy') ?> &#8220;<span class="search-query"><?php the_search_query(); ?></span>&#8221;</h5><p><?php _e("Sorry! We couldn't find what you're looking for.", 'spnoy') ?></p></div>
			
			<ul class="search-result-container">
				<span class="post-type-icon"></span>
				<li><h4><?php _e('Make sure all words are spelled correctly.', 'spnoy') ?></h4><p><?php _e('Use a dictionary perhaps.', 'spnoy') ?></p></li>
				<li><h4><?php _e('Try different keywords.', 'spnoy') ?></h4><p><?php _e('Try to be different.', 'spnoy') ?></p></li>
				<li><h4><?php _e('Try more general keywords.', 'spnoy') ?></h4><p><?php _e('Big word, Big meanings', 'spnoy') ?></p></li>
			</ul>
			
			<?php endif; ?>
			
		</div>
	</section>
	
<?php get_footer(); ?>