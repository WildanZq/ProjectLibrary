function resizeImg() {
    var imgP = document.getElementsByClassName('img-parent');
    var img = document.getElementsByClassName('img');
    img.height = "auto";
    img.width = "auto";

    for(i = 0; i < imgP.length; i++) {
        var widthP = imgP[i].clientWidth;
        var heightP = imgP[i].clientHeight;
        var width = img[i].clientWidth;
        var height = img[i].clientHeight;
        var rasioP;
        var rasio;
        if(heightP > widthP) {
            rasioP = heightP / widthP;
            if(height > width) {
                rasio = height / width;
                if(rasioP > rasio) {
                    img[i].style.height = "100%";
                    img[i].style.width = "auto";
                } else {
                    img[i].style.width = "100%";
                    img[i].style.height = "auto";
                }
            } else {
                img[i].style.height = "100%";
                img[i].style.width = "auto";
            }
        } else if(heightP < widthP) {
            rasioP = widthP / heightP;
            if(height < width) {
                rasio = width / height;
                if(rasioP > rasio) {
                    img[i].style.width = "100%";
                    img[i].style.height = "auto";
                } else {
                    img[i].style.height = "100%";
                    img[i].style.width = "auto";
                }
            } else {
                img[i].style.width = "100%";
                img[i].style.height = "auto";
            }
        } else if(heightP == widthP) {
            if(height > width) {
                img[i].style.width = "100%";
                img[i].style.height = "auto";
            } else {
                img[i].style.height = "100%";
                img[i].style.width = "auto";
            }
        }
    }
}
$(document).ready(function() {
  try {resizeImg();} catch(e) {}
})
$(window).on("load", function() {
    try {resizeImg();} catch(e) {}
});
$(window).resize(function() {
    setTimeout(function() {
        try {resizeImg();} catch(e) {}
    }, 500);
});
