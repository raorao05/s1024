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
	'post_type'	=> 'portfolio',
	'posts_per_page' => $numPosts,
	'paged'          => $page
));


/*-----------------------------------------------------------------------------------*/
/*	The Loop
/*-----------------------------------------------------------------------------------*/

?>

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
<?php endwhile; endif; ?>
<?php wp_reset_query(); ?>