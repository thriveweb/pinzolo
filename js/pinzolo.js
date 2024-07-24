jQuery(document).ready(function($) {
					
	
	jQuery('<span class="sf-sub-indicator"></span>').appendTo('.menu-item-has-children > a');
	
	//clear search on click
	defaultValue = jQuery('#Searchform').val();  
	jQuery('#Searchform').click(function() {
		if( this.value == defaultValue ) {
			jQuery(this).val("");
		}
	});
	
    
	jQuery('html').addClass('js');
	

	jQuery(window).scroll(function() {
	    var scroll = jQuery(window).scrollTop();

	    if (scroll > 0) {
	    	jQuery('#navwrap').addClass('scrolled');
	    } else {
	    	jQuery('#navwrap').removeClass('scrolled');
	    }
	});

	jQuery(".toggalnav").click(function(){
        jQuery("body").toggleClass("show_menu");
  });

    // Initialize TinyNav for responsive menu
    $('#menuUl').tinyNav();

    // Add 'js' class to HTML element
    $('html').addClass('js');

		//jQuery('nav ul').superfish(); 

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
