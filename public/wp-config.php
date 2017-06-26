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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'oak');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'vagrant');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/E6@NpzXo?>!7|^wViBX)#;.D<@HR4<vycq7S AbNb)*&LS7Lb&I@(8ZYDqaX=ej');
define('SECURE_AUTH_KEY',  'Aj>ZRZv8y!s5 KT|oADk<EDx=%AP*D7@?vrt{Ioz1%Z^wz!4A1F5U|DcX$E~_=pM');
define('LOGGED_IN_KEY',    ');m0>k3T4FrHIR|1= m=h]A3@y+5bwSdFA5)Z,4BJo_?kj+RIJ,+du2<mW;Mfb_t');
define('NONCE_KEY',        'Xqz1!Umqh*VS[^GAyWJ8gNrO$=%]S(}Y9y.^~bCnbAl $%eGUSp]kF-3rr@hr:MA');
define('AUTH_SALT',        '<de2d,22A;-abO172^tu:)!i$eX1J:JR;m1&.]m+DWJcw/>86r4 F:q:=ld,0pGV');
define('SECURE_AUTH_SALT', ')iV>a*It#LIH@K-,Li>`6;$xOggB5>c<hePd2PvEW0vQhy,]h7nSc7-h1<lPcR$f');
define('LOGGED_IN_SALT',   'Zd!~xlmVilEMr@ks-SC,*lu_K{b.6iIlf{v{YrNDrK0?9IP^uX}9???U7%tdv}EM');
define('NONCE_SALT',       '5=P_zh#Pb]1g%5Eo$Z1`&{dJfNoT1[hHt~S#{UpK)7I|ne.<na-Ie>?%egIQ)+-4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'oak_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
