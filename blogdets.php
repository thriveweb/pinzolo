<div class="dets_wrap">

	<div class="dets">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>						
		
		<ul>
			<li><span>By</span> <?php the_author(); ?> </li>
			
			<?php if( !has_category('Uncategorized') and has_category()  ) : ?>			
				<li><span>In</span> <?php the_category( ' ' ) ?></li>
			<?php endif; ?>
			
			<li><span>With</span> <a href=" <?php comments_link(); ?> " > <?php comments_number('No Comments', 'One Comment', '% Comments' );?> </a></li>
			
			<?php if( has_tag() ) : ?>
				<li><span>Tagged with</span> <?php echo the_tags('',' ',''); ?></a></li>
			<?php endif; ?>			
			
			<li><span>On</span>	<?php echo get_the_date('j'); ?> <?php echo get_the_date('M'); ?> | '<?php echo get_the_date('Y'); ?> </li>
			<li class="perm"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/permalink.svg" alt="permalink" /></a></li>
							
		</ul>
		
		<?php get_template_part('edit');?>
		
	</div>
	
</div>