/**
 * Created by msoliman on 16.09.2016.
 */
// keep track of how many name fields have been rendered

jQuery(function() {
    jQuery("#addAlternativeName").click(function (e) {
        e.preventDefault();
        var alternativeNamesList = jQuery('#logo_teamNameAlternatives');

        // grab the prototype template
        var newWidget = alternativeNamesList.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique
        newWidget = newWidget.replace(/__name__label__/g, '');
        newWidget = newWidget.replace(/__name__/g, jQuery('#removeAlternativeName').length);

        // create a new element and add it to the list
        var newLi = jQuery('<p></p>').html(newWidget);
        newLi.appendTo(alternativeNamesList);
    });

    jQuery('#logo_teamNameAlternatives').on('click', '#removeAlternativeName', function (e) {
        e.preventDefault();
        jQuery(this).closest('div.input-group').remove();
    });
});

