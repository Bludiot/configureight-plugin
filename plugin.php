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
	die( $L->get( 'direct-access' ) );
}

// Access namespaced functions.
use function CFE_Plugin\{
	change_theme,
	default_theme,
	admin_theme
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
		include_once( $this->phpPath() . '/includes/functions.php' );
	}

	/**
	 * Initialize plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function init() {

		$this->dbFields = [
			'user_toolbar'       => 'enabled',
			'show_options'       => false,
			'to_top_button'      => true,
			'page_loader'        => false,
			'loader_bg_color'    => $this->loader_bg_default(),
			'loader_text_color'  => $this->loader_text_default(),
			'loader_text'        => '',
			'site_title'         => true,
			'site_slogan'        => true,
			'logo_width_std'     => $this->logo_width_std_default(),
			'logo_width_mob'     => $this->logo_width_mob_default(),
			'main_nav_pos'       => 'right',
			'main_nav_icon'      => 'bars',
			'max_nav_items'      => 0,
			'main_nav_loop'      => true,
			'main_nav_home'      => false,
			'header_search'      => true,
			'header_social'      => false,
			'site_favicon'       => '',
			'modal_bg_color'     => $this->modal_bg_default(),
			'default_cover'      => '',
			'cover_overlay'      => $this->cover_overlay_default(),
			'cover_text_color'   => $this->cover_text_default(),
			'cover_text_shadow'  => true,
			'cover_icon'         => 'angle-down-light',
			'thumb_width'        => $this->thumb_width_default(),
			'thumb_height'       => $this->thumb_height_default(),
			'thumb_quality'      => $this->thumb_quality_default(),
			'loop_title'         => '',
			'loop_description'    => '',
			'loop_style'         => 'blog',
			'content_style'      => 'list',
			'sidebar_in_loop'    => 'side',
			'loop_paged'         => 'numerical',
			'loop_byline'        => true,
			'loop_date'          => true,
			'loop_word_count'    => true,
			'loop_read_time'     => true,
			'loop_icons'         => true,
			'related_posts'      => true,
			'max_related'        => $this->max_related_default(),
			'related_heading'    => '',
			'related_heading_el' => 'h3',
			'related_style'      => 'list',
			'sidebar_position'   => 'default',
			'sidebar_display'    => 'default',
			'sidebar_sticky'     => false,
			'sidebar_search'     => 'hide',
			'sidebar_social'     => false,
			'sb_social_heading'  => '',
			'admin_menu'         => true,
			'footer_social'      => true,
			'ftr_social_heading' => '',
			'copyright'          => true,
			'copy_date'          => true,
			'copy_text'          => '',
			'horz_spacing'       => $this->horz_spacing_default(),
			'vert_spacing'       => $this->vert_spacing_default(),
			'body_bg_color'      => $this->body_bg_color_default(),
			'color_scheme'       => 'default',
			'font_scheme'        => 'default',
			'admin_theme'        => 'css',
			'custom_css'         => '',
			'admin_css'          => ''
		];

		if ( ! $this->installed() ) {
			$Tmp = new dbJSON( $this->filenameDb );
			$this->db = $Tmp->db;
			$this->prepare();
		}
	}

	/**
	 * Dashboard options
	 *
	 * Displays a list of options and their values for the dashboard.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the widget markup or null.
	 */
	public function dashboard_options() {

		// Stop if option not enabled.
		if ( ! $this->show_options() ) {
			return null;
		}

		// Access global variables.
		global $L;

		// Get the plugin database.
		$db  = new dbJSON( $this->filenameDb );
		$get = $db->getDB();

		// Stop if the plugin database is empty.
		if ( empty( $get ) ) {
			return null;
		}

		// Options list markup.
		$options = '<ul class="dashboard-options-list">';
		foreach ( $get as $key => $value ) {

			// Convert boolean values to "true" or "false" text.
			if ( is_bool( $value ) ) {
				if ( 0 == $value ) {
					$value = $L->get( 'false' );
				}

				if ( 1 == $value ) {
					$value = $L->get( 'true' );
				}
			}

			// Convert empty string values to "empty" text.
			if ( is_string( $value ) && empty( $value ) ) {
				$value = $L->get( 'empty' );
			}

			// Option list item.
			$options .= sprintf(
				'<li><span class="option-name">%s:</span> <span class="option-value">%s</span></li>',
				$key,
				$value
			);
		}
		$options .= '</ul>';

		// Final widget markup.
		$html = sprintf(
			'<div class="dashboard-options"><h2>%s</h2><p>%s</p>%s</div>',
			$L->get( 'Configure 8 Options' ),
			$L->get( 'List of current theme option values.' ),
			$options
		);
		return $html;
	}

	/**
	 * Dashboard hook
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dashboard() {
		echo $this->dashboard_options();
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

		// Load only for this plugin's settings page,.
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
			$L->get( 'Options' )
		);
		return $html;
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
	 * Thumbnails: not working
	 *
	 * Database settings for thumbnail images.
	 *
	 * @todo Get this to work or remove.
	 *
	 * @since  1.0.0
	 * @global object $site The Site class.
	 * @return function editSettings()
	 */
	public function failing_thumbnail_settings() {

		// Access global variables.
		global $site;

		$args   = $site->get();
		$thumbs = [
			'thumbnailWidth'   => $this->getValue( 'thumb_width' ),
			'thumbnailHeight'  => $this->getValue( 'thumb_height' ),
			'thumbnailQuality' => $this->getValue( 'thumb_quality' )
		];

		// Return modified array.
		return array_replace( $args, $thumbs );
	}

	/**
	 * Edit settings
	 *
	 * Database settings for thumbnail images.
	 * Hacky but working.
	 *
	 * @todo Get the preferred method above to work or
	 * remove consider removing duplicate thumbnail fields.
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
	 * Page options
	 *
	 * @since  1.0.0
	 * @access public
	 */

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
	public function horz_spacing_default() {
		return '2';
	}

	// @return string
	public function vert_spacing_default() {
		return '2';
	}

	// @return string
	public function body_bg_color() {
		return $this->getValue( 'body_bg_color' );
	}

	// @return string
	public function body_bg_color_default() {
		return '#ffffff';
	}

	// @return string
	public function color_scheme() {
		return $this->getValue( 'color_scheme' );
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
