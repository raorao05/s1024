<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'left_header',
        'title'       => 'Left Header'
      ),
      array(
        'id'          => 'contact_page',
        'title'       => 'Contact Page'
      ),
      array(
        'id'          => 'sharing_buttons',
        'title'       => 'Sharing Buttons'
      ),
      array(
        'id'          => 'advanced',
        'title'       => 'Advanced'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'roya_logo',
        'label'       => 'Logo',
        'desc'        => 'Upload your own logo',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'left_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'roya-logo'
      ),
      array(
        'id'          => 'roya_logo_url',
        'label'       => 'Logo URL',
        'desc'        => 'By default logo is linked to the Home page, if you want, you can change it through the text box.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'left_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_icon_enable_disable',
        'label'       => 'Social Icon Enable/Disable',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'left_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable',
            'label'       => 'Enable',
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => 'Disable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'social_icons',
        'label'       => 'Social Icons',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'left_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'social_icon_image',
            'label'       => 'Social Icon',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'social_icon_link',
            'label'       => 'Link',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'copy_right',
        'label'       => 'Copy Right',
        'desc'        => 'Enter your copyright term',
        'std'         => 'T H EM E  S H AR E D   ON  WP L O CKE R .C  OM ',
        'type'        => 'text',
        'section'     => 'left_header',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => 'copy_right'
      ),
      array(
        'id'          => 'google_map_url',
        'label'       => 'Google Map URL',
        'desc'        => 'Enter Your Google Map URL
<br />
Make sure that the URL has &amp;output=embed at the end',
        'std'         => 'https://maps.google.com/maps?hl=en&ll=43.370835,-79.83078&spn=0.022992,0.045447&t=m&z=15&output=embed',
        'type'        => 'text',
        'section'     => 'contact_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'contact_form_title',
        'label'       => 'Contact Form Title',
        'desc'        => '',
        'std'         => 'Contact Form',
        'type'        => 'text',
        'section'     => 'contact_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'contact_detail_title',
        'label'       => 'Contact Detail Title',
        'desc'        => '',
        'std'         => 'Contact Detail',
        'type'        => 'text',
        'section'     => 'contact_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'contact_detail_content',
        'label'       => 'WP L OC K ER.CO M - Contact Detail Content',
        'desc'        => '',
        'std'         => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.fact that a reader will be distracted 1500.',
        'type'        => 'textarea',
        'section'     => 'contact_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'contact_detail_items',
        'label'       => 'Contact Detail Items',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'contact_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'contact_detail_item_image',
            'label'       => 'Contact Detail Item Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'sharing_buttons',
        'label'       => 'Sharing buttons Enable/Disable',
        'desc'        => '',
        'std'         => 'disable',
        'type'        => 'radio',
        'section'     => 'sharing_buttons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable',
            'label'       => 'Enable',
            'src'         => ''
          ),
          array(
            'value'       => 'disable',
            'label'       => 'Disable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'portfolio_sharing_buttons_type',
        'label'       => 'Portfolio sharing buttons type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'sharing_buttons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'facebook_share',
            'label'       => 'Facebook Share',
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'google_plus',
            'label'       => 'Google+',
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_sharing_buttons_type',
        'label'       => 'Blog sharing buttons type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'sharing_buttons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'facebook_share',
            'label'       => 'Facebook Share',
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'google_plus',
            'label'       => 'Google+',
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_sharing_buttons_type',
        'label'       => 'Page sharing butons type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'sharing_buttons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'facebook_share',
            'label'       => 'Facebook share',
            'src'         => ''
          ),
          array(
            'value'       => 'twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'google_plus',
            'label'       => 'Google+',
            'src'         => ''
          ),
          array(
            'value'       => 'linkedin',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'website_color',
        'label'       => 'Website Color',
        'desc'        => '',
        'std'         => 'pink',
        'type'        => 'radio-image',
        'section'     => 'advanced',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_post_per_page',
        'label'       => 'Blog Post per Page',
        'desc'        => '',
        'std'         => '10',
        'type'        => 'text',
        'section'     => 'advanced',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'portfolio_post_per_page',
        'label'       => 'Portfolio Post per Page',
        'desc'        => '',
        'std'         => '10',
        'type'        => 'text',
        'section'     => 'advanced',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}