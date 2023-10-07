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
	 */
	public function user_toolbar() {
		return $this->getValue( 'user_toolbar' );
	}
	public function to_top_button() {
		return $this->getValue( 'user_toolbar' );
	}
	public function page_loader() {
		return $this->getValue( 'page_loader' );
	}
	public function loader_text() {
		return $this->getValue( 'loader_text' );
	}
	public function loader_bg_color() {
		return $this->getValue( 'loader_bg_color' );
	}
	public function loader_text_color() {
		return $this->getValue( 'loader_text_color' );
	}

	/**
	 * Appearance options
	 */
	public function color_scheme() {
		return $this->getValue( 'color_scheme' );
	}
	public function font_scheme() {
		return $this->getValue( 'font_scheme' );
	}
}
