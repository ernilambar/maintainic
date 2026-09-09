<?php
/**
 * Bootstrap
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Core;

use Maintainic\Options\Options;
use Maintainic\Setup\Option;
use Nilambar\Optiz\Manager;

/**
 * Bootstrap class.
 *
 * @since 1.0.0
 */
class Bootstrap {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_filter( 'plugin_action_links_' . MAINTAINIC_BASE_FILENAME, [ $this, 'customize_action_links' ] );
		add_action( 'template_redirect', [ $this, 'maybe_show_maintenance_page' ] );

		new Options();
	}

	/**
	 * Customize plugin action links.
	 *
	 * @since 1.0.0
	 *
	 * @param array $actions Action links.
	 * @return array Modified action links.
	 */
	public function customize_action_links( $actions ) {
		$url = Manager::instance( 'maintainic' )->get_page_url( 'general' );

		$actions = [ 'settings' => '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'maintainic' ) . '</a>' ] + $actions;

		return $actions;
	}

	/**
	 * Check if maintenance mode should be shown.
	 *
	 * @since 1.0.0
	 */
	public function maybe_show_maintenance_page() {
		if ( ! Option::get( 'main_switch' ) ) {
			return;
		}

		if ( $this->can_bypass_maintenance() ) {
			return;
		}

		$this->show_maintenance_page();
	}

	/**
	 * Check if current user can bypass maintenance mode.
	 *
	 * @since 1.0.0
	 *
	 * @return bool True if can bypass, false otherwise.
	 */
	private function can_bypass_maintenance(): bool {
		if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Display maintenance page.
	 *
	 * @since 1.0.0
	 */
	private function show_maintenance_page() {
		status_header( 503 );
		nocache_headers();

		$template_file = MAINTAINIC_DIR . '/templates/maintenance-page.php';

		include $template_file;

		exit;
	}
}
