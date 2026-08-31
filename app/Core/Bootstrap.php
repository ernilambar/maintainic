<?php
/**
 * Bootstrap
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Core;

use Maintainic\Options\Options;
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

		new Options();
		new Maintenance();
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
}
