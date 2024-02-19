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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress-assignment' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'bFithNWKNVp-(AxKX{3&K3>[;h*q/S-;SJ5E8e1j~,0:;D+mOZDx,DZ[oEx.52]I' );
define( 'SECURE_AUTH_KEY',  '~Paib,<!l#e*roD9XsQnAqqk8/JU!qO%(h@S9!i1m4K39jO77`j4/Iv6f%L7z%O+' );
define( 'LOGGED_IN_KEY',    'T;y1z%(>|Gi:]kypt?pheCrW@_y u2xqpc+5i}e{41r,$qCm2v505/Xv|/Mi0PB+' );
define( 'NONCE_KEY',        'jeWDn/kTX4&yoj%#./~~s89>rV>6|%41N?4>|0o`S}Nvuw0]@`mCa0,Y_f)h{&+v' );
define( 'AUTH_SALT',        'P98v8092i9NxOD`:~H%KM(e)XcZzI&NEmIeK-Cg9w@W `4;?5wY<OUNJ,R,Xjcj?' );
define( 'SECURE_AUTH_SALT', 'FXv45;[%PnY#X~YS>/~*T[5Un<#8:,LPxoZ7~=.DRAYZ[f.y`6,-kX){r63EjGD>' );
define( 'LOGGED_IN_SALT',   'V.3#@Z/Y>nqy^`f)D9.]k=DqpuSgj;Eu$?[z_HpD3/ef7g`al3TriH4w4T3-gad5' );
define( 'NONCE_SALT',       '`|jZzrOG[2gVu)G(?V`yrKn?b>7E|_V(aprh?<cR1q^`bk0vvH??mw6q.a/bg;b3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_table';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
