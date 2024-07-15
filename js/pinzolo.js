jQuery(document).ready(function($) {
								
	
	jQuery('<span class="sf-sub-indicator"></span>').appendTo('.menu-item-has-children > a');
	
	//clear search on click
	defaultValue = jQuery('#Searchform').val();  
	jQuery('#Searchform').click(function() {
		if( this.value == defaultValue ) {
			jQuery(this).val("");
		}
	});
	
	//tinyNav
    jQuery('#menuUl').tinyNav();
    
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

	if(jQuery(window).width() < 600){

		jQuery('.sf-sub-indicator').hide();
		jQuery('<span class="sf-sub-indicator_mobile"></span>').insertAfter("nav li.menu-item-has-children > a");
	    jQuery(".sf-sub-indicator_mobile").click(function(e){
	        e.preventDefault();
	        jQuery(this).parents('.menu-item-has-children').find('.sub-menu').toggleClass("open");
	        jQuery(this).toggleClass("btn-open");
	    });
	}else{

		jQuery('nav ul').superfish(); 

	}
    

});