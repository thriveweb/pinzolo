jQuery(document).ready(function($) {
    // Add dropdown indicator to menu items with children
    $('.menu-item-has-children > a').append('<span class="sf-sub-indicator"></span>');

    // Clear search input on click
    var defaultSearchValue = $('#Searchform').val();
    $('#Searchform').click(function() {
        if (this.value === defaultSearchValue) {
            $(this).val('');
        }
    });

    // Initialize TinyNav for responsive menu
    $('#menuUl').tinyNav();

    // Add 'js' class to HTML element
    $('html').addClass('js');

    // Add 'scrolled' class to navigation when scrolling
    $(window).scroll(function() {
        $('#navwrap').toggleClass('scrolled', $(window).scrollTop() > 0);
    });

    // Toggle menu on mobile
    $('.toggalnav').click(function() {
        $('body').toggleClass('show_menu');
    });

    // Mobile-specific menu interactions
    if ($(window).width() < 600) {
        $('.sf-sub-indicator').hide();
        $('nav li.menu-item-has-children > a').after('<span class="sf-sub-indicator_mobile"></span>');
        
        $('.sf-sub-indicator_mobile').click(function(e) {
            e.preventDefault();
            $(this)
                .parents('.menu-item-has-children')
                .find('.sub-menu')
                .toggleClass('open');
            $(this).toggleClass('btn-open');
        });
    } else {
        // Initialize Superfish menu for desktop
        $('nav ul').superfish();
    }
});
