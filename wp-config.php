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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sidiagro' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

// if ( !defined('WP_CLI') ) {
//     define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
//     define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
// }



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
define( 'AUTH_KEY',         '7lvzfk0k4WcLZnomqdpqabUMzyO3I58GmEo4J3z1cs7IANjcBRv0uHjldelPxoTp' );
define( 'SECURE_AUTH_KEY',  'mC2SIDQdBc3I79GfiwXSp49OVKZgR0w7j9zJQJEysCh8VlrF7cWyjpVcKcM1Vz6K' );
define( 'LOGGED_IN_KEY',    'yfR4nCQG407uFsvUg1oAlba8WFCj7PB5qElmbxkSH5pormOSKQ71joakMiYBWjuP' );
define( 'NONCE_KEY',        'Tc5vEdcZIIKDjEg3283MSOzQD0mH0klWc8W568NFXWCWBqGA9SQmXPaTN9DmHXsq' );
define( 'AUTH_SALT',        'hNW7I6gIuBaZviurG4MIHb0iETFe8dqfNyWNNzDIexSDC3jwoBSFqZw0iPyIP3bh' );
define( 'SECURE_AUTH_SALT', 'NJcZnyGht80IMOEkaCK9735alb75TVbt4VLB6LffvydChHrWpKvSxBEQMfWdI1sE' );
define( 'LOGGED_IN_SALT',   'CWRz2vyXZb5oKv0r9efeYETBHQlIcFBWq0BzkmNYN9Kj81lzNnDPMQF5I1wCscBi' );
define( 'NONCE_SALT',       'gbuJgylnckDv7TePpqq9Y1bT5FTTNb24kseqbkcZ6AaAsIYtzTRWxUxabanh65qb' );

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
