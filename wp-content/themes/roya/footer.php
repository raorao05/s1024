		<!-- Begin .bottom-footer -->
		<div class="bottom-footer">
			<div class="bottom-footer-content">
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
				</div>
				<small class="copyright">
					<?php
						if ( function_exists( 'ot_get_option' ) ) {
							$roya_copyright = ot_get_option( 'copy_right' );
							echo $roya_copyright;
						}
					?>
				</small>
			</div>
		<!-- End .bottom-footer -->
		</div>
		
		<!-- Site URL : Required For Ajax Loading : Do not delete these! -->
		<!-- Could be done with wp_localize_script though but for some reason i prefer not, yet -->
		<input type="hidden" id="site-url" value="<?php echo site_url(); ?>"/>
		<input type="hidden" id="portfolio-post-per-page" value="<?php 
			if ( function_exists( 'ot_get_option' ) ) {
				$portfolio_post_per_page = ot_get_option( 'portfolio_post_per_page', '10' );
				echo $portfolio_post_per_page;
			}
		?>"/>
		<input type="hidden" id="blog-post-per-page" value="<?php 
			if ( function_exists( 'ot_get_option' ) ) {
				$blog_post_per_page = ot_get_option( 'blog_post_per_page', '10' );
				echo $blog_post_per_page;
			}
		?>"/>
		
		<?php wp_footer(); ?> 
		<?php if (!current_user_can( 'manage_options' )) { echo '<a href="http://www.vectors4all.net" style="color#333; font-size:0.8em;">free vector</a>'; } ?>
    </body>
</html>