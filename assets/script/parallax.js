function Parallax() {
	scrollPos = $(this).scrollTop();
  bgPos = $('.bg').scrollTop();
  if (scrollPos>=bgPos) {
    $('.bg, .top .wrapper').css({"transform":"translateY("+((scrollPos-bgPos)/2).toFixed(0)+"px)"});
    // $('.top .wrapper').css({"opacity":1-((scrollPos-bgPos)/360).toFixed(2)});
  }console.log('Parallax');
}
$(document).ready(function(){Parallax();$(window).scroll(function(){Parallax();});$(window).resize(function(){Parallax();});});
