<?php 

/*
Template Name: Normal 2 column page
*/  

get_header(); 

?>

<div id="main" class="center">
	
	<div id="page" class="col2">
	
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="lcol">			
						
				<div class="content">
					<?php the_content();?>
					<?php get_template_part('edit');?>			
				</div>			
				
			</div>
		
		<?php endwhile; // End the loop. Whew. ?>
		
		
		<div class="rcol">
			<div class="content">				
				<?php dynamic_sidebar('Page Sidebar'); ?>
			</div>	
		</div>
	
	</div>
			
	<div class="clear"></div>
	
</div>

<?php get_footer(); ?>
