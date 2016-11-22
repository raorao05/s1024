<?php

/*-----------------------------------------------------------------------------------*/
/*	Include Option Tree in Theme
/*-----------------------------------------------------------------------------------*/

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );

include_once( 'option-tree/ot-loader.php' );
include_once( 'lib/admin/theme-options/theme-options.php' );


/*-----------------------------------------------------------------------------------*/
/*	Add Portfolio To Admin
/*-----------------------------------------------------------------------------------*/

require_once('lib/admin/portfolio.php');


/*-----------------------------------------------------------------------------------*/
/*	Register Nav Menu
/*-----------------------------------------------------------------------------------*/

register_nav_menu( 'primary-menu', __('Primary Menu', 'spnoy') );
function register_my_menus() {
	register_nav_menu( 'primary-menu', __('Primary Menu', 'spnoy') );
}
add_action( 'init', 'register_my_menus' );


/*-----------------------------------------------------------------------------------*/
/*	 Disable The Admin Bar & Add Theme Support for Auto Feed Links
/*-----------------------------------------------------------------------------------*/

show_admin_bar(false);
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width
/* ----------------------------------------------------------------------------------*/

if ( ! isset($content_width) ) {
	$content_width = 680;
}


/*-----------------------------------------------------------------------------------*/
/*	 Add Scripts & Styles Properly
/*-----------------------------------------------------------------------------------*/


function roya_scripts_and_styles() {

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.1.min.js', null, 2.6, false );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'pretty-photo', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'images-loaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'sly', get_template_directory_uri() . '/js/jquery.sly.min.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.js', array( 'jquery' ), 1.0, false );
	wp_register_script( 'main-scripts', get_template_directory_uri() . '/js/main-script.js', array( 'jquery' , 'isotope' , 'flexslider', 'images-loaded', 'sly', 'hoverIntent' ), 1.2, false );
	wp_register_script( 'portfolio-script', get_template_directory_uri() . '/js/portfolio-script.js', array( 'jquery' , 'pretty-photo', 'images-loaded', 'sly', 'hoverIntent' ), 1.2, false );
	wp_register_script( 'blog-ajax-handler', get_template_directory_uri() . '/js/blog-ajax-handler.js', array( 'isotope' , 'main-scripts' ), 1.1, false );
	wp_register_script( 'portfolio-ajax-handler', get_template_directory_uri() . '/js/portfolio-ajax-handler.js', array( 'isotope' ), 1.1, false );
	wp_register_script( 'respond-polyfill', get_template_directory_uri() . '/js/respond.min.js', null, 1.0, false );
	wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', null, 1.0, false );


	wp_register_style( 'main-stylesheet', get_template_directory_uri() . '/style.css', null, 1.1, 'screen' );
	wp_register_style( 'pretty-photo', get_template_directory_uri() . '/css/prettyPhoto.css', null, 1.0, 'screen' );
	wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', null, 1.0, 'screen' );
	wp_register_style( 'sly', get_template_directory_uri() . '/css/jquery.sly.css', null, 1.0, 'screen' );
	
	wp_enqueue_style( 'main-stylesheet' );
	wp_enqueue_style( 'flexslider' );
	wp_enqueue_style( 'sly' );
	
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'isotope' );
	wp_enqueue_script( 'tinynav' );
	wp_enqueue_script( 'flexslider' );
	wp_enqueue_script( 'images-loaded' );
	wp_enqueue_script( 'respond-polyfill' );
	wp_enqueue_script( 'fitvids' );
	wp_enqueue_script( 'sly' );
	wp_enqueue_script( 'hoverIntent' );
	
	if ( is_page_template( 'template-portfolio.php' ) ) {
		wp_enqueue_script( 'portfolio-script' );
		wp_enqueue_script( 'portfolio-ajax-handler' );
		wp_enqueue_script( 'jquery.prettyPhoto' );
		wp_enqueue_style( 'pretty-photo' );
	} elseif ( is_page_template( 'template-blog.php' ) || is_home() ) {
		wp_enqueue_script( 'main-scripts' );
		wp_enqueue_script( 'blog-ajax-handler' );
	} else {
		wp_enqueue_script( 'main-scripts' );
	}
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	
}

add_action( 'wp_enqueue_scripts', 'roya_scripts_and_styles' );


/*-----------------------------------------------------------------------------------*/
/*	Add Google Fonts ==> Disabled becuase of not supporting IE8 :(
/*-----------------------------------------------------------------------------------

function load_google_fonts() {
	wp_register_style('google-font-title', 'http://fonts.googleapis.com/css?family=Archivo+Narrow');
	wp_register_style('google-font-others', 'http://fonts.googleapis.com/css?family=Arimo');
	wp_enqueue_style('google-font-title');
	wp_enqueue_style('google-font-others');
}

add_action('wp_print_styles', 'load_google_fonts');*/



/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/


function sidebar_init() {
	register_sidebar(array(
		'name' => __('Main Sidebar', 'spnoy'),
		'id' => 'main-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

add_action( 'widgets_init', 'sidebar_init' );


/*-----------------------------------------------------------------------------------*/
/*	Add Custom Gallery Shortcode
/*-----------------------------------------------------------------------------------*/


add_shortcode('roya-gallery', 'roya_gallery');

function roya_gallery() {

	global $post;
	
	$galleryArgs = array(
		'numberposts' => -1, // Using -1 loads all posts  
		'orderby' => 'menu_order', // This ensures images are in the order set in the page media manager  
		'order'=> 'ASC',  
		'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos  
		'post_parent' => $post->ID, // Important part - ensures the associated images are loaded 
		'post_status' => null, 
		'post_type' => 'attachment'  
	);  
	
	$galleryImages = get_children( $galleryArgs );  
	
	if ($galleryImages) {
		echo '<div class="flexslider roya-flexslider">';
		echo '<ul class="slides">';
		foreach($galleryImages as $image) { 
			echo '<li>';
				echo '<img src="'. $image->guid . '" alt="' . $image->post_title . '" title="' . $image->post_title . '" /> ';
			echo '</li>';
		} 
		echo '</ul>';
		echo '</div>';
	}
	
}


/*-----------------------------------------------------------------------------------*/
/*	Add Custom Advanced Gallery Shortcode
/*-----------------------------------------------------------------------------------*/

add_shortcode('advanced-roya-gallery', 'advanced_roya_gallery');

function advanced_roya_gallery() {

	global $post;
	
	$galleryAdvancedArgs = array(
		'numberposts' => -1, // Using -1 loads all posts  
		'orderby' => 'menu_order', // This ensures images are in the order set in the page media manager  
		'order'=> 'ASC',  
		'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos  
		'post_parent' => $post->ID, // Important part - ensures the associated images are loaded 
		'post_status' => null, 
		'post_type' => 'attachment'  
	);  
	
	$galleryAdvancedImages = get_children( $galleryAdvancedArgs );  
	
	if ($galleryAdvancedImages) {
	
		echo '<div id="roya-flexslider-advanced" class="flexslider">';
		echo '<ul class="slides">';
		foreach($galleryAdvancedImages as $image) { 
			echo '<li>';
				echo '<img src="'. $image->guid . '" alt="' . $image->post_title . '" title="' . $image->post_title . '" /> ';
			echo '</li>';
		} 
		echo '</ul>';
		echo '</div>';

		echo '<div id="roya-carousel-advanced" class="flexslider">';
			echo '<ul class="slides">';
				foreach($galleryAdvancedImages as $image) { 
					echo '<li>';
						echo '<img src="'. $image->guid . '" alt="' . $image->post_title . '" title="' . $image->post_title . '" /> ';
					echo '</li>';
				} 
			echo '</ul>';
		echo '</div>';
		
	}
	
}


/*-----------------------------------------------------------------------------------*/
/*	Add Options to Website Color Select on Theme Options
/*-----------------------------------------------------------------------------------*/


function filter_radio_images( $array, $field_id ) {
  
  if ( $field_id == 'website_color' ) {
    $array = array(
      array(
        'value'   => 'pink',
        'label'   => __( 'Pink' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/pink.png'
      ),
      array(
        'value'   => 'brown',
        'label'   => __( 'Brown' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/brown.png'
      ),
	  array(
        'value'   => 'cyan',
        'label'   => __( 'Cyan' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/cyan.png'
      ),
	  array(
        'value'   => 'black',
        'label'   => __( 'Black' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/black.png'
      ),
	  array(
        'value'   => 'green',
        'label'   => __( 'Green' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/green.png'
      ),
	  array(
        'value'   => 'blue',
        'label'   => __( 'Blue' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/blue.png'
      ),
	  array(
        'value'   => 'red',
        'label'   => __( 'Red' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/red.png'
      ),
	  array(
        'value'   => 'orange',
        'label'   => __( 'Orange' , 'spnoy'),
        'src'     => get_template_directory_uri()  . '/images/orange.png'
      )
    );
  }
  
  return $array;
  
}

add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );


/*-----------------------------------------------------------------------------------*/
/*	 Include ZillaLike Plugin Properly
/*-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'load_zillalikes');

function load_zillalikes() {
	if (!class_exists('ZillaLikes')) {
		include_once( get_template_directory() .  '/lib/admin/zilla-likes/zilla-likes.php');	
	}
}


/*-----------------------------------------------------------------------------------*/
/*	 Include Roya Custom Latest Post Plugin/Widget Properly
/*-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'load_roya_custom_widget');

function load_roya_custom_widget() {
	if (!class_exists('RoyaCustomLatestPost')) {
		include_once( get_template_directory() .  '/lib/admin/roya-custom-latest-post-widget/roya-custom-latest-post-widget.php');	
	}
}


/*-----------------------------------------------------------------------------------*/
/*	New Excerpt
/*-----------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



function md_nmi_custom_content( $content, $item_id, $original_content ) {
  $content = $content . '<span>' . $original_content . '</span>';
  return $content;
}
add_filter( 'nmi_menu_item_content', 'md_nmi_custom_content', 10, 3 );


/*-----------------------------------------------------------------------------------*/
/*	Remove Shortcodes from Blog List Content
/*-----------------------------------------------------------------------------------

function remove_shortcode_from_blog_list($content) {
	if ( is_page_template( 'template-blog.php' ) || is_home()  ) {
		$content = strip_shortcodes( $content );
	}
  return $content;
}
add_filter('the_content', 'remove_shortcode_from_blog_list');*/


/*-----------------------------------------------------------------------------------*/
/*	Add Meta Box To Admin Panel For Default Page Template
/*-----------------------------------------------------------------------------------*/

add_action( 'load-page.php', 'page_detail_meta_setup' );
add_action( 'load-page-new.php', 'page_detail_meta_setup' );

function page_detail_meta_setup() {
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	if ($template_file == 'default') {
		add_action( 'add_meta_boxes', 'add_page_detail_metabox' );
		add_action( 'save_post', 'save_page_detail_metabox', 10, 2 );
	}
}

function add_page_detail_metabox() {
	add_meta_box(
		'page_detail_text',
		esc_html__( 'Page Detail' , 'spnoy'),
		'page_detail_metabox',
		'page',
		'normal',
		'high'
	);
}

function page_detail_metabox( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'page_detail_nonce' ); ?>
	<p>
		<label for="page_detail_text"><?php _e( "What this page is about : ", 'spnoy'); ?></label>
		<br /><br />
		<input class="widefat" type="text" name="page_detail_text" id="page_detail_text" value="<?php echo esc_attr( get_post_meta( $object->ID, 'page_detail_text', true ) ); ?>" />
	</p>
<?php }

function save_page_detail_metabox( $post_id, $post ) {
	// Check permissions
	if ( !isset( $_POST['page_detail_nonce'] ) || !wp_verify_nonce( $_POST['page_detail_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	// Everything is ok, now save, update or delete postmeta
	$new_meta_value = ( isset( $_POST['page_detail_text'] ) ? $_POST['page_detail_text'] : '' );
	$meta_key = 'page_detail_text';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );	
}


/*-----------------------------------------------------------------------------------*/
/*	Add Meta Box To Admin Panel For Video
/*-----------------------------------------------------------------------------------*/


add_action( 'add_meta_boxes', 'add_folio_video_metabox' );
add_action( 'save_post', 'save_folio_video_metabox', 10, 2 );

function add_folio_video_metabox() {
	add_meta_box(
		'folio_video_url',
		esc_html__( 'Featured Video' , 'spnoy'),
		'folio_video_metabox',
		'portfolio',
		'side',
		'default'
	);
}

function folio_video_metabox( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'folio_video_nonce' ); ?>
	<p>

		<input class="widefat" type="text" name="folio_video_url" id="folio_video_url" placeholder="e.g. http://www.youtube.com/watch?v=JaFVr_cJJIY" value="<?php echo esc_attr( get_post_meta( $object->ID, 'folio_video_url', true ) ); ?>" />
	</p>
<?php }

function save_folio_video_metabox( $post_id, $post ) {
	// Check permissions
	if ( !isset( $_POST['folio_video_nonce'] ) || !wp_verify_nonce( $_POST['folio_video_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	// Everything is ok, now save, update or delete postmeta
	$new_meta_value = ( isset( $_POST['folio_video_url'] ) ? $_POST['folio_video_url'] : '' );
	$meta_key = 'folio_video_url';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );	
}


/*-----------------------------------------------------------------------------------*/
/*	Add Meta Box To Admin Panel For Disabling Footer
/*-----------------------------------------------------------------------------------*/


add_action( 'add_meta_boxes', 'add_page_options_metabox' );
add_action( 'save_post', 'save_page_options_metabox', 10, 2 );

function add_page_options_metabox( $postType ) {
	$types = array('post','page','portfolio');
	if( in_array($postType, $types) ) {
		add_meta_box(
			'page_options',
			esc_html__( 'Page Options' , 'spnoy'),
			'page_options_metabox',
			$postType,
			'normal',
			'high'
		);
	}
}

function page_options_metabox( $object, $box ) { ?>
	<?php
		global $post;
		$disableFooterCheck = get_post_meta( $post->ID, 'disable_footer', true );  
		$disableFooterCheck = isset( $disableFooterCheck ) ? esc_attr( $disableFooterCheck ) : '';  
		$disablehDateCheck = get_post_meta( $post->ID, 'disable_hdate', true );  
		$disablehDateCheck = isset( $disablehDateCheck ) ? esc_attr( $disablehDateCheck ) : '';  
		wp_nonce_field( basename( __FILE__ ), 'disable_footer_nonce' );
	?>
	
	<p>
		<b><label style="padding-right:100px;" for="disable_footer"><?php _e( "Disable Footer", 'spnoy'); ?></label></b>
		<input type="checkbox" id="disable_footer" name="disable_footer" value="disable" <?php checked( $disableFooterCheck , 'disable' ); ?> /> Check this option to hide entire footer from this page.
		<br /><br />
		<b><label style="padding-right:66px;" for="disable_hdate"><?php _e( "Disable Header Date", 'spnoy'); ?></label></b>
		<input type="checkbox" id="disable_hdate" name="disable_hdate" value="disable" <?php checked( $disablehDateCheck , 'disable' ); ?> /> Check this option to hide header date box from this page.
	</p>
<?php }

function save_page_options_metabox( $post_id, $post ) {
	// Check permissions
	if ( !isset( $_POST['disable_footer_nonce'] ) || !wp_verify_nonce( $_POST['disable_footer_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	$post_type = get_post_type_object( $post->post_type );
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	// Everything is ok, now save, update or delete postmeta
	$new_meta_value = ( isset( $_POST['disable_footer'] ) ? $_POST['disable_footer'] : '' );
	$meta_key = 'disable_footer';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );	
		
	$new_meta_value = ( isset( $_POST['disable_hdate'] ) ? $_POST['disable_hdate'] : '' );
	$meta_key = 'disable_hdate';
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}



/*-----------------------------------------------------------------------------------*/
/*	Pings Styling
/*-----------------------------------------------------------------------------------*/

function theme_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php 
}



/*-----------------------------------------------------------------------------------*/
/*	Comments Styling
/*-----------------------------------------------------------------------------------*/


function theme_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div id="comment-<?php comment_ID(); ?>">
			
			<div class="avatar-border"><?php echo get_avatar($comment,$size='67'); ?></div>
			
			<div class="comment-meta commentmetadata">
				<span class="comment-author vcard">
					<?php if( $comment->comment_parent ) {
						$parent = get_comment( $comment->comment_parent );
						$parent_author = ($parent->comment_author) ? $parent->comment_author : __('Anonymous', 'spnoy');
						printf('<cite class="fn">%s</cite>', get_comment_author_link());
						_e(' Replied to ', 'spnoy');
						echo '<cite class="fn">' . $parent_author . '</cite>';
					} else {
						printf('<cite class="fn">%s</cite>', get_comment_author_link());                     
					} ?>
				</span>

				<br />
				<a class="comment-time" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'spnoy'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('[Edit]', 'spnoy'),'  ','') ?>
					
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>

			<?php if ($comment->comment_approved == '0') : ?>
				<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'spnoy') ?></em><br />
			<?php endif; ?>

			<div class="comment-body">
				<?php comment_text() ?>
			</div>

		</div>
<?php
}



?>
