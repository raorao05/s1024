<!DOCTYPE html>
<!--[if lte IE 8]>         <html class="no-js ie ie8 ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js ie ie9 ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<!-- BEGIN head -->
<head>
	
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<!-- Title -->
	<title><?php bloginfo('name'); ?></title>
	
	<!-- Pingback -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?> 

<!-- END head -->
</head>
	<?php
		if ( function_exists( 'ot_get_option' ) ) {
			add_filter('body_class','website_color_class');
			function website_color_class ($classes) {
				$classes[] = ot_get_option( 'website_color', 'pink' );
				return $classes;
			}
		}
	?>
	<!-- BEGIN body -->
    <body <?php body_class(); ?>>
	
        <!--[if lt IE 8]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
		
		<!-- Begin .left-header -->
		<header class="left-header">
			<div id="scrollbar">
				<div class="handle"></div>
			</div>
			<div id="frame">	
			<div class="slidee">

			<!-- Begin .logo -->
			<h1 class="logo">
				<a href="<?php if ( function_exists( 'ot_get_option' ) ) { $roya_logo_url = ot_get_option( 'roya_logo_url', home_url() ); echo $roya_logo_url; } ?>">
					<?php
						if ( function_exists( 'ot_get_option' ) ) {
							$roya_logo = ot_get_option( 'roya_logo', get_stylesheet_directory_uri() . '/images/logo.png' );
							echo '<img src="' . $roya_logo . '" alt="Logo" />' ;
						} else {
							echo '<img src="'. get_stylesheet_directory_uri() .'/images/logo.png" alt="Logo"/>';
						}
					?>
				</a>
			<!-- End .logo -->
			</h1>
			
			<!-- Begin .left-header-nav -->
			<nav class="left-header-nav border-box-star">
				<?php wp_nav_menu( array( 'menu' => 'primary-menu', 'container' => false, 'menu_class' => 'primary-nav-menu' ) ); ?>
			<!-- End .left-header-nav -->
			</nav>
			
			<?php get_sidebar(); ?>
			
			<?php if ( function_exists( 'ot_get_option' ) AND ot_get_option( 'social_icon_enable_disable', 'disable' ) === "enable" ) { ?>
				<!-- Begin .social-icons -->
				<div class="social-icons">
					<ul>
						<?php
							if ( function_exists( 'ot_get_option' ) ) {
								$roya_social_icons = ot_get_option( 'social_icons', array() );
								foreach( $roya_social_icons as $icon ) {
								  echo '
								  <li>
									<a href="' . $icon['social_icon_link'] . '"><img src="' . $icon['social_icon_image'] . '" alt="' . $icon['title'] . '" /></a>
								  </li>';
								}
							}
						?>
					</ul>
				<!-- End .social-icons -->
				</div>
			<?php } ?>
			
			<!-- Begin .copyright -->
			<small class="copyright">
				<?php
					if ( function_exists( 'ot_get_option' ) ) {
						$roya_copyright = ot_get_option( 'copy_right', '' );
						echo $roya_copyright;
					}
				?>
			<!-- End .copyright -->
			</small>
		
			</div>
			</div>
		<!-- End .left-header -->
		</header>
			
		<!-- Begin .top-header-container -->
		<div class="top-header-container">
			<div class="top-header-inner">
				<div class="top-header border-box">
					<h1 class="logo">
						<a href="<?php if ( function_exists( 'ot_get_option' ) ) { $roya_logo_url = ot_get_option( 'roya_logo_url', home_url() ); echo $roya_logo_url; } ?>">
							<?php
								if ( function_exists( 'ot_get_option' ) ) {
									$roya_logo = ot_get_option( 'roya_logo',  get_stylesheet_directory_uri() . '/images/logo.png' );
									echo '<img src="' . $roya_logo . '" alt="logo" />' ;
								} else {
									echo '<img src="' . get_stylesheet_directory_uri() .'/images/logo.png" alt="logo"/>';
								}
							?>
						</a>
					</h1>
					<a class="mobile-menu-button" href="#mobile-menu"></a>
				</div>
			</div>
		<!-- End .top-header-container -->
		</div>
		
		<!-- Begin .top-nav -->
		<div class="top-nav border-box">
			<div class="top-nav-inner">
				<div class="top-nav-content">
					<?php get_template_part( 'searchform-responsive' ); ?>
					<?php wp_nav_menu( array( 'menu' => 'primary-menu', 'container' => false, 'menu_class' => 'primary-nav-menu' ) ); ?>
				</div>
			</div>
		<!-- End .top-nav -->
		</div>
		