jQuery(document).ready(function( $ ) {




  /*top bar search input*/
  $("#search_top_input").focus(function(){

      $("#tapbar .contact-info").animate({
        width: '300px',
        height: "30px"
    },500);


    $(this).animate({
      width: '300px',
      height: "30px"
  },500);


  $(this).css({"fontSize":"18px"})

   } );



   
  $("#search_top_input").focusout(function(){

    $("#tapbar .contact-info").animate({
      width: '168'
  
  },500);


  $(this).animate({
    width: '168',
    height: "24px"
},500);


$(this).css({"fontSize":"15px"})

 } );


 $("#search_top_input").keydown(function(){

    //console.log($(this).val() ) ;

 });


  /*top bar search input*/

 
 
 
 
 
 
 
  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });
  $('.back-to-top').click(function(){
    $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
    return false;
  });

  // Stick the header at top on scroll
 $("#header").sticky({topSpacing:0, zIndex: '2050'});
  $(".tabbar").sticky({topSpacing:$("#header-sticky-wrapper").height(), zIndex: '2050'});
  $("#leftSideBar").sticky({topSpacing:$("#header-sticky-wrapper").height(), zIndex: '2050'});

  // Intro background carousel
  $("#intro-carousel").owlCarousel({
    autoplay: true,
    dots: false,
    loop: true,
    animateOut: 'fadeOut',
    items: 1
  });

  // Initiate the wowjs animation library
  new WOW().init();

  // Initiate superfish on nav menu
  $('.nav-menu').superfish({
    animation: {
      opacity: 'show'
    },
    speed: 400
  });

  // Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if( ! $('#header').hasClass('header-fixed') ) {
            top_space = top_space - 20;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });


  // Porfolio - uses the magnific popup jQuery plugin
  $('.portfolio-popup').magnificPopup({
    type: 'image',
    removalDelay: 300,
    mainClass: 'mfp-fade',
    gallery: {
      enabled: true
    },
    zoom: {
      enabled: true,
      duration: 300,
      easing: 'ease-in-out',
      opener: function(openerElement) {
        return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: { 0: { items: 1 }, 768: { items: 2 }, 900: { items: 3 } }
  });

  // Clients carousel (uses the Owl Carousel library)
  $(".clients-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: { 0: { items: 2 }, 768: { items: 4 }, 900: { items: 6 }
    }
  });

  //Google Map
  var get_latitude = $('#google-map').data('latitude');
  var get_longitude = $('#google-map').data('longitude');

  function initialize_google_map() {
    var myLatlng = new google.maps.LatLng(get_latitude, get_longitude);
    var mapOptions = {
      zoom: 14,
      scrollwheel: false,
      center: myLatlng
    };
    var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map
    });
  }
  google.maps.event.addDomListener(window, 'load', initialize_google_map);

});




$(".posts .post .tab_bar .row div").click(function(){


    $(this).addClass("active").siblings().removeClass("active");
});







// upload image in post
$("#fake-uploader").click(function(){

  $('#post-uploader-file').trigger('click');

  //alert("clicked");
});


  // function readURL(input) {
  //     if (input.files && input.files[0]) {
  //         var reader = new FileReader();

  //         reader.onload = function (e) {
  //             // $('#uploaded-image')
  //             //     .attr('src', e.target.result)
  //             //     .width(100)
  //             //     .height(100);

  //             $("#append-images").append("<img src='"+e.target.result+"' class='selected-upload'/>");
  //         };

  //         reader.readAsDataURL(input.files[0]);
  //     }
  // }



  function imagesPreview(input) {


    var URL = window.URL || window.webkitURL;
    var $elm = $("#append-images");
  
    $elm.html("");
    if (input.files) {
      for (i = 0; i < input.files.length; i++) {
        var file = input.files[i];
        var src = URL.createObjectURL(file);
  
        $elm.append("<img src='"+src+"' class='selected-upload-image'/>");
        // $elm.append(
        //   '<div class="frame col-md-3" align="center">' +
        //     '<img src="' + src + '" class="img">' +
        //     '<div style="word-wrap:break-word; margin-top:5px">' + file.name + '</div>' +
        //   '</div>'
        // );
      }
    }
  };
  
  // $('#images').on('change', function(e) {
  //   imagesPreview(this, '.data-image');
  // });

  








$(".post-img").click(function(){
  //alert("ss");
      // $(this).css({
      //     'width':'500px',
      //     'height':'500px'
      // }).siblings().css({
      //   'width':'150px',
      //     'height':'150px'
      // });


      $(this).animate({
        opacity: 1,
        width: "100%",
        height: "500px"
      }, 500).siblings().animate({
        opacity: .6,
        width: "150px",
        height: "150px"
      });


  });
  
  
  
  

  $(".confirm").click(function(){
    return confirm("هل انت متآكد ؟");
  })


  $(".postEditBtn").click(function(){

    var id  =  $(this).attr("data-id"),
        content = $(".postEditBtncontent"+id).text();
      $(".editpostcontent").val(content);
      $("#editpostid").val(id);
  });



  $("#addCommentButton").click(function(){


    
      $(this).fadeOut(1000,function(){
        $("#addcommentForm").fadeIn(1000);

      });
      
  });