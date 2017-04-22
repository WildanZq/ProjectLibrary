function readURL(input,x) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.img').eq(x).attr('src', e.target.result);
            try {
                resizeImg();
            } catch(e) {
                
            }
            
        };
        reader.readAsDataURL(input.files[0]);
    }
}
