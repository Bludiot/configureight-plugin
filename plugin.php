<?php
/**
 * Configure 8 theme options plugin
 *
 * @package    Configure 8 Options
 * @subpackage Theme Plugins
 * @since      1.0.0
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

// Access namespaced functions.
use function CFE_Plugin\{
	is_rtl,
	title_tag,
	options_list,
	search_form,
	static_list,
	categories_list,
	tags_list,
	error_search_display,
	error_static_display,
	error_cats_display,
	error_tags_display,
	change_theme,
	default_theme,
	admin_theme
};
use function CFE_Colors\{
	define_color_scheme,
	default_color_scheme
};

class configureight extends Plugin {

	/**
	 * Prepare plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function prepare() {

		// Get plugin functions.
		require_once( $this->phpPath() . '/includes/functions.php' );
		require_once( $this->phpPath() . '/includes/fonts.php' );
		require_once( $this->phpPath() . '/includes/colors.php' );
	}

	/**
	 * Initialize plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L The Language class.
	 * @return void
	 */
	public function init() {

		// Access global variables.
		global $L;

		$this->dbFields = [
			'user_toolbar'          => 'enabled',
			'show_options'          => false,
			'to_top_button'         => true,
			'page_loader'           => false,
			'loader_bg_color'       => $this->loader_bg_default(),
			'loader_text_color'     => $this->loader_text_default(),
			'loader_text'           => $L->get( 'Loading&hellip;' ),
			'site_title'            => true,
			'site_slogan'           => true,
			'logo_width_std'        => $this->logo_width_std_default(),
			'logo_width_mob'        => $this->logo_width_mob_default(),
			'logo_location'         => 'before',
			'header_sticky'         => false,
			'main_nav_pos'          => 'right',
			'main_nav_icon'         => 'bars',
			'max_nav_items'         => 0,
			'main_nav_loop'         => 'after',
			'main_nav_loop_label'   => '',
			'main_nav_home'         => false,
			'header_search'         => true,
			'header_social'         => false,
			'site_favicon'          => '',
			'modal_bg_color'        => $this->modal_bg_default(),
			'default_cover'         => '',
			'cover_style'           => 'overlay',
			'cover_blend'           => $this->cover_blend_default(),
			'cover_blend_use'       => [ 'covers' ],
			'cover_overlay'         => $this->cover_overlay_default(),
			'cover_text_color'      => $this->cover_text_default(),
			'cover_text_shadow'     => true,
			'cover_icon'            => 'angle-down-light',
			'thumb_width'           => $this->thumb_width_default(),
			'thumb_height'          => $this->thumb_height_default(),
			'thumb_quality'         => $this->thumb_quality_default(),
			'loop_title'            => $L->get( 'Blog' ),
			'loop_description'      => '',
			'loop_type'             => 'blog',
			'loop_style'            => 'list',
			'cat_style'             => 'list',
			'tag_style'             => 'list',
			'loop_paged'            => 'numerical',
			'loop_byline'           => true,
			'loop_date'             => true,
			'loop_word_count'       => true,
			'loop_read_time'        => true,
			'loop_icons'            => true,
			'posts_nav'             => true,
			'posts_nav_type'        => 'buttons',
			'posts_nav_icon'        => 'arrow',
			'related_posts'         => true,
			'max_related'           => $this->max_related_default(),
			'related_heading'       => '',
			'related_heading_el'    => 'h3',
			'related_style'         => 'list',
			'error_widgets'         => 'content',
			'error_search'          => true,
			'error_static'          => true,
			'error_cats'            => true,
			'error_tags'            => true,
			'error_search_label'    => $L->get( 'Search' ),
			'error_static_title'    => $L->get( 'Pages' ),
			'error_cats_title'      => $L->get( 'Categories' ),
			'error_tags_title'      => $L->get( 'Post Tags' ),
			'error_search_heading'  => 'h2',
			'error_static_heading'  => 'h2',
			'error_cats_heading'    => 'h2',
			'error_tags_heading'    => 'h2',
			'error_search_holder'   => $L->get( 'Search' ),
			'error_search_btn'      => true,
			'error_search_btn_text' => $L->get( 'Submit' ),
			'error_static_dir'      => 'horz',
			'error_cats_dir'        => 'horz',
			'error_tags_dir'        => 'horz',
			'sidebar_in_page'       => 'side',
			'sidebar_in_loop'       => 'side',
			'sidebar_position'      => 'right',
			'sidebar_sticky'        => false,
			'sidebar_social'        => false,
			'sb_social_heading'     => '',
			'admin_menu'            => true,
			'footer_search'         => false,
			'footer_social'         => true,
			'ftr_social_heading'    => '',
			'copyright'             => true,
			'copy_date'             => true,
			'copy_text'             => '',
			'horz_spacing'          => '2',
			'vert_spacing'          => '2',
			'color_scheme'          => 'default',
			'color_body'            => '#ffffff',
			'color_body_dark'       => '#1e1e1e',
			'color_text'            => '#333333',
			'color_text_dark'       => '#eeeeee',
			'color_one'             => '#0044aa',
			'color_two'             => '#0066cc',
			'color_three'           => '#333333',
			'color_four'            => '#555555',
			'color_five'            => '#888888',
			'color_six'             => '#cccccc',
			'color_one_dark'        => '#ffffff',
			'color_two_dark'        => '#eeeeee',
			'color_three_dark'      => '#333333',
			'color_four_dark'       => '#555555',
			'color_five_dark'       => '#888888',
			'color_six_dark'        => '#cccccc',
			'font_scheme'           => 'default',
			'admin_theme'           => 'css',
			'custom_css'            => '',
			'admin_css'             => '',
			'title_sep'             => '|',
			'custom_sep'            => '',
			'default_ttag'          => '',
			'loop_ttag'             => '',
			'post_ttag'             => '',
			'page_ttag'             => '',
			'cat_ttag'              => '',
			'tag_ttag'              => '',
			'search_ttag'           => '',
			'error_ttag'            => '',
			'default_ttag_rtl'      => '',
			'loop_ttag_rtl'         => '',
			'post_ttag_rtl'         => '',
			'page_ttag_rtl'         => '',
			'cat_ttag_rtl'          => '',
			'tag_ttag_rtl'          => '',
			'search_ttag_rtl'       => '',
			'error_ttag_rtl'        => ''
		];

		// Array of custom hooks.
		$this->customHooks = [
			'meta_tags',
			'color_scheme_vars',
			'url_not_found',
			'front_page',
			'comment_form'
		];

		if ( ! $this->installed() ) {
			$Tmp = new dbJSON( $this->filenameDb );
			$this->db = $Tmp->db;
			$this->prepare();
		}
	}

	/**
	 * Install plugin
	 *
	 * Essentially the same as the parent method
	 * except that it allows for array field values.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  integer $position
	 * @return boolean Return true if the installation is successful.
	 */
	public function install( $position = 1 ) {

		if ( $this->installed() ) {
			return false;
		}

		// Create workspace.
		$workspace = $this->workspace();
		mkdir( $workspace, DIR_PERMISSIONS, true );

		// Create plugin directory for the database
		mkdir( PATH_PLUGINS_DATABASES . $this->directoryName, DIR_PERMISSIONS, true );

		$this->dbFields['position'] = $position;

		// Sanitize default values to store in the file.
		foreach ( $this->dbFields as $key => $value ) {

			if ( ! is_array( $value ) ) {
				$value = Sanitize :: html( $value );
			}
			settype( $value, gettype( $this->dbFields[$key] ) );
			$this->db[$key] = $value;
		}

		// Create the database.
		return $this->save();
	}

	/**
	 * Form post
	 *
	 * The form `$_POST` method.
	 *
	 * Essentially the same as the parent method
	 * except that it allows for array field values.
	 *
	 * This was implemented to handle multi-checkbox
	 * and radio button fields. If strings are used
	 * in an array option then be sure to sanitize
	 * the string values.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function post() {

		$args = $_POST;

		foreach ( $this->dbFields as $field => $value ) {

			if ( isset( $args[$field] ) ) {

				// @todo Look into sanitizing array values.
				if ( is_array( $args[$field] ) ) {
					$final_value = $args[$field];
				} else {
					$final_value = Sanitize :: html( $args[$field] );
				}

				if ( $final_value === 'false' ) {
					$final_value = false;
				} elseif ( $final_value === 'true' ) {
					$final_value = true;
				}

				settype( $final_value, gettype( $value ) );
				$this->db[$field] = $final_value;
			}
		}
		return $this->save();
	}

	/**
	 * Load login scripts & styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function loginHead() {

		// Access global variables.
		global $site, $url;

		// Maybe get non-minified assets.
		$suffix = '';
		if ( ! $this->debug_mode() ) {
			$suffix = '.min';
		}
		$assets = '';

		if ( 'css' == $this->admin_theme() && 'configureight' != $site->adminTheme() ) {
			$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/login{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;
		}
		return $assets;
	}

	/**
	 * Admin style block
	 *
	 * Prints custom admin CSS in the admin head.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns a CSS style block or null.
	 */
	public function admin_style_block() {

		$style  = '<style>';
		$style .= $this->admin_css();
		$style .= '</style>';

		return $style;
	}

	/**
	 * Load scripts & styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function adminHead() {

		// Access global variables.
		global $site, $url;

		if ( 'configureight' != $site->theme() ) {
			return;
		}

		// Maybe get non-minified assets.
		$suffix = '';
		if ( ! $this->debug_mode() ) {
			$suffix = '.min';
		}
		$assets = '';

		// Load only for this plugin's settings page.
		if ( str_contains( $url->slug(), $this->className() ) ) :

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/dropzone.min.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/color-picker{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/tabs{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/color-picker{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/fields{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		// End plugin page.
		endif;

		if ( 'css' == $this->admin_theme() && 'configureight' != $site->adminTheme() ) {
			$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/style{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;
		} elseif ( 'default' == $this->admin_theme() ) {
			$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/default{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;
		}

		// Custom admin CSS for default the with theme styles.
		if ( ! empty( $this->admin_css() ) && 'css' == $this->admin_theme() ) {
			$assets .= $this->admin_style_block();
		}

		// Style block for settings screen.
		if ( str_contains( $url->slug(), 'settings' ) ) :
		$assets .= '<style>';
		$assets .= '#seo.tab-pane h2:not( :first-of-type ) { display: none !important; }';
		$assets .= '#seo.tab-pane div:not( :first-of-type ) { display: none !important; }';
		$assets .= '#nav-images-tab.nav-item { display: none !important; }';
		$assets .= '#images.tab-pane { display: none !important; }';
		$assets .= '#nav-logo-tab.nav-item { display: none !important; }';
		$assets .= '#logo.tab-pane { display: none !important; }';
		$assets .= '</style>';
		endif;

		return $assets;
	}

	/**
	 * Admin body begin
	 *
	 * Conditionally prints a modal window notice
	 * on the Themes admin screen,
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function adminBodyBegin() {

		// Access global variables.
		global $L, $url;

		// Admin theme notice.
		if ( 'themes' == $url->slug() && 'theme' == $this->admin_theme() ) {
			include( $this->phpPath() . '/views/notice-admin-theme.php' );
		}
	}

	/**
	 * Sidebar link
	 *
	 * Link to the options screen in the admin sidebar menu.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @return mixed
	 */
	public function adminSidebar() {

		// Access global variables.
		global $L, $site;

		// Configure 8 admin theme has the options link.
		if ( 'configureight' === $site->adminTheme() ) {
			return;
		}

		$name = strtolower( __CLASS__ );

		// Theme plugin path is different in Bludit version 4.0.
		$path = 'configure-plugin/';
		if ( BLUDIT_VERSION >= 4 ) {
			$path = 'plugin-settings/';
		}
		$url  = HTML_PATH_ADMIN_ROOT . $path . $name;
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
	 * @global object $plugin Plugin class.
	 * @global object $site Site class.
	 * @return string Returns the markup of the form.
	 */
	public function form() {

		// Access global variables.
		global $L, $plugin, $site;

		$html  = '';
		ob_start();
		include( $this->phpPath() . '/views/page-form.php' );
		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Admin info page
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @global object $site Site class.
	 * @return string Returns the markup of the page.
	 */
	public function adminView() {

		// Access global variables.
		global $L, $site;

		$html  = '';
		ob_start();
		if ( isset( $_GET['page'] ) && 'database' == $_GET['page'] ) {
			include( $this->phpPath() . '/views/page-database.php' );
		} else {
			include( $this->phpPath() . '/views/page-guide.php' );
		}
		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Dashboard hook
	 *
	 * Uses the core hook to add content to the dashboard.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dashboard() {

		// Show options on dashboard if enabled.
		if ( $this->show_options() ) {
			echo options_list();
		}
	}

	/**
	 * Meta tags hook
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function meta_tags() {

		$html  = '';
		$html .= title_tag();

		return $html;
	}

	/**
	 * Color scheme variables hook
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function color_scheme_vars() {
		echo define_color_scheme();
	}

	/**
	 * URL not found hook
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $site The Site class.
	 * @return mixed Returns the widgets markup or null.
	 */
	public function url_not_found() {

		// Access global variables.
		global $site;

		/**
		 * Stop if no error page is set or error widgets
		 * are disabled (content only).
		 */
		if ( ! $site->pageNotFound() || 'content' == $this->error_widgets() ) {
			return null;
		}

		// Widgets markup.
		$html = '';

		// Search form.
		if (
			getPlugin( 'Search_Forms' ) &&
			$this->error_search() &&
			is_array( error_search_display() )
		) {
			$html .= SearchForms\form( error_search_display() );
		}

		// Static pages list.
		if ( is_array( error_static_display() ) && $this->error_static() ) {
			$html .= static_list( error_static_display() );
		}

		// Categories list.
		if ( is_array( error_cats_display() ) && $this->error_cats() ) {
			$html .= categories_list( error_cats_display() );
		}

		// Tags list.
		if ( is_array( error_tags_display() ) && $this->error_tags() ) {
			$html .= tags_list( error_tags_display() );
		}
		return $html;
	}

	/**
	 * Edit settings
	 *
	 * Database settings for thumbnail images.
	 * Hacky but working.
	 *
	 * @since  1.0.0
	 * @global object $site The Site class.
	 * @return function editSettings()
	 */
	public function edit_settings() {

		// Access global variables.
		global $site;

		$args['homepage']     = $site->homepage();
		$args['uriBlog']      = $site->getField( 'uriBlog' );
		$args['pageNotFound'] = $site->pageNotFound();

		$args['thumbnailWidth']   = $this->getValue( 'thumb_width' );
		$args['thumbnailHeight']  = $this->getValue( 'thumb_height' );
		$args['thumbnailQuality'] = $this->getValue( 'thumb_quality' );

		// Return modified array.
		return editSettings( $args );
	}

	/**
	 * Save options
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function save() {

		$this->edit_settings();

		// Switch admin theme on save.
		if ( admin_theme() && 'theme' == $this->admin_theme() ) {
			change_theme();
		} else {
			default_theme();
		}

		// Save options to plugin JSON database.
		$tmp     = new dbJSON( $this->filenameDb );
		$tmp->db = $this->db;
		return $tmp->save();
	}

	/**
	 * Uninstall
	 *
	 * Return null to prevent database resetting
	 * when theme is deactivated and plugin is
	 * automatically uninstalled.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function uninstall() {
		return null;
	}

	/**
	 * Debug mode
	 *
	 * Checks if the site is in debug mode.
	 *
	 * @since  1.0.0
	 * @return boolean Returns true if in debug mode.
	 */
	public function debug_mode() {

		if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
			return true;
		}
		return false;
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
	public function show_options() {
		return $this->getValue( 'show_options' );
	}

	// @return boolean
	public function to_top_button() {
		return (bool) $this->getValue( 'to_top_button' );
	}

	// @return boolean
	public function page_loader() {

		if ( $this->debug_mode() ) {
			return false;
		}
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

	// @return integer
	public function logo_width_std() {
		return $this->getValue( 'logo_width_std' );
	}

	// @return integer
	public function logo_width_mob() {
		return $this->getValue( 'logo_width_mob' );
	}

	// @return integer
	public function logo_width_std_default() {
		return 60;
	}

	// @return integer
	public function logo_width_mob_default() {
		return 80;
	}

	// @return string
	public function logo_location() {
		return $this->getValue( 'logo_location' );
	}

	// @return boolean
	public function header_sticky() {
		return $this->getValue( 'header_sticky' );
	}

	// @return string
	public function main_nav_pos() {
		return $this->getValue( 'main_nav_pos' );
	}

	// @return string
	public function main_nav_icon() {
		return $this->getValue( 'main_nav_icon' );
	}

	// @return integer
	public function max_nav_items() {
		return $this->getValue( 'max_nav_items' );
	}

	// @return string
	public function main_nav_loop() {
		return $this->getValue( 'main_nav_loop' );
	}

	// @return string
	public function main_nav_loop_label() {
		return $this->getValue( 'main_nav_loop_label' );
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
	public function modal_bg_color() {
		return $this->getValue( 'modal_bg_color' );
	}

	// @return string
	public function modal_bg_default() {
		return 'rgba( 0, 0, 0, 0.625 )';
	}

	// @return string
	public function default_cover() {
		return $this->getValue( 'default_cover' );
	}

	// @return string
	public function cover_style() {
		return $this->getValue( 'cover_style' );
	}

	// @return string
	public function cover_blend() {
		return $this->getValue( 'cover_blend' );
	}

	// @return array
	public function cover_blend_use() {
		return $this->getValue( 'cover_blend_use' );
	}

	// @return string
	public function cover_overlay() {
		return $this->getValue( 'cover_overlay' );
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
	public function cover_blend_default() {
		return '#3e6caf';
	}

	// @return string
	public function cover_overlay_default() {
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

	// @return string
	public function thumb_width_default() {
		return '480';
	}

	// @return string
	public function thumb_height_default() {
		return '360';
	}

	// @return string
	public function thumb_quality_default() {
		return '100';
	}

	/**
	 * @global $site
	 * @return string
	 */
	public function thumb_width() {

		// Access global variables.
		global $site;

		$width = $this->getValue( 'thumb_width' );
		if ( empty( $site->thumbnailWidth() ) ) {
			$width = $this->thumb_width_default();
		} elseif ( $site->thumbnailWidth() != $this->getValue( 'thumb_width' ) ) {
			$width = $site->thumbnailWidth();
		}
		return $width;
	}

	/**
	 * @global $site
	 * @return string
	 */
	public function thumb_height() {

		// Access global variables.
		global $site;

		$height = $this->getValue( 'thumb_height' );
		if ( empty( $site->thumbnailHeight() ) ) {
			$height = $this->thumb_height_default();
		} elseif ( $site->thumbnailHeight() != $this->getValue( 'thumb_height' ) ) {
			$height = $site->thumbnailHeight();
		}
		return $height;
	}

	/**
	 * @global $site
	 * @return string
	 */
	public function thumb_quality() {

		// Access global variables.
		global $site;

		$quality = $this->getValue( 'thumb_quality' );
		if ( empty( $site->thumbnailQuality() ) ) {
			$quality = $this->thumb_quality_default();
		} elseif ( $site->thumbnailQuality() != $this->getValue( 'thumb_quality' ) ) {
			$quality = $site->thumbnailQuality();
		}
		return $quality;
	}

	/**
	 * Posts loop options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return string
	public function loop_title() {
		return $this->getValue( 'loop_title' );
	}

	// @return string
	public function loop_description() {
		return $this->getValue( 'loop_description' );
	}

	// @return string
	public function loop_type() {
		return $this->getValue( 'loop_type' );
	}

	// @return string
	public function loop_style() {
		return $this->getValue( 'loop_style' );
	}

	// @return string
	public function cat_style() {

		if ( 'inherit' == $this->getValue( 'cat_style' ) ) {
			return $this->getValue( 'loop_style' );
		}
		return $this->getValue( 'cat_style' );
	}

	// @return string
	public function tag_style() {

		if ( 'inherit' == $this->getValue( 'tag_style' ) ) {
			return $this->getValue( 'loop_style' );
		}
		return $this->getValue( 'tag_style' );
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
	 * Page options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function posts_nav() {
		return $this->getValue( 'posts_nav' );
	}

	// @return string
	public function posts_nav_type() {
		return $this->getValue( 'posts_nav_type' );
	}

	// @return string
	public function posts_nav_icon() {
		return $this->getValue( 'posts_nav_icon' );
	}

	// @return boolean
	public function related_posts() {
		return $this->getValue( 'related_posts' );
	}

	// @return integer
	public function max_related_default() {
		return 3;
	}

	// @return integer
	public function max_related() {
		return $this->getValue( 'max_related' );
	}

	// @return string
	public function related_heading() {
		return $this->getValue( 'related_heading' );
	}

	// @return string
	public function related_heading_el() {
		return $this->getValue( 'related_heading_el' );
	}

	// @return string
	public function related_style() {
		return $this->getValue( 'related_style' );
	}

	// @return string
	public function error_widgets() {
		return $this->getValue( 'error_widgets' );
	}

	// @return boolean
	public function error_search() {
		return $this->getValue( 'error_search' );
	}

	// @return boolean
	public function error_static() {
		return $this->getValue( 'error_static' );
	}

	// @return boolean
	public function error_cats() {
		return $this->getValue( 'error_cats' );
	}

	// @return boolean
	public function error_tags() {
		return $this->getValue( 'error_tags' );
	}

	// @return string
	public function error_search_label() {
		return $this->getValue( 'error_search_label' );
	}

	// @return string
	public function error_static_title() {
		return $this->getValue( 'error_static_title' );
	}

	// @return string
	public function error_cats_title() {
		return $this->getValue( 'error_cats_title' );
	}

	// @return string
	public function error_tags_title() {
		return $this->getValue( 'error_tags_title' );
	}

	// @return string
	public function error_search_heading() {
		return $this->getValue( 'error_search_heading' );
	}

	// @return string
	public function error_static_heading() {
		return $this->getValue( 'error_static_heading' );
	}

	// @return string
	public function error_cats_heading() {
		return $this->getValue( 'error_cats_heading' );
	}

	// @return string
	public function error_tags_heading() {
		return $this->getValue( 'error_tags_heading' );
	}

	// @return string
	public function error_search_holder() {
		return $this->getValue( 'error_search_holder' );
	}

	// @return boolean
	public function error_search_btn() {
		return $this->getValue( 'error_search_btn' );
	}

	// @return string
	public function error_search_btn_text() {
		return $this->getValue( 'error_search_btn_text' );
	}

	// @return string
	public function error_static_dir() {
		return $this->getValue( 'error_static_dir' );
	}

	// @return string
	public function error_cats_dir() {
		return $this->getValue( 'error_cats_dir' );
	}

	// @return string
	public function error_tags_dir() {
		return $this->getValue( 'error_tags_dir' );
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

	// @return string
	public function sidebar_in_page() {
		return $this->getValue( 'sidebar_in_page' );
	}

	// @return string
	public function sidebar_in_loop() {
		return $this->getValue( 'sidebar_in_loop' );
	}

	// @return string
	public function sidebar_position() {
		return $this->getValue( 'sidebar_position' );
	}

	// @return boolean
	public function sidebar_social() {
		return $this->getValue( 'sidebar_social' );
	}

	// @return boolean
	public function sb_social_heading() {
		return $this->getValue( 'sb_social_heading' );
	}

	// @return boolean
	public function admin_menu() {

		// Do not hide the menu if toolbar is disabled.
		if (
			'frontend' == $this->show_user_toolbar() ||
			'disabled' == $this->show_user_toolbar()
		) {
			return true;
		}
		return $this->getValue( 'admin_menu' );
	}

	/**
	 * Footer options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function footer_search() {
		return $this->getValue( 'footer_search' );
	}

	// @return boolean
	public function footer_social() {
		return $this->getValue( 'footer_social' );
	}

	// @return boolean
	public function ftr__social_heading() {
		return $this->getValue( 'ftr__social_heading' );
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
	public function horz_spacing() {
		return $this->getValue( 'horz_spacing' );
	}

	// @return string
	public function vert_spacing() {
		return $this->getValue( 'vert_spacing' );
	}

	// @return string
	public function color_scheme() {
		return $this->getValue( 'color_scheme' );
	}

	/**
	 * Get color scheme
	 *
	 * Gets the data of the requested color scheme or
	 * of the current color scheme option.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $scheme The name of the requested color scheme.
	 * @return array
	 */
	public function get_color_scheme( $scheme = null ) {

		$name = $this->color_scheme();
		if ( $scheme ) {
			$name = $scheme;
		}

		return $data;
	}

	// @return string
	public function color_body() {
		return $this->getValue( 'color_body' );
	}

	// @return string
	public function color_body_dark() {
		return $this->getValue( 'color_body_dark' );
	}

	// @return string
	public function color_text() {
		return $this->getValue( 'color_text' );
	}

	// @return string
	public function color_text_dark() {
		return $this->getValue( 'color_text_dark' );
	}

	// @return string
	public function color_one() {
		return $this->getValue( 'color_one' );
	}

	// @return string
	public function color_two() {
		return $this->getValue( 'color_two' );
	}

	// @return string
	public function color_three() {
		return $this->getValue( 'color_three' );
	}

	// @return string
	public function color_four() {
		return $this->getValue( 'color_four' );
	}

	// @return string
	public function color_five() {
		return $this->getValue( 'color_five' );
	}

	// @return string
	public function color_six() {
		return $this->getValue( 'color_six' );
	}

	// @return string
	public function color_one_dark() {
		return $this->getValue( 'color_one_dark' );
	}

	// @return string
	public function color_two_dark() {
		return $this->getValue( 'color_two_dark' );
	}

	// @return string
	public function color_three_dark() {
		return $this->getValue( 'color_three_dark' );
	}

	// @return string
	public function color_four_dark() {
		return $this->getValue( 'color_four_dark' );
	}

	// @return string
	public function color_five_dark() {
		return $this->getValue( 'color_five_dark' );
	}

	// @return string
	public function color_six_dark() {
		return $this->getValue( 'color_six_dark' );
	}

	// @return string
	public function font_scheme() {
		return $this->getValue( 'font_scheme' );
	}

	// @return boolean
	public function admin_theme() {
		return $this->getValue( 'admin_theme' );
	}

	// @return string
	public function custom_css() {
		return strip_tags( $this->getValue( 'custom_css' ) );
	}

	// @return string
	public function admin_css() {
		return strip_tags( $this->getValue( 'admin_css' ) );
	}

	/**
	 * Meta options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return string
	public function title_sep() {

		// Get field value;
		$sep = $this->getValue( 'title_sep' );

		// Reverse some for RTL languages.
		if ( is_rtl() ) {
			if ( '&gt;' === $sep ) {
				$sep = '&lt;';
			}
			if ( '→' === $sep ) {
				$sep = '←';
			}
			if ( '≫' === $sep ) {
				$sep = '≪';
			}
		}
		return $sep;
	}

	// @return string
	public function custom_sep() {
		return $this->getValue( 'custom_sep' );
	}

	// @return string
	public function default_ttag() {
		return $this->getValue( 'default_ttag' );
	}

	// @return string
	public function loop_ttag() {
		return $this->getValue( 'loop_ttag' );
	}

	// @return string
	public function post_ttag() {
		return $this->getValue( 'post_ttag' );
	}

	// @return string
	public function page_ttag() {
		return $this->getValue( 'page_ttag' );
	}

	// @return string
	public function cat_ttag() {
		return $this->getValue( 'cat_ttag' );
	}

	// @return string
	public function tag_ttag() {
		return $this->getValue( 'tag_ttag' );
	}

	// @return string
	public function search_ttag() {
		return $this->getValue( 'search_ttag' );
	}

	// @return string
	public function error_ttag() {
		return $this->getValue( 'error_ttag' );
	}

	// @return string
	public function default_ttag_rtl() {
		return $this->getValue( 'default_ttag_rtl' );
	}

	// @return string
	public function loop_ttag_rtl() {
		return $this->getValue( 'loop_ttag_rtl' );
	}

	// @return string
	public function post_ttag_rtl() {
		return $this->getValue( 'post_ttag_rtl' );
	}

	// @return string
	public function page_ttag_rtl() {
		return $this->getValue( 'page_ttag_rtl' );
	}

	// @return string
	public function cat_ttag_rtl() {
		return $this->getValue( 'cat_ttag_rtl' );
	}

	// @return string
	public function tag_ttag_rtl() {
		return $this->getValue( 'tag_ttag_rtl' );
	}

	// @return string
	public function search_ttag_rtl() {
		return $this->getValue( 'search_ttag_rtl' );
	}

	// @return string
	public function error_ttag_rtl() {
		return $this->getValue( 'error_ttag_rtl' );
	}

	/**
	 * Favicon SRC
	 *
	 * Gets the URL of the site's bookmark icon.
	 *
	 * @since  1.0.0
	 * @return mixed Returns the URL or null.
	 */
	public function favicon_src() {

		// Access global variables.
		global $site;

		// Get icon field value.
		$icon = $this->site_favicon();

		// Use icon file in root content/uploads if found & set in options array.
		if ( $icon && file_exists( PATH_UPLOADS . $icon ) ) {
			return DOMAIN_UPLOADS . $icon;

		// Use icon file in theme assets/images if found & set in options array.
		} elseif ( $icon && file_exists( PATH_THEMES . $site->theme() . '/assets/images/' . $icon ) ) {
			return DOMAIN_THEME . 'assets/images/' . $icon;

		// Use favicon.png file in theme assets/images if found.
		} elseif ( ! $icon && file_exists( PATH_THEMES . $site->theme() . '/assets/images/favicon.png' ) ) {
			return DOMAIN_THEME . 'assets/images/favicon.png';
		}
		return null;
	}

	/**
	 * Cover SRC
	 *
	 * Gets the URL of the default cover image.
	 *
	 * @since  1.0.0
	 * @return mixed Returns the URL or null.
	 */
	public function cover_src() {

		// Access global variables.
		global $site;

		// Get cover field value.
		$cover = $this->default_cover();

		// Use cover file in root content/uploads if found & set in options array.
		if ( $cover && file_exists( PATH_UPLOADS . $cover ) ) {
			return DOMAIN_UPLOADS . $cover;

		// Use cover file in theme assets/images if found & set in options array.
		} elseif ( $cover && file_exists( PATH_THEMES . $site->theme() . '/assets/images/' . $cover ) ) {
			return DOMAIN_THEME . 'assets/images/' . $cover;

		// Use cover.jpg file in theme assets/images if found.
		} elseif ( ! $cover && file_exists( PATH_THEMES . $site->theme() . '/assets/images/cover.jpg' ) ) {
			return DOMAIN_THEME . 'assets/images/cover.jpg';
		}
		return null;
	}
}
