<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6 ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7 ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<?php
	if (preg_match('/thrivex.io/i', $_SERVER['SERVER_NAME']) || preg_match('/project-demo.info/i', $_SERVER['SERVER_NAME'])) : ?>
	    <meta name="robots" content="noindex, nofollow">
	<?php
	    add_filter('wpseo_robots', '__return_false');
	endif; ?>  
	<?php wp_head(); //leave for plugins ?>

</head>

<body <?php body_class(body_class(get_theme_mod('theme_color_scheme', 'light'))); ?>>
	<?php wp_body_open(); ?>

	<div id="wrapper_border" class="site-main">

		<!--logo-->
		<div class="center">
			<div id="logoContainer">
				<?php 
				$footer_logo = get_option('logo');
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$darklogo = get_option( 'darklogo' );

				if (!$custom_logo_id && !$darklogo) : ?>

					<h1><a href="<?php echo esc_url(home_url('/')); ?>"> <?php echo get_option('header_text', 'Pinzolo'); ?></a></h1>
					<p><?php echo get_option('sub_header_text', 'Edit me in the Theme Customizer'); ?></p>

				<?php else : 
					if (get_theme_mod('theme_color_scheme') == 'light') {
						the_custom_logo(); 
					} else {
					    echo '<a href="'.esc_url(home_url('/')).'" class="dark-logo-link" rel="home"><img src="'.$darklogo.'" class="dark-logo" alt="'.sanitize_text_field(get_bloginfo('name')).'" ></a>';
					}

					if( !empty($footer_logo)){ ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url($footer_logo) ?>" alt="<?php bloginfo('name'); ?> " class="mobilecustom-logo"/>
						</a>
					<?php }
				endif ?>

			</div>
		</div>

		<div id="wrapper_bg">

			<div id="navwrap">
				
				<div id="navwrap2">
					<a href="javascript:;" class="toggalnav">
						<img class="menuopen" src="<?php echo esc_url(get_template_directory_uri() . '/images/menu-icon.svg'); ?>" alt="menu-icon">
						<img class="menuclose" src="<?php echo esc_url(get_template_directory_uri() . '/images/menu-icon-close.svg'); ?>" alt="menu-icon">
					</a>
					<nav>
						<?php wp_nav_menu(array('theme_location' => 'top', 'container' => 0, 'menu_id' => 'menuUl', 'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="tnskip" >&nbsp;</li>%3$s<li class="tnskip">&nbsp;</li><li class="tnskip filler"></li></ul>')); ?>

						<div class="mobile_menu_details">
							<div class="footer_col">
								<p class="social_title_header">SOCIAL</p>
								<?php my_social_media_icons(); ?>
							</div>

							<div class="footer_col">
								<p> &copy; <?php echo date('Y'); ?> Pinzolo Theme</p>
								<p> Made on the Gold Coast by <a href="https://thriveweb.com.au/" target="_blank">THRIVE</a></p>
								<p class="powered_by"> Powered by <a href="http://wordpress.org/" title="WordPress">WordPress</a></p>
							</div>
							
						</div>
					</nav>

				</div>

			</div>

			<?php

			if (is_singular() && has_post_thumbnail($post->ID)) :

				$image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				$image = $image_array[0];

			else :

				$image = get_header_image();

			endif;
			?>

			<?php if ($image && !is_page_template('page-gallery.php')) : ?>
				<header>
					<img class="size-full" src="<?php echo $image; ?>" alt="" />
				</header>
			<?php endif; ?>