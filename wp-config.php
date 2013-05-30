<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sp_vhotopic');

/** MySQL database username */
define('DB_USER', 'sp_vhotopic');

/** MySQL database password */
define('DB_PASSWORD', 'sp_vhotopic');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '^6v->39=Fa379L2+{|C]S1J[S2{-@}oI-SOt|Xa)!)@>:TV-uc4e$-0 i6E4-6-.');
define('SECURE_AUTH_KEY',  'WKnb*XWK@m|S4~KIhWXp AbJ.7YY<|k,I+ir4#~04so`DZ/6)>aT(SVP;L<g{/{f');
define('LOGGED_IN_KEY',    'bJUX+AAZ+.Iuw0o,0];uDd_0W?hFcu/xT0E_hO|AY?Hn,s6{[NIZwab {W)O^0(y');
define('NONCE_KEY',        'Zsw|TBF2x}~jWZg<NLv!37Vx}w=`?T~KE%*Tek+yCVCKm:T&;Z((?(;Wr-w&lYh[');
define('AUTH_SALT',        ')!+%QU&FY#x=*f(#t=ep4v_g@;!O$qt}[c$K(M-xj.rk@18lI87PLWMlQXx=$99F');
define('SECURE_AUTH_SALT', '{e}u]!j.{$LA|-el[aD+x[2K~NS>2l.@j9KAB|F]?H)<] _Las;n+ue|+<PnQue+');
define('LOGGED_IN_SALT',   '|x{fRH8V>;|yHs4T$;h.E,[,H-pJMN85*$Qd`9S2! &Re!yC0+Hf[A7T5|xEE@C=');
define('NONCE_SALT',       'Zp$UB,(&b4 m+-{vX_e1M~D:lV/;c>9_/zGy9=)}_+6x%2gIK1:^0?Si:4^d+Pkl');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pics_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
