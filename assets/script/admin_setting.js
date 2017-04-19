$(".set-wrapper").on('click', function() {
    $(".set-popup").css({
        "display":"flex"
    });
    $(".dark").css({
        "animation":"fadein .5s"
    });
    $(".set-form").css({
        "animation":"scalein .5s ease"
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
            closeSet();
        }
    });
});
function closeSet() {
    $(".dark").css({
        "animation":"fadeout .5s"
    });
    $(".set-form").css({
        "animation":"scaleout .5s ease"
    });
    setTimeout(function() {
        $(".set-popup").css({
            "display":"none"
        });
    },480);
}
