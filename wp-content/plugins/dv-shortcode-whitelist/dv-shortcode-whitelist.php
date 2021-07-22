<?php
/**
 * Plugin Name: DV Shortcode Whitelist
 * Plugin URI: https://wordpress.org/plugins/dv-shortcode-whitelist/
 * Description: Shortcode Whitelist for bbPress, BuddyPress and WordPress Comments
 * Version: 1.0
 * Author: Egemenerd
 * Author URI: http://www.egemenerd.com/
 * Text Domain: dvscwl
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* ---------------------------------------------------------
Custom Metaboxes - https://github.com/WebDevStudios/CMB2
----------------------------------------------------------- */

// Check for  PHP version
$dvscwldir = ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) ? __DIR__ : dirname( __FILE__ );

if ( file_exists(  $dvscwldir . '/cmb2/init.php' ) ) {
    require_once  $dvscwldir . '/cmb2/init.php';
} elseif ( file_exists(  $dvscwldir . '/CMB2/init.php' ) ) {
    require_once  $dvscwldir . '/CMB2/init.php';
}

/* Plugin settings */
require_once('dv-settings.php');

/* Admin Scripts */
function dvscwl_admin_scripts($hook){
    if ( 'plugins_page_dvscwl_options' != $hook ) {
        return;
    }
    wp_enqueue_style('dvscwl-admin', plugin_dir_url( __FILE__ ) . 'css/admin.css', false, '1.0');
    wp_enqueue_style('dvscwl-tagify', plugin_dir_url( __FILE__ ) . 'css/tagify.css', false, '1.0');
    wp_enqueue_script( 'dvscwl-tagify', plugin_dir_url( __FILE__ ) .'js/tagify.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'dvscwl-custom', plugin_dir_url( __FILE__ ) .'js/custom.js', array('dvscwl-tagify'), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'dvscwl_admin_scripts' );

/* ---------------------------------------------------------
Custom do_shortcode
----------------------------------------------------------- */

function dvscwl_do_shortcode($content, $tagnames) {
  $pattern = get_shortcode_regex($tagnames);
  $content = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $content);
  return $content;
}

/* ---------------------------------------------------------
bbPress Replies
----------------------------------------------------------- */

$dvscwl_bbPress_replies = dvscwl_get_option('bbpress_replies', 'disable');

if ($dvscwl_bbPress_replies == 'enable') {
    add_filter('bbp_get_reply_content', 'dvscwl_bbpress_reply_filter');
}

function dvscwl_bbpress_reply_filter($content){
	$reply_id  = bbp_get_reply_id();
    $user_id = get_post_field( 'post_author', $reply_id );
    if ($user_id) {
    $custom_role = sanitize_title(dvscwl_get_option('custom_role'));    
    if (!empty($custom_role) && user_can( $user_id, $custom_role )) {
        $enable_all = dvscwl_get_option('custom_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('custom_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }      
    } else if (user_can( $user_id, 'manage_options' ) || user_can( $user_id, 'keep_gate' )) {
        $enable_all = dvscwl_get_option('administrator_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('administrator_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }     
    } else if (user_can( $user_id, 'edit_pages' ) || user_can( $user_id, 'edit_forums' )) {
        $enable_all = dvscwl_get_option('editor_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('editor_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        } 
    } else {
        $enable_all = dvscwl_get_option('other_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('other_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }
    }
    } else {
        return $content;
    }
}

/* ---------------------------------------------------------
bbPress Topics
----------------------------------------------------------- */

$dvscwl_bbPress_topics = dvscwl_get_option('bbpress_topics', 'disable');

if ($dvscwl_bbPress_topics == 'enable') {
    add_filter('bbp_get_topic_content', 'dvscwl_bbpress_topic_filter');
}

function dvscwl_bbpress_topic_filter($content){
	$topic_id  = bbp_get_topic_id();
    $user_id = get_post_field( 'post_author', $topic_id );
    if ($user_id) {
    $custom_role = sanitize_title(dvscwl_get_option('custom_role'));    
    if (!empty($custom_role) && user_can( $user_id, $custom_role )) {
        $enable_all = dvscwl_get_option('custom_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('custom_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }      
    } else if (user_can( $user_id, 'manage_options' ) || user_can( $user_id, 'keep_gate' )) {
        $enable_all = dvscwl_get_option('administrator_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('administrator_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }     
    } else if (user_can( $user_id, 'edit_pages' ) || user_can( $user_id, 'edit_forums' )) {
        $enable_all = dvscwl_get_option('editor_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('editor_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        } 
    } else {
        $enable_all = dvscwl_get_option('other_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('other_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }
    }
    } else {
        return $content;
    }
}

/* ---------------------------------------------------------
WordPress Comments
----------------------------------------------------------- */

$dvscwl_wp_comments = dvscwl_get_option('wp_comments', 'disable');

if ($dvscwl_wp_comments == 'enable') {
    add_filter('comment_text', 'dvscwl_wp_comments_filter');
}

function dvscwl_wp_comments_filter($content){
	$comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    $user_id = $comment->user_id;
    if ($user_id) {
    $custom_role = sanitize_title(dvscwl_get_option('custom_role'));    
    if (!empty($custom_role) && user_can( $user_id, $custom_role )) {
        $enable_all = dvscwl_get_option('custom_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('custom_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }      
    } else if (user_can( $user_id, 'manage_options' ) || user_can( $user_id, 'keep_gate' )) {
        $enable_all = dvscwl_get_option('administrator_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('administrator_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }     
    } else if (user_can( $user_id, 'edit_pages' ) || user_can( $user_id, 'edit_forums' )) {
        $enable_all = dvscwl_get_option('editor_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('editor_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        } 
    } else {
        $enable_all = dvscwl_get_option('other_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('other_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }
    }
    } else {
        return $content;
    }
}

/* ---------------------------------------------------------
BuddyPress Activities
----------------------------------------------------------- */

$dvscwl_buddypress_activities = dvscwl_get_option('buddypress_activities', 'disable');

if ($dvscwl_buddypress_activities == 'enable') {
    add_filter('bp_get_activity_content_body', 'dvscwl_buddypress_activity_filter', 1);
}

function dvscwl_buddypress_activity_filter($content){
    $user_id = bp_get_activity_user_id();
    if ($user_id) {
    $custom_role = sanitize_title(dvscwl_get_option('custom_role'));    
    if (!empty($custom_role) && user_can( $user_id, $custom_role )) {
        $enable_all = dvscwl_get_option('custom_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('custom_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }      
    } else if (user_can( $user_id, 'manage_options' ) || user_can( $user_id, 'keep_gate' )) {
        $enable_all = dvscwl_get_option('administrator_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('administrator_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }     
    } else if (user_can( $user_id, 'edit_pages' ) || user_can( $user_id, 'edit_forums' )) {
        $enable_all = dvscwl_get_option('editor_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('editor_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        } 
    } else {
        $enable_all = dvscwl_get_option('other_all'); 
        if ($enable_all == 'yes') {
            return do_shortcode($content);
        } else {      
            $tagnames = dvscwl_get_option('other_whitelist');
            if (!empty($tagnames) && $tagnames != '[]') {
                $tagnames = json_decode($tagnames, true);
                $tagnames_array = '';
                foreach ($tagnames as $tagname) {
                    $tagnames_array .= $tagname['value'] . ',';
                }
                $tagnames_array = explode(',' , trim($tagnames_array , ','));
                return dvscwl_do_shortcode($content, $tagnames_array);
            } else {
                return $content;
            }
        }
    }
    } else {
        return $content;
    }
}
?>