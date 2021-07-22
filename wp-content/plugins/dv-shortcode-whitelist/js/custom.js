jQuery('#administrator_whitelist, #editor_whitelist, #other_whitelist, #custom_whitelist').tagify();

jQuery(document).ready(function () {
    jQuery('#dvscwl_option_metabox').submit(function () {
        var error = 0;
        var txtval = jQuery('#custom_role').val();
        var regex_length = /^[0-9a-z_-]+$/gm;
        if ((!regex_length.test(txtval)) && (txtval != '')) {
            error = 1;
            alert("The name of the role or the capability must be all lowercase and use letters, numbers or underscores.");
        }
        if (error) {
            return false;
        } else {
            return true;
        }
    });
});