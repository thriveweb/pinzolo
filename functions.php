<?php

///////////////////////////////////////////////////////
// Header stuffs
function pinzolo_scripts() {
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('superfish', 		get_template_directory_uri() . '/js/superfish/dist/js/superfish.js',array('jquery'),time());
	// wp_enqueue_script('formalize', 		get_template_directory_uri() . '/js/jquery.formalize.min.js',array('jquery'),time());
	wp_enqueue_script('tinynav', 	 	get_template_directory_uri() . '/js/tinynav.js',array('jquery'),time());
	wp_enqueue_script('pinzolo-script', get_template_directory_uri() . '/js/pinzolo.js',array('jquery'),time());
	
	wp_enqueue_style('opensans', 	 	'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,600,700');
	wp_enqueue_style('font-awesome', 	get_template_directory_uri() . '/css/font-awesome.min.css');


}
add_action( 'wp_enqueue_scripts', 'pinzolo_scripts' );


// Styles from customizer
function pinzolo_custom_options() {
	if( get_theme_mod('theme_color_scheme') == "light"){
		$link_color = get_option('link_color', '#000');
		$link_hover_color = get_option('link_hover_color', '#000');
		$body_color = get_option('all_text_color', '#000');
		$header_color = get_option('head_color', '#000');
	}else{
		$link_color = get_option('dark_link_color', '#fff');
		$link_hover_color = get_option('dark_link_hover_color', '#fff');
		$body_color = get_option('dark_header_text_color', '#fff');
		$header_color = get_option('dark_head_color', '#fff');
	}
	$border = get_option('border');
	$ajax = get_option('ajax');

	echo'
	<style type="text/css" id="custom-colour-css">
		.dets ul a, .dets p a, .content a, a { color:  '. $link_color .'; }

		#logoContainer h1, #logoContainer h1 a, #logoContainer h1 a:hover,#logoContainer p, p, .dets li, .footer_left p, .footer_left a,
		ul li, ol li, dl dt, dl dd, p a, .wp-block-latest-comments, .wp-block-pullquote p, .wp-block-code, pre, body.dark table td, 
		.wp-block-image figcaption{ color:'. $body_color .';  }

		p a:hover, a:hover, .dets ul a:hover, article .dets h2 a:hover,.page-numbers:hover, .dets ul a:hover, .dets p a:hover, .content a:hover{
			color:'. $link_hover_color .';
			text-decoration:underline;
		}
		
		article .dets h2 a, h1, h2, h3, h4, h5, h6{ color:  '. $header_color .' ;  }
		body.dark {
		    background: #000 !important;
		}
	</style>
	';

	if( !$border ) :
		echo'
		<style type="text/css" id="custom-colour-css">
		#wrapper_bg{
		-webkit-box-shadow: 0px 0px 0px black;
		-moz-box-shadow: 0px 0px 0px black;
		box-shadow: 0px 0px 0px black;
	}
	</style>
	';
endif;
}
add_action('wp_head', 'pinzolo_custom_options');


if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

// add ie conditional html5 shim to header
// function add_ie_html5_shim () {
// 	global $is_IE;
// 	if ($is_IE){
//    		echo '	<!--[if lt IE 9]>
//     				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
// 				<![endif]-->';
//     }
// }
// add_action('wp_head', 'add_ie_html5_shim');


///////////////////////////////////////////////////////
function pinzolo_search_form( $form ) {

	if(!empty($s)) $svalue =  esc_attr($s, 1);
	else $svalue = 'search';

	$home = esc_url( home_url( '/' ) );

	$form = '<form action="'. $home .'" method="get">
	<input id="Searchform" type="text" class="textfield wpcf7-text" name="s" size="24" value="' . $svalue . '" />
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'pinzolo_search_form' );



///////////////////////////////////////////////////////
// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 860;


///////////////////////////////////////////////////////
// Add more colour selectors
// https://codex.wordpress.org/Theme_Customization_API
add_action( 'customize_register', 'pinzolo_customize_register' );
function pinzolo_customize_register($wp_customize){

	
	$colors = array();
	$colors[] = array( 'slug'=>'link_color', 'default' => '#000000', 'label' => 'Link Color' );
	$colors[] = array( 'slug'=>'link_hover_color', 'default' => '#000000', 'label' => 'Link Hover Color' );
	$colors[] = array( 'slug'=>'head_color', 'default' => '#000000', 'label' => 'H1, H2, H3 Color' );
	$colors[] = array( 'slug'=>'all_text_color', 'default' => '#000000', 'label' => 'Text Color' );

	foreach($colors as $color)
	{
    	// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' , 'sanitize_callback' => 'sanitize_hex_color'));

    	// CONTROLS
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array(
            'label' => $color['label'],
            'section' => 'colors',
            'settings' => $color['slug'],
            'active_callback' => function () use ($color) {
                return get_theme_mod('theme_color_scheme', 'light') == 'light';
            }
        )));
	}

	// Add dark versions of Link Color 
    $wp_customize->add_setting('dark_link_color', array(
        'default' => '#fff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_link_color', array(
        'label' => __('Link Color', 'pinzolo'),
        'section' => 'colors',
        'settings' => 'dark_link_color',
        'active_callback' => function () {
            return get_theme_mod('theme_color_scheme', 'light') == 'dark';
        }
    )));

    // Add dark versions of Link Hover Color 
    $wp_customize->add_setting('dark_link_hover_color', array(
        'default' => '#fff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_link_hover_color', array(
        'label' => __('Link Hover Color', 'pinzolo'),
        'section' => 'colors',
        'settings' => 'dark_link_hover_color',
        'active_callback' => function () {
            return get_theme_mod('theme_color_scheme', 'light') == 'dark';
        }
    )));

	// Add dark versions of H1, H2, H3 Color
	$wp_customize->add_setting('dark_head_color', array(
        'default' => '#fff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_head_color', array(
        'label' => __('H1, H2, H3, H4 Color', 'pinzolo'),
        'section' => 'colors',
        'settings' => 'dark_head_color',
        'active_callback' => function () {
            return get_theme_mod('theme_color_scheme', 'light') == 'dark';
        }
    )));

    // Add dark text color setting
    $wp_customize->add_setting('dark_header_text_color', array(
        'default' => '#fff',
        'type' => 'option',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_header_text_color', array(
        'label' => __('Paragraph Color', 'pinzolo'),
        'section' => 'colors',
        'settings' => 'dark_header_text_color',
        'active_callback' => function () {
            return get_theme_mod('theme_color_scheme', 'light') == 'dark';
        }
    )));

	// Add Header Text
	$wp_customize->add_setting( 'header_text', array(
		'default'    => 'pinzolo',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'header_text', array(
		'label'      => 'Header Text',
		'section'    => 'title_tagline',
	) );


	// Add Sub Header Text
	$wp_customize->add_setting( 'sub_header_text', array(
		'default'    => 'Edit me in the Theme Customizer',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'sub_header_text', array(
		'label'      => 'Sub Header Text',
		'section'    => 'title_tagline',
	) );


	// Add logo option
	$wp_customize->add_setting( "logo", array(
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url'
	) );
	$wp_customize->add_control(  new WP_Customize_Image_Control($wp_customize, 'logo', array(
		'label'    =>  'Upload a footer logo',
		'section'  => 'title_tagline',
	) ) );

	// Add logo option
	$wp_customize->add_setting( "darklogo", array(
		'type'       => 'option',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url'
	) );

	$wp_customize->add_control(  new WP_Customize_Image_Control($wp_customize, 'darklogo', array(
		'label'    =>  'Upload a dark theme logo',
		'section'  => 'title_tagline',
		// 'settings'   => 'dark_logo',
	) ) );


	// Add border option
	$wp_customize->add_setting( "border", array(
		'default'    => true,
		'capability' => 'edit_theme_options',
		'type'       => 'option',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'border', array(
		'label'    =>  'Show border / shadow?',
		'section'  => 'colors',
		'type'       => 'checkbox',
	) );

	// Add AJAX load option
$wp_customize->add_section('ajax_navigation', array(
    'title' => 'Ajax Navigation'
));

$wp_customize->add_setting("ajax", array(
    'default'           => '_loadmore',
    'type'              => 'option',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('ajax', array(
    'label'   => 'Enable AJAX loading',
    'section' => 'ajax_navigation',
    'type'    => 'radio',
    'choices' => array(
            '_loadmore' => __('Load More', 'pinzolo'),
            '_pagination'  => __('Pagination', 'pinzolo'),
        ),
));

/*$wp_customize->add_setting("pagination", array(
    'default'           => true,
    'type'              => 'option',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('pagination', array(
    'label'   => 'Enable Pagination',
    'section' => 'ajax_navigationgation',
    'type'    => 'checkbox', // Changed to checkbox for enabling/disabling
));*/


	// Remove "Display Site Title and Tagline" checkbox
	$wp_customize->remove_control('display_header_text');

	// Added light and Dark Mode option
    $wp_customize->add_setting('theme_color_scheme', array(
        'default'           => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('theme_color_scheme', array(
        'type'    => 'radio',
        'section' => 'colors',
        'label'   => __('Select Theme Mode', 'pinzolo'),
        'choices' => array(
            'light' => __('Light', 'pinzolo'),
            'dark'  => __('Dark', 'pinzolo'),
        ),
    ));

    
 
    $wp_customize->remove_control('header_textcolor');

}

///////////////////////////////////////////////////////
// Tell WordPress to run pinzolo_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'pinzolo_setup' );
function pinzolo_setup(){

	add_theme_support('wp-block-styles');
	add_theme_support( "title-tag" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "align-wide" );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'core-block-patterns' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) ); 
	add_theme_support( "custom-logo", array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	) );


	$args = array(
        'default-color' => 'ffffff', 
        'default-image' => '', 
        'wp-head-callback' => '_custom_background_cb', 
    );
    add_theme_support('custom-background', $args);

    	// Add support for custom headers.
	$args = array(
		'width'         => 1400,
		'height'        => 260,
		'flex-width'    => true,
		'flex-height'    => true,
		'default-text-color' => '000000',
		'default-image' => get_template_directory_uri() . '/header/pinzolo.jpg',
	);
	add_theme_support( 'custom-header', $args );

	///////////////////////////////////////////////////////
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'page_header', 1400, 260, false );
	add_image_size( 'portfolio', 250, 250, true );
}

add_editor_style();
the_post_thumbnail();

///////////////////////////////////////////////////////
// Registers a dynamic sidebar.
add_action( 'widgets_init', 'pinzolo_register_sidebars' );
function pinzolo_register_sidebars(){

	register_sidebar(array('name'=>'Page Sidebar',
		'id' => 'Page_Sidebar',
		'before_widget' => '<div class="sidebar_widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}

///////////////////////////////////////////////////////
// Custom menu
add_action('after_setup_theme', 'register_custom_menu');
function register_custom_menu() {
	register_nav_menu('top', 'Top Menu');
}

//to show a home link
function pinzolo_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'pinzolo_page_menu_args' );


///////////////////////////////////////////////////////
// Search only posts
function pinzolo_SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
//add_filter('pre_get_posts','pinzolo_SearchFilter');


///////////////////////////////////////////////////////
// Social links
function my_customizer_social_media_array() {

	/* store social site names in array */
	$social_sites = array( 'Facebook', 'Linkedin', 'X', 'Flickr', 'Pinterest', 'Youtube', 'Tumblr', 'Dribbble', 'RSS', 'Instagram', 'Email');

	return $social_sites;
}

/* add settings to create various social media text areas. */
add_action('customize_register', 'my_add_social_sites_customizer');

function my_add_social_sites_customizer($wp_customize) {

	$wp_customize->add_section( 'my_social_settings', array(
		'title'    => __('Social Media Icons', 'pinzolo'),
		'priority' => 35,
	) );

	$social_sites = my_customizer_social_media_array();
	$priority = 5;

	foreach($social_sites as $social_site) {

		$wp_customize->add_setting( "$social_site", array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );

		$wp_customize->add_control( $social_site, array(
			'label'    => $social_site." url:",
			'section'  => 'my_social_settings',
			'type'     => 'text',
			'priority' => $priority,
		) );

		$priority = $priority + 5;
	}
}


/* takes user input from the customizer and outputs linked social media icons */
function my_social_media_icons() {

	$social_sites = my_customizer_social_media_array();

	/* any inputs that aren't empty are stored in $active_sites array */
	foreach($social_sites as $social_site) {
		if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
			$active_sites[] = $social_site;
		}
	}

	/* for each active social site, add it as a list item */
	if ( ! empty( $active_sites ) ) {

		echo "<ul class='social-media-icons'>";

		foreach ( $active_sites as $active_site ) {

			/* setup the class */
			$class = 'fa fa-' . $active_site;

			if ( $active_site == 'Email' ) {
				?>
				<li>
					<a class="email" target="_blank" href="mailto:<?php echo antispambot( is_email( get_theme_mod( $active_site ) ) ); ?>">
						Email
					</a>
				</li>
			<?php } else { ?>
				<li>
					<a class="<?php echo $active_site; ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $active_site) ); ?>">
						<?php echo $active_site;?>
					</a>
				</li>
				<?php
			}
		}
		echo "</ul>";
	}
}


///////////////////////////////////////////////////////
// Custom comments
function pinzolo_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div id="comment-<?php comment_ID(); ?>">

			<p class="author">
				<?php echo get_avatar($comment,$size='30' ); ?>
				<?php printf('%s', get_comment_author_link()) ?>
			</p>

			<p class="time"><?php printf('%1$s at %2$s', get_comment_date(),  get_comment_time()) ?> | <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>

			<div class="clear"></div>

			<?php comment_text() ?>

			<?php if ($comment->comment_approved == '0') : ?>
				<em>Your comment is awaiting moderation</em>
			<?php endif; ?>

		</div>
		<?php
	}
//Note the lack of a trailing </li>. WordPress will add it itself once it's done listing any children and whatnot.



///////////////////////////////////////////////////////
/**
* Plugin Name: PBD AJAX Load Posts
* Plugin URI: http://www.problogdesign.com/
* Description: Load the next page of posts with AJAX.
* Version: 0.1
* Author: Pro Blog Design
* Author URI: http://www.problogdesign.com/
*/

/**
* Initialization. Add our script if needed on this page.
*/
function pinzolo_pbd_alp_init() {
	global $wp_query;

	if( get_option('ajax') == "_loadmore" ) {

		// Add code to index pages.
		if( !is_singular() ) {
			// Queue JS and CSS
			wp_enqueue_script(
				'pbd-alp-load-posts',
				get_template_directory_uri('template_url') . '/js/load-posts.js',
				array('jquery'),
				'1.0',
				true
			);

			// What page are we on? And what is the pages limit?
			$max = $wp_query->max_num_pages;
			$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

			// Add some parameters for the JS.
			wp_localize_script(
				'pbd-alp-load-posts',
				'pbd_alp',
				array(
					'startPage' => $paged,
					'maxPages' => $max,
					'nextLink' => next_posts($max, false)
				)
			);
		}
	}
	if( get_option('ajax') == "_pagination" ) {

	}
}
add_action('template_redirect', 'pinzolo_pbd_alp_init');

add_action( 'init', 'pinzolo_patterns' );
function pinzolo_patterns() {
	/* Register Pattern */
	register_block_pattern(
		'pinzolo-title',
		array(
			'title'         => __( 'Creativetech Title', 'pinzolo' ),
			'description'   => __( 'This is Creativetech Pattern', 'pinzolo' ),
			'content'       => '<h2><center>This is Pinzolo Theme</center></h2>',
			'categories'    => array( 'text', 'pinzolo' ),
			'keywords'      => array( 'cta', 'pinzolo'),
			'viewportWidth' => 400,
		)
	);
}

if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __( 'Blue Quote', 'pinzolo' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}




