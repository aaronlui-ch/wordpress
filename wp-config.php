<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FugcmE/n0,k9Y$SA^-)pfN=pSh:}_YW9UDkAjs;Wt|Z=icm(Ej=*+]$O4y/);tO:' );
define( 'SECURE_AUTH_KEY',  'lk3FmuSLodG`z/Cv4^iBLod,?OVTzET;Bb8;Hg]4qs4Pj$*9W5G5%chI}fomRG#@' );
define( 'LOGGED_IN_KEY',    'DqElr_EH.%p9,z(6#UwZC2CJ5en.+YNV|UH|lV~*.(qo%&j)s G[`J9.;6K f.}6' );
define( 'NONCE_KEY',        '|{U>k?d{FRYY=rIXyp<B[ajiCS1=xD6T>mVW5fy)&k*L|h,JnF#V CQ*9[%=}sc_' );
define( 'AUTH_SALT',        'F{K9uX2<TLmxH6?xne{CDj]?^,)nNzIVO;Meqe!n*dCBc`w`L7Y#hxS&;RW8F5H,' );
define( 'SECURE_AUTH_SALT', '419t7QOS| q[|{(c|NmN-|2D(6@TiLGB`*0]{@SOj>{li{)PkmZ_^$z$]J6YhfOk' );
define( 'LOGGED_IN_SALT',   'Pf8%V~M01C6e,Q=zKH{Vc.*_AI!_i?c ;cy29)l<#fQ=(r)P?C`2Of,#JI2,i}U~' );
define( 'NONCE_SALT',       'F;t@d4#U^P}X];W*U/Ig]%[Ob Wf^d92iU<_n*oV9PN8_@]}@ orkpei 0)6se?y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
