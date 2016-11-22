<?php

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 304, 294, true );
	add_image_size( 'portfolio-thumb', 304, 294, true);
	add_image_size( 'blog-thumb', 300, '', true);
}

add_action('init', 'portfolio_init');  
  
function portfolio_init() {
    $args = array(  
        'label' => __('Portfolio' , 'spnoy'),  
        'singular_label' => __('Project', 'spnoy'),  
        'public' => true,  
        'show_ui' => true,  
		'menu_position' => 5,
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail', 'comments')  
       );
    register_post_type( 'portfolio' , $args );  
}  

register_taxonomy("portfolio-category", array("portfolio"), array("hierarchical" => true, "label" => "Portfolio Categories", "singular_label" => "Project Type", "rewrite" => true));

add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");   
  
function portfolio_edit_columns($columns)	{
		$columns = array(  
			"cb" => "<input type=\"checkbox\" />",  
			"title" => "Title",  
			"description" => "Description",  
			"type" => "Portfolio Category",  
		);  
		return $columns;  
}  

add_action("manage_posts_custom_column",  "portfolio_custom_columns"); 
  
function portfolio_custom_columns($column)	{
	global $post;  
	switch ($column)
	{  
		case "description":  
			the_excerpt();  
			break;
		case "type":  
			echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');  
			break;  
	}  
}  

?>