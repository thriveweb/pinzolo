<?php

/**
 * Pinzolo Theme Functions
 * 
 * This file contains various functions for setting up and customizing the Pinzolo WordPress theme.
 */

/**
 * Enqueue scripts and styles for the theme
 */
function pinzolo_scripts() {
    wp_enqueue_script('jquery');
    
    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish/dist/js/superfish.js', array('jquery'), time());
    wp_enqueue_script('tinynav', get_template_directory_uri() . '/js/tinynav.js', array('jquery'), time());
    wp_enqueue_script('pinzolo-script', get_template_directory_uri() . '/js/pinzolo.js', array('jquery'), time());
    
    wp_enqueue_style('opensans', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,600,700');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'pinzolo_scripts');

/**
 * Apply custom styles based on theme options
 */
function pinzolo_custom_options() {
    // Determine color scheme and set colors accordingly
    $is_light_theme = get_theme_mod('theme_color_scheme') == "light";
    $link_color = $is_light_theme ? get_option('link_color', '#000') : get_option('dark_link_color', '#fff');
    $link_hover_color = $is_light_theme ? get_option('link_hover_color', '#000') : get_option('dark_link_hover_color', '#fff');
    $body_color = $is_light_theme ? get_option('all_text_color', '#000') : get_option('dark_header_text_color', '#fff');
    $header_color = $is_light_theme ? get_option('head_color', '#000') : get_option('dark_head_color', '#fff');

    $border = get_option('border');

    // Output custom CSS
    echo '<style type="text/css" id="custom-colour-css">';
    // ... (CSS rules here)
    echo '</style>';

    // Add border style if enabled
    if (!$border) {
        echo '<style type="text/css" id="custom-border-css">';
        echo '#wrapper_bg { box-shadow: none; }';
        echo '</style>';
    }
}
add_action('wp_head', 'pinzolo_custom_options');

/**
 * Customize the search form
 */
function pinzolo_search_form($form) {
    $search_value = !empty($s) ? esc_attr($s, 1) : 'search';
    $home_url = esc_url(home_url('/'));

    $form = '<form action="' . $home_url . '" method="get">
             <input id="Searchform" type="text" class="textfield wpcf7-text" name="s" size="24" value="' . $search_value . '" />
             </form>';

    return $form;
}
add_filter('get_search_form', 'pinzolo_search_form');

// Set the content width
if (!isset($content_width)) {
    $content_width = 860;
}

/**
 * Customize theme options in the WordPress Customizer
 */
function pinzolo_customize_register($wp_customize) {
    // Add color settings
    $colors = array(
        array('slug' => 'link_color', 'default' => '#000000', 'label' => 'Link Color'),
        array('slug' => 'link_hover_color', 'default' => '#000000', 'label' => 'Link Hover Color'),
        array('slug' => 'head_color', 'default' => '#000000', 'label' => 'H1, H2, H3 Color'),
        array('slug' => 'all_text_color', 'default' => '#000000', 'label' => 'Text Color')
    );

    foreach ($colors as $color) {
        // Add color settings and controls
        $wp_customize->add_setting($color['slug'], array(
            'default' => $color['default'],
            'type' => 'option',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_hex_color'
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color['slug'], array(
            'label' => $color['label'],
            'section' => 'colors',
            'settings' => $color['slug'],
            'active_callback' => function () use ($color) {
                return get_theme_mod('theme_color_scheme', 'light') == 'light';
            }
        )));
    }

    // Add dark mode color settings
    // ... (Dark mode color settings here)

    // Add header and logo options
    // ... (Header and logo settings here)

    // Add border option
    $wp_customize->add_setting("border", array(
        'default' => true,
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('border', array(
        'label' => 'Show border / shadow?',
        'section' => 'colors',
        'type' => 'checkbox',
    ));

    // Add AJAX navigation options
    // ... (AJAX navigation settings here)

    // Add theme color scheme option
    $wp_customize->add_setting('theme_color_scheme', array(
        'default' => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('theme_color_scheme', array(
        'type' => 'radio',
        'section' => 'colors',
        'label' => __('Select Theme Mode', 'pinzolo'),
        'choices' => array(
            'light' => __('Light', 'pinzolo'),
            'dark' => __('Dark', 'pinzolo'),
        ),
    ));

    // Remove unnecessary controls
    $wp_customize->remove_control('display_header_text');
    $wp_customize->remove_control('header_textcolor');
}
add_action('customize_register', 'pinzolo_customize_register');

/**
 * Set up theme features and support
 */
function pinzolo_setup() {
    // Add various theme supports
    add_theme_support('wp-block-styles');
    add_theme_support("title-tag");
    add_theme_support('automatic-feed-links');
    add_theme_support("responsive-embeds");
    add_theme_support("align-wide");
    add_theme_support('editor-styles');
    add_theme_support('core-block-patterns');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
    
    // Add custom logo support
    add_theme_support("custom-logo", array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    ));

    // Add custom background support
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
        'wp-head-callback' => '_custom_background_cb',
    ));

    // Add custom header support
    add_theme_support('custom-header', array(
        'width' => 1400,
        'height' => 260,
        'flex-width' => true,
        'flex-height' => true,
        'default-text-color' => '000000',
        'default-image' => get_template_directory_uri() . '/header/pinzolo.jpg',
    ));

    // Add post thumbnail support
    add_theme_support('post-thumbnails');
    add_image_size('page_header', 1400, 260, false);
    add_image_size('portfolio', 250, 250, true);
}
add_action('after_setup_theme', 'pinzolo_setup');

// Add editor styles
add_editor_style();

/**
 * Register sidebar
 */
function pinzolo_register_sidebars() {
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'id' => 'Page_Sidebar',
        'before_widget' => '<div class="sidebar_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'pinzolo_register_sidebars');

/**
 * Register custom menu
 */
function register_custom_menu() {
    register_nav_menu('top', 'Top Menu');
}
add_action('after_setup_theme', 'register_custom_menu');

/**
 * Add home link to page menu
 */
function pinzolo_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}
add_filter('wp_page_menu_args', 'pinzolo_page_menu_args');

/**
 * Custom comment display
 */
function pinzolo_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    // Comment display HTML
    // ...
}

/**
 * Initialize AJAX load posts functionality
 */
function pinzolo_pbd_alp_init() {
    global $wp_query;

    if (get_option('ajax') == "_loadmore" && !is_singular()) {
        // Enqueue necessary scripts and localize data for AJAX loading
        // ...
    }
}
add_action('template_redirect', 'pinzolo_pbd_alp_init');

/**
 * Register custom block patterns
 */
function pinzolo_patterns() {
    register_block_pattern(
        'pinzolo-title',
        array(
            'title' => __('Creativetech Title', 'pinzolo'),
            'description' => __('This is Creativetech Pattern', 'pinzolo'),
            'content' => '<h2><center>This is Pinzolo Theme</center></h2>',
            'categories' => array('text', 'pinzolo'),
            'keywords' => array('cta', 'pinzolo'),
            'viewportWidth' => 400,
        )
    );
}
add_action('init', 'pinzolo_patterns');

/**
 * Register custom block styles
 */
if (function_exists('register_block_style')) {
    register_block_style(
        'core/quote',
        array(
            'name' => 'blue-quote',
            'label' => __('Blue Quote', 'pinzolo'),
            'is_default' => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}
