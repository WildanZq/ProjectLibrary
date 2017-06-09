function adaptHeader() {
  if($(document).scrollTop() <= 100) {
      $('.header').css({
          "background": "none", "box-shadow": "none"
      });
//            $('.header *').css({
//                "color": "white"
//            });
      $('.header img').css({
          "transform": "translateY(-100%)"
      });
//            spanAfter.innerHTML = spanAfter.innerHTML.replace(spanAfter.innerHTML.substr(20, 19), "border-color: white");
  } else {
      $('.header').css({
          "background-color": "#d2232a","box-shadow": "0 0 10px black"
      });
//            $('.header *').css({
//                "color": "black"
//            });
      $('.header img').css({
          "transform": "translateY(0)"
      });
//            $('.header span').css({
//                "color": "rgba(0, 0, 0, 0.8)"
//            });
//            spanAfter.innerHTML = spanAfter.innerHTML.replace(spanAfter.innerHTML.substr(20, 19), "border-color: black");
  }
}
$(document).ready(function(){
//    var spanAfter = document.createElement("style");
//    spanAfter.innerHTML = ".header span:after {border-color: white}";
//    document.head.appendChild(spanAfter);
    adaptHeader();
    $(window).scroll(function() {
        adaptHeader();
    });
    //Slide scroll effect
    $("a").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top - 70
            }, 800, function(){
                window.location.hash = hash;
            });
        }
    });
});
