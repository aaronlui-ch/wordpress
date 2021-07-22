<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'cmb2_admin_init', 'dvscwl_register_plugin_options_metabox' );

function dvscwl_register_plugin_options_metabox() {

	$cmb_options = new_cmb2_box( array(
		'id'           => 'dvscwl_option_metabox',
		'title'        => esc_html__( 'DV Shortcode Whitelist Settings', 'dvscwl' ),
		'object_types' => array( 'options-page' ),
		'option_key'      => 'dvscwl_options',
        'parent_slug'     => 'plugins.php',
        'capability'      => 'manage_options',
        'save_button'     => esc_html__( 'Save Settings', 'dvscwl' )
	) );
    
    // Documentation Notice
    
    $cmb_options->add_field( array(
        'name' => '<a href="http://www.wp4life.com/online/dvscwl/index.html" target="_blank">' . esc_attr__( 'Click Here To Read The Documentation', 'dvscwl') . '</a>',
        'desc' => esc_attr__( 'Please take the time to read the documentation. As many support related questions can be answered simply by re-reading the documentation.', 'dvscwl'),
        'type' => 'title',
        'id'   => 'title_doc'
    ));

	// General Settings
    
    $cmb_options->add_field( array(
        'name' => esc_html__( 'Activation', 'dvscwl'),
        'type' => 'title',
        'id'   => 'title_settings'
    ));
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'WordPress Comments', 'dvscwl'),  
            'id' => 'wp_comments',
            'type' => 'radio_inline',
            'options' => array(
                'enable' => esc_html__( 'Enable', 'dvscwl' ),
                'disable'   => esc_html__( 'Disable', 'dvscwl' )
            ),
            'default' => 'disable',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'bbPress Topics', 'dvscwl'),  
            'id' => 'bbpress_topics',
            'type' => 'radio_inline',
            'options' => array(
                'enable' => esc_html__( 'Enable', 'dvscwl' ),
                'disable'   => esc_html__( 'Disable', 'dvscwl' )
            ),
            'default' => 'disable',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'bbPress Replies', 'dvscwl'),  
            'id' => 'bbpress_replies',
            'type' => 'radio_inline',
            'options' => array(
                'enable' => esc_html__( 'Enable', 'dvscwl' ),
                'disable'   => esc_html__( 'Disable', 'dvscwl' )
            ),
            'default' => 'disable',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'BuddyPress Activities', 'dvscwl'),  
            'id' => 'buddypress_activities',
            'type' => 'radio_inline',
            'options' => array(
                'enable' => esc_html__( 'Enable', 'dvscwl' ),
                'disable'   => esc_html__( 'Disable', 'dvscwl' )
            ),
            'default' => 'disable',
        )
    );
    
    $cmb_options->add_field( array(
        'name' => esc_html__( 'Administrator - Keymaster', 'dvscwl'),
        'desc' => esc_html__( 'Capabilities;', 'dvscwl') . ' <code>manage_options</code> ' . esc_html__( 'or', 'dvscwl') . ' <code>keep_gate</code>',
        'type' => 'title',
        'id'   => 'title_administrator'
    ));
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Enable All Shortcodes', 'dvscwl'),  
            'id' => 'administrator_all',
            'type' => 'radio_inline',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'dvscwl' ),
                'no'   => esc_html__( 'No', 'dvscwl' )
            ),
            'default' => 'yes',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Shortcode Whitelist', 'dvscwl'),  
            'id' => 'administrator_whitelist',
            'desc' => esc_html__( 'Enter a shortcode name and hit the Enter key to select. You can add as many as you want.', 'dvscwl'),
            'type' => 'text'
        )
    );
    
    $cmb_options->add_field( array(
        'name' => esc_html__( 'Editor - Moderator', 'dvscwl'),
        'type' => 'title',
        'desc' => esc_html__( 'Capabilities;', 'dvscwl') . ' <code>edit_pages</code> ' . esc_html__( 'or', 'dvscwl') . ' <code>edit_forums</code>',
        'id'   => 'title_editor'
    ));
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Enable All Shortcodes', 'dvscwl'),  
            'id' => 'editor_all',
            'type' => 'radio_inline',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'dvscwl' ),
                'no'   => esc_html__( 'No', 'dvscwl' )
            ),
            'default' => 'no',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Shortcode Whitelist', 'dvscwl'),  
            'id' => 'editor_whitelist',
            'desc' => esc_html__( 'Enter a shortcode name and hit the Enter key to select. You can add as many as you want.', 'dvscwl'),
            'type' => 'text'
        )
    );
    
    $cmb_options->add_field( array(
        'name' => esc_html__( 'Other Users', 'dvscwl'),
        'type' => 'title',
        'id'   => 'title_other'
    ));
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Enable All Shortcodes', 'dvscwl'),  
            'id' => 'other_all',
            'type' => 'radio_inline',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'dvscwl' ),
                'no'   => esc_html__( 'No', 'dvscwl' )
            ),
            'default' => 'no',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Shortcode Whitelist', 'dvscwl'),  
            'id' => 'other_whitelist',
            'desc' => esc_html__( 'Enter a shortcode name and hit the Enter key to select. You can add as many as you want.', 'dvscwl'),
            'type' => 'text'
        )
    );
    
    $cmb_options->add_field( array(
        'name' => esc_html__( 'Custom Role or Capability', 'dvscwl'),
        'type' => 'title',
        'desc' => '<a href="https://codex.wordpress.org/Roles_and_Capabilities" target="_blank">' . esc_html__( 'WordPress Roles and Capabilities', 'dvscwl') . '</a>',
        'id'   => 'title_custom'
    ));
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'The name of the Role or the Capability', 'dvscwl'),  
            'id' => 'custom_role',
            'desc' => esc_html__( 'Enter the name of the role or capability.', 'dvscwl'),
            'type' => 'text'
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Enable All Shortcodes', 'dvscwl'),  
            'id' => 'custom_all',
            'type' => 'radio_inline',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'dvscwl' ),
                'no'   => esc_html__( 'No', 'dvscwl' )
            ),
            'default' => 'no',
        )
    );
    
    $cmb_options->add_field(
        array(
            'name' => esc_html__( 'Shortcode Whitelist', 'dvscwl'),  
            'id' => 'custom_whitelist',
            'desc' => esc_html__( 'Enter a shortcode name and hit the Enter key to select. You can add as many as you want.', 'dvscwl'),
            'type' => 'text'
        )
    );

}

function dvscwl_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		return cmb2_get_option( 'dvscwl_options', $key, $default );
	}

	$opts = get_option( 'dvscwl_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}
?>