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
			'page_loader' => false,
			'loader_text' => ''
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

	public function page_loader() {
		return $this->getValue( 'page_loader' );
	}

	public function loader_text() {
		return $this->getValue( 'loader_text' );
	}
}
