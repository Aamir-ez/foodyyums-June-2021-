/**********=== TOGGLE ACTION ====********/
function show_hide_act(open, close, target) {
    jQuery(open).on('click', function () {
        //            debugger;
        jQuery(target).show('slow');
        jQuery(this).hide();

    });
    //on close hide form
    jQuery(close).on('click', function () {
        //            debugger;
        jQuery(target).hide('slow');
        jQuery(open).show('slow');
    });
}
/**********=== REMOVE: MENU ITEM EXTRA====********/
function ez_remove_extra_item(obj) {
    var parent = jQuery(obj).closest('.extra_item');
    parent.remove();
}
/**********=== MENU ITEM FIELD REMOVE HIGHLIGHT CLASS====********/
function removeHighlightClass(item) {
    jQuery(item).on('change', function () {
        jQuery(this).removeClass("highlight");
    });
}
/**********=== MENU ITEM FIELD VALIDATE....====********/
function ez_menu_item_field_validate(required, msg) {
    jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + msg)
            .addClass('alert-danger').show("slow").delay(4000).hide("slow");
    jQuery(required).addClass("highlight").focus();
    jQuery('html, body').animate({
        scrollTop: jQuery("#wcfm_products_manage").offset().top
    }, 900);
}

/**********=== REMOVE: MENU ITEM EXTRA Sub====********/
function ez_remove_extra_item_sub(obj) {
    var parent = jQuery(obj).closest('.extra_sub');
    parent.remove();
}


function ez_successful_response(response) {
    jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + response.MSG)
            .removeClass('alert-danger').addClass('alert-info').show("slow").delay(4000).hide("slow");
    jQuery('html, body').animate({
        scrollTop: jQuery(".tabs-container-main").offset().top
    }, 1000);
}

