<?php
	// Do not delete these lines	
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
	
	<div class="clear"></div>

	<ul class="commentlist">
		<?php wp_list_comments('callback=pinzolo_comment'); ?>
	</ul>
	
	<?php if(get_comments_number() > get_option('comments_per_page')) : ?>
	
		<div class="navigation comments">
			<?php paginate_comments_links(); ?> 
		</div>
		<div class="clear"></div>
	
	<?php endif; ?>
	
<?php endif; ?>


<?php if ( comments_open() ) : ?>
	
	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>
