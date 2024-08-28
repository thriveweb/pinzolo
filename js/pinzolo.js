jQuery(document).ready(function($) {

    // Clear search field on click if it contains the default value
    var defaultValue = jQuery('#Searchform').val();
    jQuery('#Searchform').click(function() {
        if (this.value === defaultValue) {
            jQuery(this).val("");
        }
    });

    // Add 'js' class to HTML tag
    jQuery('html').addClass('js');

    // Toggle 'scrolled' class based on scroll position
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        jQuery('#navwrap').toggleClass('scrolled', scroll > 0);
    });

    // Toggle menu visibility on click
    jQuery(".toggalnav").click(function() {
        jQuery("body").toggleClass("show_menu");
    });

    handle_sub_menu();
});

jQuery(window).resize(function() {
    handle_sub_menu();
});

function handle_sub_menu() {
    if (jQuery(window).width() < 600) {
        // Hide default sub-indicator and add mobile-specific indicator
        jQuery('.sf-sub-indicator').remove();
        
        jQuery('<span class="sf-sub-indicator"></span>').insertAfter("nav li.menu-item-has-children > a");

        // Toggle sub-menu visibility on mobile
        jQuery(".sf-sub-indicator").click(function(e) {
            e.preventDefault();
            jQuery(this).parents('.menu-item-has-children').find('.sub-menu').toggleClass("open");
            jQuery(this).toggleClass("btn-open");
        });
    } else {
        jQuery('.sf-sub-indicator').remove();
        jQuery('<span class="sf-sub-indicator"></span>').appendTo('nav .menu-item-has-children > a');
    }
}