
<?php get_header(); ?>

<div id="main">
	<div class="center">			
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div id="page" class="scol">	
					<h1><?php the_title();?></h1>
					
					<?php the_content();?>
					
					<div class="clear"></div>
					
					<?php get_template_part('edit');?>
					
					<div id="comments">
						<?php comments_template(); ?>
					</div>
				
			</div>
		
		<?php endwhile; ?>
		
		<div class="clear"></div>
	</div>	
</div>

<?php get_footer(); ?>
