<?php
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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'lisa' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'E/R5lx?=;~@k+|%imCUdS(Xa)N(EGyrr]8O3hWWfh8d(,8vo-JOb:So.@%*MCicX');
define('SECURE_AUTH_KEY',  'rhS])G`Q`Yy.+Ff$c)@s#1K:@JCXDk<-h#uKDg7m@p(Mk8vX?KI8^%#;i4sm)6ZR');
define('LOGGED_IN_KEY',    'fAZX<,CrN]_1gF{j{G^=yzc/X-8LCtdF;*Akum^LGci:M|T{d)|^sM9Ap3xy><n~');
define('NONCE_KEY',        'O#S|qp!&j8PqtYS~|._jVo;t=wjm/G>{/,LfVrW1zHuyOg_vVF@zddcIA^iN2$dH');
define('AUTH_SALT',        '|L5Qg|dX,te#: |EA|-_s=R/WEPdBW6-U+FpgER,,1-S--3I$iq%+V(Ht`_EJb%d');
define('SECURE_AUTH_SALT', 'N*Z0A{@IXawprtfZa@$|f:]T6~#8.yI(&sPwQJ~B:{+Ny%#0:{[~$QpjrWJA6/W7');
define('LOGGED_IN_SALT',   'E5c-6Kv`k2[(c^3A+-AlQMJ)QE?</Yd;mJn5&gLU bnR4f[+{?LD-8#9 oq%I^;M');
define('NONCE_SALT',       '!%Nu)9}Z4`o4w|;GcK6E76Z_qr]&jvug65j-$r@fj:Y5Yn{>qFns0O$hvp,%e<``');

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';