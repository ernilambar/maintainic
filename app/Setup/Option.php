<?php
/**
 * Option
 *
 * @package Maintainic
 */

declare(strict_types=1);

namespace Maintainic\Setup;

use Nilambar\Optiz\Manager;

/**
 * Option class.
 *
 * @since 1.0.0
 */
class Option {

	/**
	 * Return plugin option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	public static function get( string $key ) {
		return Manager::instance( 'maintainic' )->get( $key );
	}
}
