function adaptHeader() {
  if($(document).scrollTop() <= 100) {
      $('.header img').css({
          "transform": "translateY(-100%)"
      });
  } else {
    $('.header img').css({
        "transform": "translateY(0)"
    });
  }
      var op = $(document).scrollTop()/125;
      $('.header').css({
          "background-color": "rgba(210, 35, 42, "+op+")","box-shadow": "0 0 10px rgba(0,0,0,"+op+")"
      });
}
$(document).ready(function(){
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
