jQuery(document).ready(function(){
  var $document = jQuery(document),
      $element = jQuery('.green-box'),
      className = 'hasScrolled';

  $document.scroll(function() {
      if ($document.scrollTop() >= 40) {
          $element.addClass(className);
          // $('.hasScrolled').attr({'data-aos':'fade-up', 'data-aos-anchor-placement':"top-center"});
      } 
      else {
          $element.removeClass(className);
      }
  });
  jQuery('.open-search-term').click(function(){
    jQuery(this).parent().find('.textwidget').slideToggle();
    jQuery(this).parent().toggleClass('rotate-span');
  })
  jQuery('.grade-click').click(function(){
    jQuery('.grade-popup').slideToggle(0);
  })
    jQuery('.slide-images').slick({
        dots: false,
        arrows: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        speed: 800,
        slidesToShow: 1,
        nextArrow: '.next_slick',
        prevArrow: '.previous_slick'
    });
      // check to see if there are one or less slides
      if (!(jQuery('.slide-images .slick-slide').length > 1)) {
          jQuery('.slide-images .prev-next').hide();
      }
      jQuery('.product-holder').each(function (index, sliderWrap) {
          var $slider = jQuery(sliderWrap).find('.product-slider');
          var $next = jQuery(sliderWrap).find('.next_product');
          var $prev = jQuery(sliderWrap).find('.previous_product');
          $slider.slick({
              dots: false,
              arrows: true,
              infinite: true,
              autoplay: false,
              autoplaySpeed: 6000,
              speed: 800,
              slidesToShow: 5,
              nextArrow: $next,
              prevArrow: $prev,
              responsive: [
              {
                breakpoint: 1100,
                settings: {
                  slidesToShow: 4
                }
              },
                {
                  breakpoint: 981,
                  settings: {
                    slidesToShow: 3
                  }
                },

                // {
                //   breakpoint: 768,
                //   settings: {
                //     slidesToShow: 3
                //   }
                // },

                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2
                  }
                },

                // {
                //   breakpoint: 440,
                //   settings: {
                //     slidesToShow: 2
                //   }
                // }

              ]
          });
        });
        // check to see if there are one or less slides
        if (!(jQuery('.product-slider .slick-slide').length > 1)) {
            jQuery('.product-slider .prev-next-products').hide();
        }
        if (jQuery('body').hasClass('single-product')) {
          jQuery('.single-product-slider').slick({
              dots: true,
              arrows: true,
              infinite: true,
              autoplay: false,
              autoplaySpeed: 6000,
              speed: 800,
              slidesToShow: 1,
              nextArrow: '.next_slick',
              prevArrow: '.previous_slick'
          });
            // check to see if there are one or less slides
            if (!(jQuery('.single-product-slider .slick-slide').length > 1)) {
                jQuery('.single-product-slider .prev-next').hide();
                jQuery('.slick-dots').hide();

            }
        }
        
})