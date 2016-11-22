<?php
/*
Template Name: Contact Form
*/
?>

<?php get_header() ?>
			
			<section class="items-container-wrap">
				<div class="items-container-contact">
					<div id="contact-<?php the_ID(); ?>" <?php post_class('contact-single' ); ?>>
						<div class="contact-map">
							<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php if ( function_exists( 'ot_get_option' ) ) { $roya_map_url = ot_get_option( 'google_map_url', '' ); echo $roya_map_url; } ?>"></iframe>
						</div>
						
						<div class="contact-detail contact-detail-mobile">
							<h3 class="medium-title"><?php if ( function_exists( 'ot_get_option' ) ) { $roya_contact_detail = ot_get_option( 'contact_detail_title', 'Contact Detail'); echo $roya_contact_detail; } ?></h3>
							<div class="contact-detail-content"><?php if ( function_exists( 'ot_get_option' ) ) { $roya_contact_content = ot_get_option( 'contact_detail_content'); echo $roya_contact_content; } ?></div>
							<ul>
								<?php
									if ( function_exists( 'ot_get_option' ) ) {
										$roya_contact_detail_item = ot_get_option( 'contact_detail_items', array() );
										foreach( $roya_contact_detail_item as $item ) {
											echo '
											<li>
												<img src="' . $item['contact_detail_item_image'] . '" alt="' . $item['title'] . '" />' . $item['title'] . '
											</li>';
										}
									}
								?>
							</ul>
						</div>
						
						<div class="contact-form">
							<h3 class="medium-title"><?php if ( function_exists( 'ot_get_option' ) ) { $roya_contact_form = ot_get_option( 'contact_form_title', 'Contact form'); echo $roya_contact_form; } ?></h3>
							<?php if (have_posts()) : ?>
								<?php while (have_posts()) : the_post(); ?>
									
									<div class="the-contact-form">
										<?php the_content(""); ?>
									</div>
					
								<?php endwhile; ?>
							<?php else : ?>

							<h2 class="center"><?php _e('Not Found', 'spnoy'); ?></h2>

							<?php endif; ?>		
						</div>
						
						<div class="contact-detail">
							<h3 class="medium-title"><?php if ( function_exists( 'ot_get_option' ) ) { $roya_contact_detail = ot_get_option( 'contact_detail_title'); echo $roya_contact_detail; } ?></h3>
							<div class="contact-detail-content"><?php if ( function_exists( 'ot_get_option' ) ) { $roya_contact_content = ot_get_option( 'contact_detail_content'); echo $roya_contact_content; } ?></div>
							<ul>
								<?php
									if ( function_exists( 'ot_get_option' ) ) {
										$roya_contact_detail_item = ot_get_option( 'contact_detail_items', array() );
										foreach( $roya_contact_detail_item as $item ) {
											echo '
											<li>
												<img src="' . $item['contact_detail_item_image'] . '" alt="' . $item['title'] . '" />' . $item['title'] . '
											</li>';
										}
									}
								?>
							</ul>
						</div>
						
					</div>
				</div>
			</section>
			
<?php get_footer(); ?>
