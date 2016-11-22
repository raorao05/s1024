<?php get_header(); ?>

	<?php
		if ( get_query_var('author_name') ) {
			$curauth = get_user_by( 'login', get_query_var('author_name') );
		} else {
			$curauth = get_userdata(get_query_var('author'));
		}
	?>
	
	<!-- Begin .items-container-single -->
	<section class="items-container-single">
		<!-- Begin .archive-single -->
		<div class="archive-single">
			
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    	 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php printf(__('All posts in &#8220;<span class="search-query">%s</span>&#8221;', 'spnoy'), single_cat_title('',false)); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    	 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php printf(__('All posts tagged &#8220;<span class="search-query">%s</span>&#8221;', 'spnoy'), single_tag_title('',false)); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    	 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php _e('Archive for ', 'spnoy') ?><?php the_time( get_option('date_format' )); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    	 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php _e('Archive for ', 'spnoy') ?> <?php the_time('F, Y'); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    	 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php _e('Archive for ', 'spnoy') ?> <?php the_time('Y'); ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    		  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php _e('All posts by ', 'spnoy') ?> <?php echo $curauth->display_name; ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
    	 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<div class="archive-title"><span class="archive-type-icon"></span><h5><?php _e('Blog Archives ', 'spnoy') ?></h5><p><?php _e('All that we could find are listed below.', 'spnoy'); ?></p></div>
			<?php } ?>
			
			<?php if (have_posts()) : ?>
			
			<!-- Begin .search-result-container -->
			<ul class="search-result-container">
				<span class="post-type-icon"></span>
				<?php
					while( have_posts() ) : the_post(); 
						$the_search_excerpt = get_the_excerpt();
						if ( function_exists( 'wp_trim_words' ) ) {
							$the_search_excerpt = wp_trim_words( $the_search_excerpt, $num_words = 10, $more = null ); 
							$the_search_excerpt = ltrim(str_replace(array(' ','&nbsp;'),' ',$the_search_excerpt));
						}
						printf('<li><h5><a href="%1$s">%2$s</a></h5><p>%3$s</p></li>', get_permalink(), get_the_title(), $the_search_excerpt); 
					endwhile;
				?>
			<!-- End .search-result-container -->
			</ul>
			
			<?php endif; ?>
			
		<!-- End .archive-single -->
		</div>
	<!-- End .items-container-single -->
	</section>
	
<?php get_footer(); ?>