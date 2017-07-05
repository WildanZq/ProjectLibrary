function Parallax() {
	scrollPos = $(this).scrollTop();
  bgPos = $('.bg').scrollTop();
  if (scrollPos>=bgPos) {
    $('.bg, .top .wrapper').css({"transform":"translateY("+((scrollPos-bgPos)/2)+"px)"});
    $('.top .wrapper').css({"opacity":1-((scrollPos-bgPos)/360)});
  }
}
$(document).ready(function(){Parallax();$(window).scroll(function(){Parallax();});$(window).resize(function(){Parallax();});});
$(document).load(function(){Parallax();$(window).scroll(function(){Parallax();});$(window).resize(function(){Parallax();});});
