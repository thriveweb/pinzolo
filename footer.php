
			<?php 
			$logo = get_option('logo');?>
			<footer class="footer_section">
				<div class="center">
					<div class="footer_main">
						<?php if( !empty( $logo )):?>
							<div class="footer_right">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<img src="<?php echo esc_url($logo) ?>" alt="<?php bloginfo('name'); ?> "/>
								</a>
							</div>
						<?php endif;?>
						<div class="footer_left">
							<div class="footer_col">
								<p> &copy; <?php echo date('Y'); ?> Pinzolo Theme</p>
								<p> Made on the Gold Coast by <a href="https://thriveweb.com.au/" target="_blank">THRIVE</a></p>
								<p class="powered_by"> Powered by <a href="http://wordpress.org/" title="WordPress">WordPress</a></p>
							</div>
							<div class="footer_col">
								<p>SOCIAL</p>
								<?php my_social_media_icons(); ?>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<?php wp_footer(); ?>

</body>
</html>
