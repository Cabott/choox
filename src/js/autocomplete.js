/**
 * Created by msoliman on 13.04.2016.
 */
var jQuery = require('./main.js');

jQuery(function() {
    var availableTags = jQuery('script#teamprovider').data('team-names');

    jQuery( "#fos_user_registration_form_favouriteTeam").autocomplete({
        source: availableTags,
        minLength: 2
    });

    jQuery( "#logo_teamName").autocomplete({
        source: availableTags,
        minLength: 2
    });
});