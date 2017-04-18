var tab = 0;
function tab1() {
    $(".login-wrapper .login").css({
        "max-width":"400px",
        "max-height":"290px"
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
            "max-width":"500px",
            "max-height":"600px"
        });
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
    $(".login-wrapper").css({
        "transform":"scale(1)",
        "top":"0",
        "opacity":"1"
    });
});
$(".closelogin").on('click', function() {
    $(".login-wrapper").css({
        "transform":"scale(0)",
        "top":"0vh",
        "opacity":"0"
    });
    tab1();
});
$(".fa-bars").on('click', function() {
    $(".sidebar-wrapper").css({
        "transform":"translateX(0)",
        "transition":"1s"
    });
    $(".sidebar-wrapper .dark-nav").css({
        "transform":"translateX(0)",
        "transition":".7s"
    });
});
$(".closenav").on('click', function() {
    $(".sidebar-wrapper").css({
        "transform":"translateX(100%)",
        "transition":"1.1s"
    });
    $(".sidebar-wrapper .dark-nav").css({
        "transform":"translateX(80%)",
        "transition":"1.1s"
    });
});