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
define('DB_NAME', 'jlodywmy_WPCNA');

/** MySQL database username */
define('DB_USER', 'jlodywmy_WPCNA');

/** MySQL database password */
define('DB_PASSWORD', '#=)ebIES*USlx3$a@');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY', 'b21d549c10aea689e8a6e961fa3509def00bebf63f8389502c8098514ed9451c');
define('SECURE_AUTH_KEY', 'a3f8b576f7c14f8c1f4b52b77f0826c8c00f5298beab389f183a7f18b70d5bf4');
define('LOGGED_IN_KEY', '32644a4c43c766af8fb30ade155907bacfb2708a1ffb7d199fbec5f97a8c0050');
define('NONCE_KEY', '5c94c2a6b306fc3489578802deffa78aa64ab2787095c2942687496796eeb475');
define('AUTH_SALT', '02176c221db54a9c258eb63aa087255c5ae4968ebad60c2f97add1073ea48dc1');
define('SECURE_AUTH_SALT', '26479a40580a72b70e8e2bbdc0936f614ee3a46354268f24a4d9686ea2f989e3');
define('LOGGED_IN_SALT', 'd5545e51eabff31a4af066e3354f5f997654266bdaf76e07e772134059795ff2');
define('NONCE_SALT', 'ef3c9e8d876108e62ea8579408278037182b79a6a5438214cc52d4083ac9f8af');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'UIN_';
define('WP_CRON_LOCK_TIMEOUT', 120);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 5);
define('EMPTY_TRASH_DAYS', 7);
define('WP_AUTO_UPDATE_CORE', true);

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
