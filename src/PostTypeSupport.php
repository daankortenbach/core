<?php
/**
 * Add or remove post type support for given features.
 *
 * @package   SeoThemes\Core
 * @author    Lee Anthony <seothemeswp@gmail.com>
 * @author    Craig Simpson <craig@craigsimpson.scot>
 * @copyright 2018, D2 Themes
 * @license   GPL-3.0-or-later
 */

namespace SeoThemes\Core;

/**
 * Add or remove post type support for given features.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * use SeoThemes\Core\PostTypeSupport
 *
 * $core_post_type_support = [
 *     PostTypeSupport::ADD => [
 *        [
 *            PostTypeSupport::POST_TYPE => 'page',
 *            PostTypeSupport::SUPPORTS  => 'excerpt',
 *        ],
 *    ],
 * ];
 *
 * return [
 *     PostTypeSupport::class => $core_post_type_support,
 * ];
 * ```
 *
 * @package SeoThemes\Core
 */
class PostTypeSupport extends Component {

	const ADD       = 'add';
	const REMOVE    = 'remove';
	const POST_TYPE = 'post-type';
	const SUPPORTS  = 'supports';

	/**
	 * Initialize component.
	 *
	 * @since 0.1.1
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::ADD, $this->config ) ) {
			$this->add( $this->config[ self::ADD ] );
		}
		if ( array_key_exists( self::REMOVE, $this->config ) ) {
			$this->remove( $this->config[ self::REMOVE ] );
		}
	}

	/**
	 * Add post type support.
	 *
	 * @since 0.1.1
	 *
	 * @param array $config Features to enable.
	 *
	 * @return void
	 */
	protected function add( $config ) {
		foreach ( $config as $sub_config => $args ) {
			add_post_type_support( $args[ self::POST_TYPE ], $args[ self::SUPPORTS ] );
		}
	}

	/**
	 * Remove post type support.
	 *
	 * @since 0.1.1
	 *
	 * @param array $config Features to remove.
	 *
	 * @return void
	 */
	protected function remove( $config ) {
		foreach ( $config as $sub_config => $args ) {
			remove_post_type_support( $args[ self::POST_TYPE ], $args[ self::SUPPORTS ] );
		}
	}
}
