<?php

/*-----------------------------------------------------------------------------------*/
/*	Necessary Includes
/*-----------------------------------------------------------------------------------*/

define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');


/*-----------------------------------------------------------------------------------*/
/*	Define Variables
/*-----------------------------------------------------------------------------------*/

$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;


query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page
));


/*-----------------------------------------------------------------------------------*/
/*	The Loop
/*-----------------------------------------------------------------------------------*/

?>

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
					echo $new_content;
				?>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>