<?php
/**
 * Plugin Name: Maintainic
 * Plugin URI: https://github.com/ernilambar/maintainic
 * Description: Simple maintenance plugin.
 * Version: 1.0.2
 * Requires at least: 6.6
 * Requires PHP: 8.0
 * Author: Nilambar Sharma
 * Author URI: https://nilambar.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: maintainic
 * Domain Path: /languages
 *
 * @package Maintainic
 */

use Maintainic\Core\Bootstrap;
use Nilambar\Gitvise\Updater;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MAINTAINIC_VERSION', '1.0.2' );
define( 'MAINTAINIC_BASENAME', basename( __DIR__ ) );
define( 'MAINTAINIC_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'MAINTAINIC_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'MAINTAINIC_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

// Include autoload.
if ( file_exists( MAINTAINIC_DIR . '/vendor/autoload.php' ) ) {
	require_once MAINTAINIC_DIR . '/vendor/autoload.php';
	require_once MAINTAINIC_DIR . '/vendor/ernilambar/optiz/init.php';
	require_once MAINTAINIC_DIR . '/vendor/ernilambar/gitvise/init.php';
}

new Bootstrap();

$updater = new Updater( 'ernilambar/maintainic', __FILE__ );
$updater->init();
