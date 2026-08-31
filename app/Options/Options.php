<?php
/**
 * Options
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Options;

use Nilambar\Optiz\Manager;

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
		add_action( 'init', [ $this, 'register_plugin_options' ] );
	}

	/**
	 * Register plugin options.
	 *
	 * @since 1.0.0
	 */
	public function register_plugin_options(): void {
		Manager::register(
			'maintainic',
			[
				'option_key' => 'maintainic_options',
				'pages'      => [
					[
						'id'          => 'general',
						'title'       => esc_html__( 'Maintainic', 'maintainic' ),
						'menu_title'  => esc_html__( 'Maintainic', 'maintainic' ),
						'capability'  => 'manage_options',
						'menu_slug'   => 'maintainic',
						'parent_slug' => 'options-general.php',
						'tabs'        => [
							[
								'id'     => 'maintainic_settings',
								'label'  => esc_html__( 'Settings', 'maintainic' ),
								'fields' => [
									[
										'id'      => 'main_switch',
										'type'    => 'toggle',
										'label'   => esc_html__( 'Main Switch', 'maintainic' ),
										'default' => true,
									],
									[
										'id'      => 'site_title',
										'type'    => 'text',
										'label'   => esc_html__( 'Site Title', 'maintainic' ),
										'default' => esc_html__( 'Maintenance Mode', 'maintainic' ),
									],
									[
										'id'      => 'page_headline',
										'type'    => 'text',
										'label'   => esc_html__( 'Headline', 'maintainic' ),
										'default' => esc_html__( 'Website Under Maintenance', 'maintainic' ),
									],
									[
										'id'      => 'page_content',
										'type'    => 'textarea',
										'label'   => esc_html__( 'Description', 'maintainic' ),
										'default' => esc_html__( 'We are currently updating our website. Please visit us again shortly.', 'maintainic' ),
									],
									[
										'id'      => 'background_image',
										'type'    => 'image',
										'label'   => esc_html__( 'Background Image', 'maintainic' ),
										'default' => '',
									],
									[
										'id'      => 'background_color',
										'type'    => 'color',
										'label'   => esc_html__( 'Background Color', 'maintainic' ),
										'default' => '#f5f5f5',
									],
									[
										'id'      => 'text_color',
										'type'    => 'color',
										'label'   => esc_html__( 'Text Color', 'maintainic' ),
										'default' => '#333333',
									],
								],
							],
						],
					],
				],
			]
		);
	}
}
