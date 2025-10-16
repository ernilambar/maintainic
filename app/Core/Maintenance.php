<?php
/**
 * Maintenance
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Core;

use Maintainic\Setup\Option;

/**
 * Maintenance class.
 *
 * @since 1.0.0
 */
class Maintenance {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'template_redirect', [ $this, 'maybe_show_maintenance_page' ] );
	}

	/**
	 * Check if maintenance mode should be shown.
	 *
	 * @since 1.0.0
	 */
	public function maybe_show_maintenance_page() {
		// Check if maintenance mode is enabled.
		if ( ! Option::get( 'main_switch' ) ) {
			return;
		}

		// Allow admin users to bypass maintenance mode.
		if ( $this->can_bypass_maintenance() ) {
			return;
		}

		// Show maintenance page.
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
		// Check if user is logged in and has admin capabilities.
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
		// Set proper HTTP status code.
		status_header( 503 );
		nocache_headers();

		// Get template file.
		$template_file = MAINTAINIC_DIR . '/templates/maintenance-page.php';

		// Include template file.
		include $template_file;

		exit;
	}
}
