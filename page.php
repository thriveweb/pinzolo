
<?php get_header(); ?>

<div id="main" class="center">
			
	<?php while ( have_posts() ) : the_post(); ?>
		
		<div id="page" class="scol">			
			
			<div class="content">
				
				<h1><?php the_title();?></h1>
				
				<?php the_content();?>
				
				<div class="clear"></div>
				
				<?php get_template_part('edit');?>
				
				<div id="comments">
					<?php comments_template(); ?>
				</div>
					
			</div>
			
		</div>
	
	<?php endwhile; // End the loop. Whew. ?>
	
	
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>
