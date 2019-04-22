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