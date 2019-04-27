$( document ).ready(function() {

  (function ($) {
    'use strict';

    var browserWindow = $(window);

    // :: 1.0 Preloader Active Code
    browserWindow.on('load', function () {
        $('.preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
  })(jQuery);

  $('.marquee').marquee({

  //If you wish to always animate using jQuery
  allowCss3Support: true,

  //works when allowCss3Support is set to true - for full list see http://www.w3.org/TR/2013/WD-css3-transitions-20131119/#transition-timing-function
  css3easing: 'linear',

  //requires jQuery easing plugin. Default is 'linear'
  easing: 'linear',

  //pause time before the next animation turn in milliseconds
  delayBeforeStart: 10,
  //'left', 'right', 'up' or 'down'
  direction: 'left',

  //true or false - should the marquee be duplicated to show an effect of continues flow
  duplicated: false,

  //speed in milliseconds of the marquee in milliseconds
  duration: 9000,

  //gap in pixels between the tickers
  gap: 20,

  //on cycle pause the marquee
  pauseOnCycle: false,

  //on hover pause the marquee - using jQuery plugin https://github.com/tobia/Pause
  pauseOnHover: false,

  //the marquee is visible initially positioned next to the border towards it will be moving
  startVisible: false
  
  });
});



var aniSpd01 = 7000;
var fadeSpd01 = 1000;

$(function () {
  
  var isChrome = !!window.chrome && !!window.chrome.webstore;
  if(isChrome){
    $('.carousel.slide').css({"height":"440px"});
  }

  var startIndex = 0;
  var endIndex = $('#aniHolder div').length;
  $('#aniHolder div:first').fadeIn(fadeSpd01);

  window.setInterval(function() {
      $('#aniHolder div:eq(' + startIndex + ')').fadeOut(fadeSpd01);
      startIndex++;
      if (endIndex == startIndex) startIndex = 0;
      $('#aniHolder div:eq(' + startIndex + ')').delay(fadeSpd01).fadeIn(fadeSpd01);
  }, aniSpd01);

});

$(window).scroll(function(e){
    var wb = window.innerWidth;
    
  	if($(this).scrollTop() > 280){
      if(wb > 991){
  		  $(".treeview.dropdown").removeClass("open");
        $(".head-bottom-fixed").addClass("out");
      }
  	}else{
  		$(".head-bottom-fixed").removeClass("out");
  	}
    
});


var owl = $('.owl-carousel');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
});

$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})

