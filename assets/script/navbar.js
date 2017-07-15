function showP() {
    $(".dropdown-wrapper").css({height: "82px"});
}
function closeP() {
    $(".dropdown-wrapper").css({height: "0"});
}
var tab = 0;
function tab1() {
    $(".login-wrapper .login").css({
        "max-width":"400px",
        "max-height":"290px",
        "overflow-y":"hidden"
    });
    $(".form-wrapper").css({
        "transform":"translateY(0)"
    });
    $(".login-tab .s2").css({
        "display":"none"
    });
    $(".login-tab .s1").css({
        "display":"block"
    });
    $(".login-tab i").css({
        "transform":"rotate(0deg)"
    });
    if (tab == 1) {
        tab--;
    }
}
$(".login-tab").on('click', function() {
    if (tab == 0) {
        $(".login-wrapper .login").css({
            "max-width":"650px",
            "max-height":"360px"
        });
        if($(window).width() <= 768) {
            $(".login-wrapper .login").css({"overflow-y":"auto"});
        }
        $(".form-wrapper").css({
            "transform":"translateY(calc(-100% + 50px))"
        });
        $(".login-tab .s1").css({
            "display":"none"
        });
        $(".login-tab .s2").css({
            "display":"block"
        });
        $(".login-tab i").css({
            "transform":"rotate(-180deg)"
        });
        tab++;
    } else {
        tab1();
    }
});
$(".show-login").on('click', function() {
    $(".login-wrapper").css("display","flex");
    $(".dark").css({"animation":"fadein .5s","opacity":"1"});
    $(".login-wrapper .login").css("animation","scalein .5s cubic-bezier(.17, .47, .19, 1.16)");
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            logInClose();
        }
    });
});
function logInClose() {
    $(".login-wrapper").css("top","0vh");
    $(".dark").css({"animation":"fadeout .5s", "opacity":"0"});
    $(".login-wrapper .login").css("animation","scaleout .5s cubic-bezier(.45, -0.34, .54, .2)");
    setTimeout(function() {
        $(".login-wrapper").css("display","none");
        tab1();
    },480);
}
$(".fa-bars").on('click', function() {
  showNav();
});
$(document).on("swipeleft", function() {
  showNav();
});
$(".posterList, p, input, img, h1, a, select, span").on("swipeleft", function() {
  setTimeout(function() {
      closeNav(1);
  },1);
});
function showNav() {
  $(".sidebar-wrapper").css({
      "display":"block"
  });
  $(".dark").css({"animation":"fadein .3s", "opacity":"1"});
  $(".sidebar-wrapper .sidebar").css({
      "animation":"slidein .3s", "transform":"translateX(0)"
  });
  $(document).keyup(function(e) {
      if (e.keyCode == 27) {
          closeNav();
      }
  });
  $(document).on("swiperight", function() {
    closeNav();
  });
}
function closeNav(f) {
    if (f == 1) {
      $(".sidebar-wrapper").css({
          "display":"none"
      });
    }
    $(".dark-nav").css({"animation":"fadeout .3s", "opacity":"0"});
    $(".sidebar-wrapper .sidebar").css({
        "animation":"slideout .3s", "transform":"translateX(100%)"
    });
    setTimeout(function() {
        $(".sidebar-wrapper").css({
            "display":"none"
        });
    },280);
}
