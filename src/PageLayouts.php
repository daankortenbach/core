<?php
/**
 * Register and unregister Genesis layouts through configuration.
 *
 * @package   SeoThemes\Core
 * @author    Lee Anthony <seothemeswp@gmail.com>
 * @copyright 2018, Lee Anthony
 * @license   GPL-3.0-or-later
 */

namespace SeoThemes\Core;

/**
 * Register and unregister Genesis layouts through configuration.
 *
 * Example config (usually located at config/defaults.php):
 *
 * ```
 * use SeoThemes\Core\GenesisLayout;
 *
 * $core_layouts = [
 *     GenesisLayout::REGISTER   => [
 *         'custom-layout', [
 *             'label' => 'Custom Layout',
 *             'img' => get_stylesheet_directory_uri() . '/img/layout.gif',
 *         ],
 *     ],
 *     GenesisLayout::UNREGISTER => [
 *         GenesisLayout::CONTENT_SIDEBAR_SIDEBAR,
 *         GenesisLayout::SIDEBAR_CONTENT_SIDEBAR,
 *         GenesisLayout::SIDEBAR_SIDEBAR_CONTENT,
 *     ],
 *     GenesisLayout::DEFAULT_LAYOUT => __genesis_return_full_width_content(),
 * ];
 *
 * return [
 *     GenesisLayout::class => $core_layouts,
 * ];
 * ```
 *
 * @package SeoThemes\Core
 */
class PageLayouts extends Component {

	const REGISTER = 'register';
	const UNREGISTER = 'unregister';
	const DEFAULT_LAYOUT = 'default-layout';
	const FULL_WIDTH_CONTENT = 'full-width-content';
	const CONTENT_SIDEBAR = 'content-sidebar';
	const SIDEBAR_CONTENT = 'sidebar-content';
	const CONTENT_SIDEBAR_SIDEBAR = 'content-sidebar-sidebar';
	const SIDEBAR_CONTENT_SIDEBAR = 'sidebar-content-sidebar';
	const SIDEBAR_SIDEBAR_CONTENT = 'sidebar-sidebar-content';

	/**
	 * Register and unregister Genesis layouts through configuration.
	 *
	 * @return void
	 */
	public function init() {
		if ( array_key_exists( self::REGISTER, $this->config ) ) {
			$this->register( $this->config[ self::REGISTER ] );
		}

		if ( array_key_exists( self::UNREGISTER, $this->config ) ) {
			$this->unregister( $this->config[ self::UNREGISTER ] );
		}

		if ( array_key_exists( self::DEFAULT_LAYOUT, $this->config ) ) {
			$this->set_default( $this->config[ self::DEFAULT_LAYOUT ] );
		}
	}

	/**
	 * Register Genesis page layouts.
	 *
	 * @since 1.0.0
	 *
	 * @param array $layouts Layouts to register.
	 *
	 * @return void
	 */
	protected function register( $layouts ) {
		array_walk( $layouts, function ( $args ) {
			\genesis_register_layout( $args['id'], $args );
		} );
	}

	/**
	 * Unregister Genesis page layouts.
	 *
	 * @since 1.0.0
	 *
	 * @param array $layouts Layouts to unregister.
	 *
	 * @return void
	 */
	protected function unregister( $layouts ) {
		array_map( 'genesis_unregister_layout', $layouts );
	}

	/**
	 * Set a default Genesis layout.
	 *
	 * Allow a user to identify a layout as being the default layout on a new
	 * install, as well as serve as the fallback layout.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout Layout handle.
	 *
	 * @return void
	 */
	protected function set_default( $layout ) {
		\genesis_set_default_layout( $layout );
	}
}
