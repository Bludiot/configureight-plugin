<?php
/**
 * Configure 8 theme settings
 *
 * @package    Configure 8 Settings
 * @subpackage Theme Plugins
 * @since      1.0.0
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( $L->get( 'direct-access' ) );
}

class configureight extends Plugin {

	/**
	 * Initialize plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function init() {

		$this->dbFields = [
			'user_toolbar'      => true,
			'to_top_button'     => true,
			'page_loader'       => false,
			'loader_bg_color'   => $this->loader_bg_default(),
			'loader_text_color' => $this->loader_text_default(),
			'loader_text'       => '',
			'site_title'        => true,
			'site_slogan'       => true,
			'main_nav_pos'      => 'right',
			'max_nav_items'     => 0,
			'main_nav_loop'     => true,
			'main_nav_home'     => false,
			'header_search'     => true,
			'header_social'     => false,
			'site_favicon'      => '',
			'cover_bg_color'    => $this->cover_bg_default(),
			'cover_text_color'  => $this->cover_text_default(),
			'cover_text_shadow' => true,
			'cover_icon'        => 'angle-down-light',
			'loop_style'        => 'blog',
			'content_style'     => 'list',
			'sidebar_in_loop'   => 'side',
			'loop_paged'        => 'numerical',
			'loop_byline'       => true,
			'loop_date'         => true,
			'loop_word_count'   => true,
			'loop_read_time'    => true,
			'loop_icons'        => true,
			'sidebar_position'  => 'default',
			'sidebar_display'   => 'default',
			'sidebar_sticky'    => false,
			'sidebar_search'    => 'hide',
			'sidebar_social'    => false,
			'sb_social_heading' => '',
			'footer_social'     => true,
			'copyright'         => true,
			'copy_date'         => true,
			'copy_text'         => '',
			'color_scheme'      => 'default',
			'font_scheme'       => 'default'
		];

		if ( ! $this->installed() ) {
			$Tmp = new dbJSON( $this->filenameDb );
			$this->db = $Tmp->db;
			$this->prepare();
		}
	}

	/**
	 * Load scripts & styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function adminHead() {

		// Maybe get non-minified assets.
		$suffix = '';
		if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
			$suffix = '.min';
		}

		$assets = '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/style{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/dropzone.min.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/color-picker{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/tabs{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/dropzone.min.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/color-picker{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		return $assets;
	}

	/**
	 * Sidebar link
	 *
	 * Link to the options screen in the admin sidebar menu.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @return string
	 */
	public function adminSidebar() {

		global $L;

		$name = strtolower( __CLASS__ );
		$url  = HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $name;
		$html = sprintf(
			'<a class="nav-link" href="%s"><span class="fa fa-gear theme-options-icon"></span>%s</a>',
			$url,
			$L->get( 'Theme Options' )
		);
		return $html;
	}

	/**
	 * Admin settings form
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @return string Returns the markup of the form.
	 */
	public function form() {

		// Access global variables.
		global $L, $plugin, $site;

		$html  = '';
		ob_start();
		include( $this->phpPath() . '/views/form-page.php' );
		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * General options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function show_user_toolbar() {
		return $this->getValue( 'user_toolbar' );
	}

	// @return boolean
	public function to_top_button() {
		return (bool) $this->getValue( 'to_top_button' );
	}

	// @return boolean
	public function page_loader() {
		return $this->getValue( 'page_loader' );
	}

	// @return string
	public function loader_text() {
		return $this->getValue( 'loader_text' );
	}

	// @return string
	public function loader_bg_color() {
		return $this->getValue( 'loader_bg_color' );
	}

	// @return string
	public function loader_text_color() {
		return $this->getValue( 'loader_text_color' );
	}

	// @return string
	public function loader_bg_default() {
		return '#ffffff';
	}

	// @return string
	public function loader_text_default() {
		return '#333333';
	}

	/**
	 * Header options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function site_title() {
		return $this->getValue( 'site_title' );
	}

	// @return boolean
	public function site_slogan() {
		return $this->getValue( 'site_slogan' );
	}

	// @return string
	public function main_nav_pos() {
		return $this->getValue( 'main_nav_pos' );
	}

	// @return integer
	public function max_nav_items() {
		return $this->getValue( 'max_nav_items' );
	}

	// @return boolean
	public function main_nav_loop() {
		return $this->getValue( 'main_nav_loop' );
	}

	// @return boolean
	public function main_nav_home() {
		return $this->getValue( 'main_nav_home' );
	}

	// @return boolean
	public function header_search() {
		return $this->getValue( 'header_search' );
	}

	// @return boolean
	public function header_social() {
		return $this->getValue( 'header_social' );
	}

	/**
	 * Media options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return string
	public function site_favicon() {
		return $this->getValue( 'site_favicon' );
	}

	// @return string
	public function cover_bg_color() {
		return $this->getValue( 'cover_bg_color' );
	}

	// @return string
	public function cover_text_color() {
		return $this->getValue( 'cover_text_color' );
	}

	// @return string
	public function cover_text_shadow() {
		return $this->getValue( 'cover_text_shadow' );
	}

	// @return string
	public function cover_bg_default() {
		return 'rgba( 0, 0, 0, 0.625 )';
	}

	// @return string
	public function cover_text_default() {
		return '#ffffff';
	}

	// @return string
	public function cover_icon() {
		return $this->getValue( 'cover_icon' );
	}

	/**
	 * Posts loop options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return string
	public function loop_style() {
		return $this->getValue( 'loop_style' );
	}

	// @return string
	public function content_style() {
		return $this->getValue( 'content_style' );
	}

	// @return string
	public function sidebar_in_loop() {
		return $this->getValue( 'sidebar_in_loop' );
	}

	// @return string
	public function loop_paged() {
		return $this->getValue( 'loop_paged' );
	}

	// @return boolean
	public function loop_byline() {
		return $this->getValue( 'loop_byline' );
	}

	// @return boolean
	public function loop_date() {
		return $this->getValue( 'loop_date' );
	}

	// @return boolean
	public function loop_word_count() {
		return $this->getValue( 'loop_word_count' );
	}

	// @return boolean
	public function loop_read_time() {
		return $this->getValue( 'loop_read_time' );
	}

	// @return boolean
	public function loop_icons() {
		return $this->getValue( 'loop_icons' );
	}

	/**
	 * Sidebar options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	 // @return boolean
	public function sidebar_sticky() {
		return $this->getValue( 'sidebar_sticky' );
	}

	// @return mixed Returns string `default` or false.
	public function sidebar_display() {
		return $this->getValue( 'sidebar_display' );
	}

	// @return string
	public function sidebar_position() {
		return $this->getValue( 'sidebar_position' );
	}

	// @return boolean
	public function sidebar_search() {
		return $this->getValue( 'sidebar_search' );
	}

	// @return boolean
	public function sidebar_social() {
		return $this->getValue( 'sidebar_social' );
	}

	// @return boolean
	public function sb_social_heading() {
		return $this->getValue( 'sb_social_heading' );
	}

	/**
	 * Footer options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function footer_social() {
		return $this->getValue( 'footer_social' );
	}

	public function copyright() {
		return $this->getValue( 'copyright' );
	}

	// @return boolean
	public function copy_date() {
		return $this->getValue( 'copy_date' );
	}

	// @return boolean
	public function copy_text() {
		return $this->getValue( 'copy_text' );
	}

	/**
	 * Appearance options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return string
	public function color_scheme() {
		return $this->getValue( 'color_scheme' );
	}

	// @return string
	public function font_scheme() {
		return $this->getValue( 'font_scheme' );
	}
}
