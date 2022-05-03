jQuery(document).ready(function($){
	if ($('.topmenu-label-first input').is(':checked')) {
		$('.topmenu-label-first').addClass('topmenu-checked');
	}
	if ($('.topmenu-label-second input').is(':checked')) {
		$('.topmenu-label-second').addClass('topmenu-checked');
	}
	$(".carousel").swipe({
	        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
	            if (direction == 'left') jQuery(this).carousel('next');
	            if (direction == 'right') jQuery(this).carousel('prev');
	        },
	        allowPageScroll: "vertical"
	    });
	// $('.filter-button').click(function(){
	// 	$('.filter-button').toggleClass('show-span');
	// 	$('.filter-shop').slideToggle();
	// })

	$(".search-icon").click(function() {
		setTimeout(function(){
			$('.dgwt-wcas-search-input').focus();
		}, 500);
		//$('#dgwt-wcas-search-input-22ad').focus();
	});

	$(window).scroll(function(){
		var height = $(this).scrollTop();
		if(height > 50 ){
			//$('div#page').css('margin-top', '0px');
		} else {
			//$('div#page').css('margin-top', '50px');
		}
	});
	$('#organisationsnummer_field').insertAfter($('#billing_country_field'));
	$('label[for="mailchimp_woocommerce_newsletter"]').text('Prenumerera på vårat nyhetsbrev');
	$(".mobile_menu").simpleMobileMenu({
	    //Hamburger Id
	    "hamburgerId" : "sm_menu_ham",
	    //Menu Wrapper Class
	    "wrapperClass" : "sm_menu_outer",
	    //Submenu Class
	    "submenuClass" : "submenu",
	    //Menu Style
	    "menuStyle" : "slide",
	    // Callback - Menu loaded
	    "onMenuLoad" : function(menu) {
	     },
	     //Callback - menu toggle(open/close)
	     "onMenuToggle" : function(menu,open) {
	      }
	   });

	   $('.mobile-child').click(function(){
		   $('#sm_menu_ham').trigger('click');
	   });



	   $("#opensidecart").click(function(e) {
		e.preventDefault();

		$('#cartmenu').addClass("is-open");
		$('body').addClass("cart-menu-open");
	  });

	  $("#closeCartMenu").click(function() {
		$('#cartmenu').removeClass("is-open");
		$('body').removeClass("cart-menu-open");
	  });

	  $('.trigger-search').click(function(){
		 $('.search-field-mobile').show();
		 $('.search-field-mobile').focus();
	  });
	   $('input.os-e').attr("placeholder", "Type your answer here");

	   $('input[name=tax_toggle]').change(function() {

		    var val = this.value;

				$.ajax({
		          	type: "POST",
		            data : { type_of_user: val},
		            cache: false,
		            url: "/wp-content/themes/reuseit/tax_class.php",
		            success: function(data){
		                window.location = window.location.href.split("?")[0];
		            }
		        });
		});

});
