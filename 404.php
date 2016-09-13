
<?php get_header(); ?>

<div id="main" class="center">	
		
		<div id="bcont">
			<?php get_template_part('bloghead');?>
		</div>
		
		<div id="page" class="scol">			
			
			
			
			<div class="content">
				<h1 class="tacenter big">404</h1>
				<h2 class="tacenter" >You seem to be lost? Click <a href="<?php echo esc_url( home_url( '/' ) ); ?>">here</a> to go home</h2>	
			</div>
			
		</div>	
	
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>
