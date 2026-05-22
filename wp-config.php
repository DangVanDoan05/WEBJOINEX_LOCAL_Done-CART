<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'joinexstore' );

/** Database username */
define( 'DB_USER', 'joinexstore' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         '+TOg1+Yf/cXZa6U$6Uu5y+bJ+n&x*P/-ymj@~//2r}olOt${SEkHw2Ic_Odv+[q-' );
define( 'SECURE_AUTH_KEY',  'mCdfWcmrDQ8&66c_ht,vKfu s~GDi|K.!FST3nA?@d&g+[5hk+Iz*:GTsp?u/)hP' );
define( 'LOGGED_IN_KEY',    'SBTY[Lh@FErL%An?%M9f%5:KLYU@9AV;Jk@O3|+hf$2%-Ln4QqjKXw X>yCJB{|H' );
define( 'NONCE_KEY',        '297f/.cOUdR4=Ra-UC+xZ-sg,viD0n)Qy<Eyk}x8J?tOuE;}RD==*7z&?H7uu=EA' );
define( 'AUTH_SALT',        '!y_D8Te]lo?tnRuIyOpd%7F/8U+4e+e9ss$@1Zmv*^[ 9;O=71F2fDEJ9a(iN7Dr' );
define( 'SECURE_AUTH_SALT', '1({./ #gza}XF+?mWOQ@XqF96/TW/wdz/tSu0CFH`1$#X! TI%Z+pVhP;$7cI(N4' );
define( 'LOGGED_IN_SALT',   'ir`gt!Eur81NXY`R.@[p*&&0qO)#659:F+fZoz<,M}XDjQWm-D# ZT,.>OY12=Na' );
define( 'NONCE_SALT',       'zzN#rluXIx${9;;%@K1HoDZ0Yo^VA_Ueda[k(EB{bzI{FE%J16-WdmLiC+b;$!Qu' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'tb_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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


