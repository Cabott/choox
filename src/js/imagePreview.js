/**
 * Created by msoliman on 16.09.2016.
 */
var jQuery = require('./main.js');

function previewImage(input, original) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            if(original) {
                jQuery('#originalLogoPreview').attr('src', e.target.result).show();
            } else {
                jQuery('#alteredLogoPreview').attr('src', e.target.result).show();
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

jQuery(function() {
    jQuery("#logo_originalLogoFile_file").change(function(){
        previewImage(this, true);
    });
    jQuery("#logo_alteredLogoFile_file").change(function(){
        previewImage(this, false);
    });

});