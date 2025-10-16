<?php
/**
 * Options
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Options;

use Maintainic\Setup\Option;
use Nilambar\Optioner\Optioner;

/**
 * Options class.
 *
 * @since 1.0.0
 */
class Options {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'optioner_admin_init', [ $this, 'register_plugin_options' ] );
	}

	/**
	 * Register plugin options.
	 *
	 * @since 1.0.0
	 */
	public function register_plugin_options() {
		$obj = new Optioner();

		$obj->set_page(
			[
				'page_title'     => esc_html__( 'Maintainic', 'maintainic' ),
				'menu_title'     => esc_html__( 'Maintainic', 'maintainic' ),
				'capability'     => 'manage_options',
				'menu_slug'      => 'maintainic',
				'option_slug'    => 'maintainic_options',
				'top_level_menu' => false,
			]
		);

		// Tab: maintainic_settings.
		$obj->add_tab(
			[
				'id'    => 'maintainic_settings',
				'title' => esc_html__( 'Settings', 'maintainic' ),
			]
		);

		// Field: main_switch.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'main_switch',
				'type'    => 'toggle',
				'title'   => esc_html__( 'Main Switch', 'maintainic' ),
				'default' => Option::defaults( 'main_switch' ),
			]
		);

		// Field: site_title.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'site_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Site Title', 'maintainic' ),
				'default' => Option::defaults( 'site_title' ),
			]
		);

		// Field: page_headline.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'page_headline',
				'type'    => 'text',
				'title'   => esc_html__( 'Headline', 'maintainic' ),
				'default' => Option::defaults( 'page_headline' ),
			]
		);

		// Field: page_content.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'page_content',
				'type'    => 'textarea',
				'title'   => esc_html__( 'Description', 'maintainic' ),
				'default' => Option::defaults( 'page_content' ),
			]
		);

		// Field: background_image.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'background_image',
				'type'    => 'image',
				'title'   => esc_html__( 'Background Image', 'maintainic' ),
				'default' => Option::defaults( 'background_image' ),
			]
		);

		// Field: background_color.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'background_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Background Color', 'maintainic' ),
				'default' => Option::defaults( 'background_color' ),
			]
		);

		// Field: text_color.
		$obj->add_field(
			'maintainic_settings',
			[
				'id'      => 'text_color',
				'type'    => 'color',
				'title'   => esc_html__( 'Text Color', 'maintainic' ),
				'default' => Option::defaults( 'text_color' ),
			]
		);

		$obj->run();
	}
}
