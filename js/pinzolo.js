jQuery(document).ready(function($) {

    // Add sub-indicator to menu items with children
    $('<span class="sf-sub-indicator"></span>').appendTo('.menu-item-has-children > a');

    // Clear search field on click if it contains the default value
    var defaultValue = $('#Searchform').val();
    $('#Searchform').click(function() {
        if (this.value === defaultValue) {
            $(this).val("");
        }
    });

    // Add 'js' class to HTML tag
    $('html').addClass('js');

    // Toggle 'scrolled' class based on scroll position
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        $('#navwrap').toggleClass('scrolled', scroll > 0);
    });

    // Toggle menu visibility on click
    $(".toggalnav").click(function() {
        $("body").toggleClass("show_menu");
    });

    if ($(window).width() < 600) {
        // Hide default sub-indicator and add mobile-specific indicator
        $('.sf-sub-indicator').hide();
        $('<span class="sf-sub-indicator_mobile"></span>').insertAfter("nav li.menu-item-has-children > a");

        // Toggle sub-menu visibility on mobile
        $(".sf-sub-indicator_mobile").click(function(e) {
            e.preventDefault();
            $(this).parents('.menu-item-has-children').find('.sub-menu').toggleClass("open");
            $(this).toggleClass("btn-open");
        });
    }
});
