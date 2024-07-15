<?php get_header(); ?>
	
	<div id="main">
		
		<div id="bcont">
		
			<?php if( is_search() ) : ?> 
				<div class="center">

					<h2 class="btitle">Search results for <span class="sres"><?php echo esc_html($s, 1);?></span> <?php $my_query = new WP_Query("post_type=post&s=$s&showposts=-1"); echo $my_query->post_count; ?> hits</h2>	
					
					<?php if(!$my_query->post_count): ?>
						
						<!-- No results -->
						<h2 class="btitle">I looked everywhere but nothing matched your search terms. <br> Please try again with some different keywords.</h2>
						
					<?php endif; ?>	
				</div>
				
			<?php elseif( is_archive() ) : ?>
				
				<div class="center">
					<h2 class="btitle">Posts in the <?php single_cat_title( ) ?> category</h2>
				</div>
				
			<?php endif; ?>		
			
			<?php while ( have_posts() ) : the_post(); ?>	
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >	

					<div class="center">		
		
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
					</div>
				</article><div class="clear"></div>
				
			<?php endwhile; ?>
			
		</div>		
		
		<div class="center navigation-pagination">	
		<?php
			$pagination_option = get_theme_mod('pagination_option', 'load_more');
			$ajax_option = get_option('ajax');

			if ($pagination_option === 'load_more') :
			    // Load More button and logic
			    ?>
			    <div class="load-more">Load More Content</div>
			<?php else :
				if($ajax_option == "_pagination")
				{
			    // Pagination and logic
			    global $wp_query;

			    $big = 999999999; // need an unlikely integer

			    echo paginate_links(array(
			        'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			        'format'  => '?paged=%#%',
			        'current' => max(1, get_query_var('paged')),
			        'total'   => $wp_query->max_num_pages,
			    ));
			}
			endif;
		?>




		</div>
		
		<div class="clear"></div>
				
	</div>



<?php  get_footer(); ?>
