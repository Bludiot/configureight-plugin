<?php
/**
 * Configure 8 theme settings
 *
 * @package    Configure 8 Settings
 * @subpackage Classes
 * @since      1.0.0
 */

class configureight extends Plugin {

	/**
	 * Plugin version
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $version = '1.0.0';

	/**
	 * Initialize plugin.
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
			'loader_bg_color'   => '',
			'loader_text_color' => '',
			'loader_text'       => '',
			'site_title'        => true,
			'site_slogan'       => true,
			'main_nav_pos'      => 'right',
			'max_nav_items'     => 0,
			'main_nav_loop'     => true,
			'main_nav_home'     => false,
			'header_search'     => true,
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
			'sidebar_sticky '   => false,
			'sidebar_search'    => false,
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

	public function adminHead() {

		$assets = '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . 'assets/css/style.css?version=' . $this->version . '">' . PHP_EOL;

		$assets .= '<script type="text/javascript" charset="utf-8" src="' . $this->domainPath() . 'assets/js/tabs.js?ver=' . $this->version . '"></script>' . PHP_EOL;

		return $assets;
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
		global $L, $plugin;

		$html  = '';
		ob_start();
		include( $this->phpPath() . '/views/form-page.php' );
		$html .= ob_get_clean_content();

		return $html;
	}

	/**
	 * General options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function user_toolbar() {
		return $this->getValue( 'user_toolbar' );
	}

	// @return boolean
	public function to_top_button() {
		return $this->getValue( 'user_toolbar' );
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

	// @return mixed Returns sidebar position or false.
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

	/**
	 * Footer options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
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
