/*global jQuery, document*/
jQuery(document).ready(function ($) {
    'use strict';
    
    if( toggleadminmenu_vars.visible === 'true' ) {
        if( jQuery('#adminmenuwrap').css('display') == 'none' ) {
            jQuery('#adminmenuwrap').css('display', 'block');
            jQuery('#adminmenuback').css('display', 'block');
            jQuery('#wpcontent').css('margin-left', '160px');
        } else {
            jQuery('#adminmenuwrap').css('display', 'none' );
            jQuery('#adminmenuback').css('display', 'none' );
            jQuery('#wpcontent').css('margin-left', '0');
        }
    }
});
