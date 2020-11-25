<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define( 'DB_NAME', 'softxweb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6tkg0gXX@WFoNDuo;&B>V(O+( U$;!pNZ+mf:0{GWsbT|2~k!<?!0LAl{~O9@iz ' );
define( 'SECURE_AUTH_KEY',  ':h.k)Fl=&}W2-`M)j_2(jOe[cg$kcC_~C}T4xG6LaS{o/d*C #]+>k7WMlxn|tJ.' );
define( 'LOGGED_IN_KEY',    'B3%}vkJ{LEAJoOv-`s8[[$@(U %)3I/wvWPdzR]8+Kg]wTo/0$`ZiWfP(Hy>u*XT' );
define( 'NONCE_KEY',        'f,!UYmvv-LE@C-k!6oX:aPc_{4>ZRC*6d8=0|S;!Gg`Zy b>/>QL:/2!k+)(/0L,' );
define( 'AUTH_SALT',        '0jKcfu8Y<=MoP!,hg)dN3`DhIlgmjpAb^Or7RJ(`[ SdYL?X7U(RJ3HRs}(2|IE:' );
define( 'SECURE_AUTH_SALT', 'R>>EdZ[<vRwM;]yB0_]6ef`AmSZfutzys=NTq8@U]A[7h8^^j8|vaC+!=hHC_o t' );
define( 'LOGGED_IN_SALT',   'U>?<<lAMlI~E{9R~WySZfZ:tzF>{--+bmA}NCO<_t9F(j[+nO39LF)@)=sTk]=PP' );
define( 'NONCE_SALT',       'IkGX[qsKY)TEy[{VnBNSW7|bhfVhGnW@o?D0I1J7mjzv`K_KtY61dy-dE!8?9>><' );


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'fx_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define( 'WP_HOME', 'http://localhost/softxbd' );
define( 'WP_SITEURL', 'http://localhost/softxbd' );