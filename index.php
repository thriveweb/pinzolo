<?php get_header(); ?>
	
	<div id="main" class="center">
		
		<div id="bcont">
		
			<?php if( is_search() ) : ?> 

				<h2 class="btitle">Search results for <span class="sres"><?php echo $s?></span> <?php $my_query = new WP_Query("post_type=post&s=$s&showposts=-1"); echo $my_query->post_count; ?> hits</h2>	
				<?php get_template_part('bloghead');?>
				
				<?php if(!$my_query->post_count): ?>
					
					<!-- No results -->
					<h2 class="btitle">I looked everywhere but nothing matched your search terms. <br> Please try again with some different keywords.</h2>
					
				<?php endif; ?>	
				
			<?php elseif( is_archive() ) : ?>
				
				<h2 class="btitle">Posts in the <?php single_cat_title( ) ?> category</h2>
				<?php get_template_part('bloghead');?>
				
			<?php else : ?>				
				
				<?php get_template_part('bloghead');?>
				
			<?php endif; ?>		
			
			<?php while ( have_posts() ) : the_post(); ?>	
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >				
		
					<?php get_template_part('blogdets');?>
					
					<div class="content_wrap">
						<div class="content">
										
							<?php if ( is_search() ) {
								the_excerpt();
							} else {
								the_content();
								
								wp_link_pages('before=<div class="p_navigation"> Pages &after=</div>');
								
							} ?>
						</div>
					</div>
					
				</article>
				
				<div class="clear"></div>
				
			<?php endwhile; // End the loop. Whew. ?>
			
		</div>		
					
			<nav class="navigation">

				<?php wp_link_pages(); ?>				
				<div class="nav-previous"><?php previous_posts_link('Next'); ?></div>
				<div class="nav-next"><?php next_posts_link( 'Prev'); ?></div>
				 
			</nav>
			
			<div class="clear"></div>
				
	</div>

<?php  get_footer(); ?>
