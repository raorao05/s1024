<?php
/*
Plugin Name: Roya custom latest post widget
Plugin URI: http://spnoy.com/
Description: Latest post with readmore button, this is customized widget only for this theme.
Author: Spnoy
Version: 1
Author URI: http://spnoy.com/
*/
 
 
class RoyaCustomLatestPost extends WP_Widget {

  function RoyaCustomLatestPost()
  {
    $widget_ops = array('classname' => 'RoyaCustomLatestPost', 'description' => 'Roya custom latest post widget' );
    $this->WP_Widget('RoyaCustomLatestPost', 'Roya Custom Latest Post', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // Output
    echo '<div class="latest-post-custom">';
		query_posts('posts_per_page=1');
		global $post;

		the_post();
		echo '<h3><a href="' . get_permalink($post->ID) . '">' . get_the_title() . '</a></h3>';
		echo '<div class="left-nav-feature-content">' . ltrim(str_replace(array(' ','&nbsp;'),' ',get_the_excerpt())) . '</div>';
		echo '<a href="' . get_permalink($post->ID) . '" class="custom-read-more border-box"><span></span>read more</a>';

		wp_reset_query();
	echo '</div>';
	
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("RoyaCustomLatestPost");') );

?>