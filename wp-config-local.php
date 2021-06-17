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
define( 'DB_NAME', 'foodyyums' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

//define('DB_NAME', 'foodyyums');

/** MySQL database username */
//define('DB_USER', 'foodyyums');

/** MySQL database password */
//define('DB_PASSWORD', 'foodyyums*pw1001');


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
define( 'AUTH_KEY',         '2:1knWghJ!w,u6%YA=~}K{eIz+.i=:UrJh2p{)jI5RZ6=t!-25lNdwJu=^jS^;Nd' );
define( 'SECURE_AUTH_KEY',  '#w@=0B=*Od(&97N=p]t/pAcXg__@HYBuOccC<}lMBbaZ%ifH{Jp~TZRA+/eymW?=' );
define( 'LOGGED_IN_KEY',    'o3#xiyq3A [RDiHZG;%,Q Bdp@=?&Qd;G8siOCz+OCX&H9)HYI0uY*Ox5lOwvbxN' );
define( 'NONCE_KEY',        'B53snZ=*a*^r]Xz3KP`krrv2BRPl<Id[h$p27YWTGRXJn:RiiGV-[Fy1M<pL8PbY' );
define( 'AUTH_SALT',        'l*cUHV5/0S6dl5V5)<*]]J2ew3r3-I*.qSvI9IE]gll[`oNtTf=wnBR>.ltH<r%)' );
define( 'SECURE_AUTH_SALT', '|O g1z[]AGHE<?bvauTEI?l<kpUvvO[,K&I^1*E|eT]uGsM#;xA;bD;u%c)_|5Jy' );
define( 'LOGGED_IN_SALT',   'Xg*<yA``}PI!4FfDjePAO=VfsyPD2_h#2kT9g^-ec:XwzW)&>870^*8s5SaCJ_F9' );
define( 'NONCE_SALT',       'Jl/NKd,ZD$yPgW4{)p?91*tD-:^Y >$}fR$U;TcETnu:D(L[<pX pN;tteqK6w~I' );

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




@ini_set( 'upload_max_filesize' , '1024M' );
@ini_set( 'post_max_size', '1024M');
@ini_set( 'memory_limit', '512M' );
@ini_set( 'max_execution_time', '400' );
@ini_set( 'max_input_time', '400' );