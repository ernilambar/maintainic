<?php
/**
 * Plugin Name: Maintainic
 * Plugin URI: https://github.com/ernilambar/maintainic/
 * Description: Maintenance plugin.
 * Version: 1.0.1
 * Requires at least: 6.6
 * Requires PHP: 7.4
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: maintainic
 *
 * @package Maintainic
 */

use Maintainic\Core\Bootstrap;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MAINTAINIC_VERSION', '1.0.1' );
define( 'MAINTAINIC_BASENAME', basename( __DIR__ ) );
define( 'MAINTAINIC_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'MAINTAINIC_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'MAINTAINIC_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

// Include autoload.
if ( file_exists( MAINTAINIC_DIR . '/vendor/autoload.php' ) ) {
	require_once MAINTAINIC_DIR . '/vendor/autoload.php';
	require_once MAINTAINIC_DIR . '/vendor/ernilambar/optioner/optioner.php';
}

new Bootstrap();
