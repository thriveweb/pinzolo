<?php get_header(); ?>
	
	<div id="main" class="center">
		
		<div id="bcont" >
			
			<?php get_template_part('bloghead');?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
				
					<?php get_template_part('blogdets');?>
				
					<div class="content_wrap">
						<div class="content">
										
							<?php the_content();?>
							
							<?php wp_link_pages('before=<div class="p_navigation"> Pages &after=</div>'); ?> 
														
							<div class="clear"></div>
							
				            <div id="post_nav">
				            
				            	<?php if( is_attachment() ) : ?>
				                    
				                    <div id="pn_next" class="pn">
				                    	<?php next_image_link(); ?>
				                    </div>
				                    
				                    <div id="pn_prev" class="pn">
				                    	<?php previous_image_link(); ?>
				                    </div>				                    
					            				
				            	<?php else : ?>
				            	
					            	<?php
				                    $prev_post = get_adjacent_post(false, '', true);
				                    $next_post = get_adjacent_post(false, '', false); 
				                    ?>
				            	
					            	<p id="pn_next" class="pn">
				                    <?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
				                        <?php echo $next_post_title; ?> <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow-right" /><br/>
				                        <a class="post-next" href="<?php echo $next_post_url; ?>"><span>Next post </span></a>
				                    <?php endif; ?>
				                    </p>
				                    
				                    <p id="pn_prev" class="pn">
				                    <?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
				                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left.svg" alt="arrow-left" /> <?php echo $prev_post_title; ?><br/>
				                        <a class="post-prev" href="<?php echo $prev_post_url; ?>"><span>Previous post</span></a>
				                    <?php endif; ?>
				                    </p>	
			                    
				            	<?php endif; ?>
			                  
			                    <div id="mline"></div>
			                    
				            </div>
				            
				            <div class="clear"></div>
				
							<div id="comments">
								<?php comments_template(); ?>
							</div>
					
						</div>
					</div>
					
					<div class="clear"></div>
					
				</article>			
				
				
			<?php endwhile; // End the loop. Whew. ?>
	
		</div>
			
	</div>
	

<?php  get_footer(); ?>