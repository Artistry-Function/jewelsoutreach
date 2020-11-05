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
define( 'DB_NAME', 'jlodywmy_WPCNA' );

/** MySQL database username */
define( 'DB_USER', 'jlodywmy_WPCNA' );

/** MySQL database password */
define( 'DB_PASSWORD', '#=)ebIES*USlx3$a@' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'OTM)(i?D:lsr%~d~H8G2,d54I+>a3<U0`.eLlLQQq#Nwslc+>i$0p? M:V4MyXfX' );
define( 'SECURE_AUTH_KEY',   '5WmTz( ZePHjny<nM/Ad>N=JCh:zd(F/BC5%U/8./RI2>m-9w#D~5J;Vq&38btcJ' );
define( 'LOGGED_IN_KEY',     'if&L:a-FEBLdf?fTwxw>?B>}GAb{Mf}R n%h6IR9Mb](Yr9U,abyX:-kgZ<`n9e~' );
define( 'NONCE_KEY',         '#=iuM:-o,>?6~[(3g)Z7kQ#R+*]f|We3/c%Nc !/32FnSV,2FX$I_$$iEilO:iq#' );
define( 'AUTH_SALT',         's?N-v.3XHBw#qhs{%X)jE/.l/C$>A%+]k-P&[6};n!HFdW`o7ex|R$ibQ8s&|.ao' );
define( 'SECURE_AUTH_SALT',  'XP^R^4#r>t)jmi|tuGwxb0_^Xkqos`D8zJrzu3-qk/Ast__:U=Y$rRrvnJvQ,1_c' );
define( 'LOGGED_IN_SALT',    'j.M49_Eh9i]*>n0|H8_[EsYQ@H57Y`-yxz#W0nz+&Q_g7^1uDj9%,,=d8[1&9[v?' );
define( 'NONCE_SALT',        '*l) N${BGvVC/&16#FD*lTw&:x}Z{vhs/+rCR!-02n#TL$9 W8;2Y<stx/@BH]1K' );
define( 'WP_CACHE_KEY_SALT', ':fsO!r@1V>A,xJFX D!J2(_@iB,L$~$R&}$})(s--wYA+F?Y>Vp&,kWqXcz/V1Xd' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'staging_UIN_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
