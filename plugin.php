<?php
/**
 * Configure 8 theme options plugin
 *
 * @package    Configure 8 Options
 * @subpackage Theme Plugins
 * @version    1.0.0
 * @since      1.0.0
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

// Access namespaced functions.
use function CFE_Plugin\{
	css,
	js,
	asset_min,
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
use function CFE_Fonts\{
	load_font_files
};

/**
 * Core plugin class
 *
 * Extends the Bludit class for plugin functionality
 * options form, and template hooks.
 *
 * @since   1.0.0
 * @version 1.0.0
 */
class configureight extends Plugin {

	/**
	 * Storage root
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string
	 */
	private $storageRoot = 'configureight';

	/**
	 * Gallery
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    boolean
	 */
	private $gallery = false;

	/**
	 * Cache age
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    integer
	 */
	private $maxCacheAge = 86400;

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Run parent constructor.
		parent :: __construct();

		// Include functionality.
		if ( $this->installed() ) {
			$this->autoload();
			$this->get_files();
		}
	}

	/**
	 * Prepare plugin for installation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function prepare() {
		$this->autoload();
		$this->get_files();
	}

	/**
	 * Autoload classes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function autoload() {

		// Plugin path.
		$path = PATH_PLUGINS . __CLASS__ . DS;

		// Array of namespaced classes & filenames.
		$classes = [
			'CFE_Classes\Image_Upload'  => $path . 'includes/classes/class-image-upload.php',
			'CFE_Classes\Cover_Images'  => $path . 'includes/classes/class-cover-images.php',
			'CFE_Classes\Cover_Album'   => $path . 'includes/classes/class-cover-album.php',
			'CFE_Classes\Image_Gallery' => $path . 'includes/classes/class-image-gallery.php',
		];
		spl_autoload_register(
			function ( string $class ) use ( $classes ) {
				if ( isset( $classes[ $class ] ) ) {
					require $classes[ $class ];
				}
			}
		);
	}

	/**
	 * Include functionality
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function get_files() {

		// Plugin path.
		$path = PATH_PLUGINS . __CLASS__ . DS;

		// Get plugin functions.
		require_once( $path . 'includes/functions.php' );
		require_once( $path . 'includes/fonts.php' );
		require_once( $path . 'includes/colors.php' );
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
			'user_toolbar'           => 'enabled',
			'show_options'           => false,
			'to_top_button'          => true,
			'page_loader'            => false,
			'loader_bg_color'        => $this->loader_bg_default(),
			'loader_bg_color_dark'   => $this->loader_bg_default_dark(),
			'loader_text_color'      => $this->loader_text_default(),
			'loader_text_color_dark' => $this->loader_text_default_dark(),
			'loader_text'            => $L->get( 'Loading&hellip;' ),
			'loader_icon'            => 'spinner-dots',
			'search_icon'            => true,
			'site_title'             => true,
			'site_slogan'            => true,
			'logo_width_std'         => $this->logo_width_std_default(),
			'logo_width_mob'         => $this->logo_width_mob_default(),
			'logo_location'          => 'before',
			'header_sticky'          => false,
			'main_nav_pages'         => [ '' ],
			'main_nav_labels'        => 'slug',
			'main_nav_children'      => 'secondary',
			'main_nav_pos'           => 'right',
			'main_nav_icon'          => 'bars',
			'main_nav_loop'          => 'none',
			'main_nav_loop_label'    => '',
			'main_nav_home'          => false,
			'header_search'          => false,
			'header_social'          => false,
			'img_upload_quality'     => 90,
			'thumb_width'            => 480,
			'thumb_height'           => 360,
			'site_favicon'           => '',
			'modal_bg_color'         => $this->modal_bg_default(),
			'default_cover'          => '',
			'cover_images'           => [],
			'cover_thumb_width'      => 320,
			'cover_thumb_height'     => 320,
			'cover_thumb_quality'    => 90,
			'cover_large_width'      => 1920,
			'cover_large_height'     => 1080,
			'cover_large_quality'    => 90,
			'cover_meta_width'       => 1280,
			'cover_meta_height'      => 720,
			'cover_meta_quality'     => 90,
			'gallery_sort'           => 'newest', // 'newest', 'oldest', 'a-z'
			'cover_style'            => 'overlay',
			'cover_blend'            => $this->cover_blend_default(),
			'cover_blend_use'        => [ '', 'covers', 'slider' ],
			'cover_overlay'          => $this->cover_overlay_default(),
			'cover_text_color'       => $this->cover_text_default(),
			'cover_text_shadow'      => true,
			'cover_desaturate'       => 0,
			'cover_desaturate_use'   =>  [ '', 'none' ],
			'cover_icon'             => 'angle-down-light',
			'loop_title'             => $L->get( 'Blog' ),
			'loop_description'       => '',
			'loop_cover'             => 'full_first',
			'loop_type'              => 'blog',
			'loop_style'             => 'list',
			'cat_style'              => 'list',
			'tag_style'              => 'list',
			'loop_paged'             => 'numerical',
			'loop_byline'            => true,
			'loop_date'              => true,
			'loop_word_count'        => true,
			'loop_read_time'         => true,
			'loop_icons'             => true,
			'posts_nav'              => true,
			'posts_nav_type'         => 'buttons',
			'posts_nav_icon'         => 'arrow',
			'posts_slider'           => false,
			'slider_content'         => 'recent',
			'slider_number'          => 5,
			'slider_pages'           => [ '' ],
			'slider_icon'            => 'spinner-dots',
			'slider_arrows'          => 'none',
			'slider_dots'            => false,
			'slider_animate'         => 'fade',
			'slider_duration'        => '3',
			'slider_link_text'       => '',
			'related_posts'          => true,
			'max_related'            => $this->max_related_default(),
			'related_heading'        => $L->get( 'Related Posts' ),
			'related_heading_el'     => 'h3',
			'related_style'          => 'list',
			'error_widgets'          => 'content',
			'error_search'           => true,
			'error_static'           => true,
			'error_cats'             => true,
			'error_tags'             => true,
			'error_search_label'     => $L->get( 'Search' ),
			'error_static_title'     => $L->get( 'Pages' ),
			'error_cats_title'       => $L->get( 'Categories' ),
			'error_tags_title'       => $L->get( 'Post Tags' ),
			'error_search_heading'   => 'h2',
			'error_static_heading'   => 'h2',
			'error_cats_heading'     => 'h2',
			'error_tags_heading'     => 'h2',
			'error_search_holder'    => $L->get( 'Search' ),
			'error_search_btn'       => true,
			'error_search_btn_text'  => $L->get( 'Submit' ),
			'error_static_dir'       => 'horz',
			'error_cats_dir'         => 'horz',
			'error_tags_dir'         => 'horz',
			'sidebar_in_page'        => 'side',
			'sidebar_in_loop'        => 'side',
			'sidebar_position'       => 'right',
			'sidebar_sticky'         => false,
			'sidebar_social'         => false,
			'sb_social_heading'      => '',
			'admin_menu'             => true,
			'footer_search'          => false,
			'footer_social'          => true,
			'ftr_social_heading'     => '',
			'copyright'              => true,
			'copy_date'              => true,
			'copy_text'              => '',
			'content_width'          => '1280',
			'horz_spacing'           => '2',
			'vert_spacing'           => '2',
			'color_scheme'           => 'default',
			'custom_scheme_from'     => 'default',
			'color_body'             => '#ffffff',
			'color_body_dark'        => '#1e1e1e',
			'color_text'             => '#333333',
			'color_text_dark'        => '#eeeeee',
			'color_one'              => '#0044aa',
			'color_two'              => '#0066cc',
			'color_three'            => '#333333',
			'color_four'             => '#555555',
			'color_five'             => '#888888',
			'color_six'              => '#cccccc',
			'color_one_dark'         => '#ffffff',
			'color_two_dark'         => '#eeeeee',
			'color_three_dark'       => '#333333',
			'color_four_dark'        => '#555555',
			'color_five_dark'        => '#888888',
			'color_six_dark'         => '#cccccc',
			'font_scheme'            => 'default',
			'admin_theme'            => 'css',
			'custom_css'             => '',
			'admin_css'              => '',
			'title_sep'              => '|',
			'custom_sep'             => '',
			'default_ttag'           => '',
			'loop_ttag'              => '',
			'post_ttag'              => '',
			'page_ttag'              => '',
			'cat_ttag'               => '',
			'tag_ttag'               => '',
			'search_ttag'            => '',
			'error_ttag'             => '',
			'default_ttag_rtl'       => '',
			'loop_ttag_rtl'          => '',
			'post_ttag_rtl'          => '',
			'page_ttag_rtl'          => '',
			'cat_ttag_rtl'           => '',
			'tag_ttag_rtl'           => '',
			'search_ttag_rtl'        => '',
			'error_ttag_rtl'         => '',
			'meta_keywords'          => '',
			'meta_use_schema'        => true,
			'meta_use_og'            => true,
			'meta_use_twitter'       => true,
			'meta_use_dublin'        => false
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
	 * Plugin URL
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function plugin_url() {
		return HTML_PATH_ADMIN_ROOT . 'configure-plugin/' . $this->className();
	}

	/**
	 * Plugin string
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function plugin_slug() {
		return 'configure-plugin/' . $this->className();
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

		$storage = PATH_CONTENT . $this->storageRoot . DS;
		if ( ! file_exists( $storage ) ) {
			Filesystem :: mkdir( $storage, true );
		}

		// Create the database.
		return $this->save();
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
	 * @global object $site Site class.
	 * @global object $url Url class.
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
	 * @global object $site Site class.
	 * @global object $url Url class.
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

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/tooltips{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/lightbox{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/tabs{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/dropzone{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/color-picker{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/tooltips{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/lightbox{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		$assets .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/fields{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;

		// End plugin page.
		endif;

		if ( 'css' == $this->admin_theme() && 'configureight' != $site->adminTheme() ) {
			$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/style{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;
		} elseif ( 'default' == $this->admin_theme() ) {
			$assets .= '<link rel="stylesheet" type="text/css" href="' . $this->domainPath() . "assets/css/default{$suffix}.css?version=" . $this->getMetadata( 'version' ) . '" />' . PHP_EOL;
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

		// Scheme stylesheets.
		$assets .= $this->scheme_stylesheet( 'colors', 'admin' );
		$assets .= $this->scheme_stylesheet( 'fonts', 'admin' );
		$assets .= define_color_scheme();

		// Custom admin CSS for default the with theme styles.
		if ( ! empty( $this->admin_css() ) && 'css' == $this->admin_theme() ) {
			$assets .= $this->admin_style_block();
		}

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
	 * @global object $L Language class.
	 * @global object $url Url class.
	 * @return void
	 */
	public function adminBodyBegin() {

		// Access global variables.
		global $L, $url;

		$coverAdminPath = HTML_PATH_ADMIN_ROOT . 'configureight';
		$currentPath = strtok( $_SERVER["REQUEST_URI"], '?' );

		if ( $currentPath == $coverAdminPath ) {
			ob_start();
		}

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
	 * @global object $site Site class.
	 * @return mixed
	 */
	public function adminSidebar() {

		// Access global variables.
		global $L, $site;

		// Stop if Configure 8 is not the active theme.
		if ( 'configureight' != $site->theme() ) {
			return;
		}

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
	 * Admin body end
	 *
	 * Used for adding scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @global object $url Url class.
	 * @return string
	 */
	public function adminBodyEnd() {

		// Access global variables.
		global $L, $url;

		// Maybe get non-minified assets.
		$suffix = '';
		if ( ! $this->debug_mode() ) {
			$suffix = '.min';
		}

		$coverAdminPath = HTML_PATH_ADMIN_ROOT . 'configureight';
		$currentPath = strtok( $_SERVER['REQUEST_URI'], '?' );

		if ( $currentPath == $coverAdminPath ) {

			 // Fetch content.
			$content = ob_get_contents();
			ob_end_clean();

			// Load cover album admin.
			$html = 'Cover Images';

			$album = 'cover';
			$domainPath = $this->domainPath();

			// Get helper object.
			require_once( 'includes/classes/class-cover-images-helper.php' );
			$helper = new \CFE_Classes\Cover_Images_Helper();

			// Load required JS.
			$html .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/jquery-confirm{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;
			$html .= $helper->adminJSData( $domainPath );
			if ( $album ) {
				$html .= $helper->dropzoneJSData( $album );
			}

			// Remove old admin content (error message)
			$regexp  = "#(\<div class=\"col-lg-10 pt-3 pb-1 h-100\"\>)(.*?)(\<\/div\>)#s";
			$content = preg_replace( $regexp, "$1{$html}$3", $content );
			echo $content;

			return;
		}

		if ( $url->slug() != $this->plugin_slug() ) {
			return false;
		}
		$album = 'cover';
		$domainPath = $this->domainPath();

		// Get helper object.
		require_once( 'includes/classes/class-cover-images-helper.php' );
		$helper = new \CFE_Classes\Cover_Images_Helper();

		// Load required JS
		$html .= '<script type="text/javascript" src="' . $this->domainPath() . "assets/js/jquery-confirm{$suffix}.js?version=" . $this->getMetadata( 'version' ) . '"></script>' . PHP_EOL;
		$html .= $helper->adminJSData( $domainPath );
		if ( $album ) {
			$html .= $helper->dropzoneJSData( $album );
		}

		// Content ID on page edit screen.
		if ( ! getPlugin( 'pluginContentID' ) && str_contains( $url->slug(), 'edit-content' ) ) {
			$html .= sprintf(
				'<script>var uuid = $("#jsuuid").val(); $uuid = uuid; if ( $uuid != "" ) { $( "#jsform" ).prepend( "<p style=\'margin-bottom: 1rem;\'><strong>%s</strong> <code class=\'select\'>" + $uuid + "</code></p>"); }</script>',
				$L->get( 'Content ID:' )
			);
		}
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

		$album = 'cover';
		$config['imagesSort'] = 'newest';
		$gallery = new CFE_Classes\Cover_Album( $config, true );

		$html = '';
		// ob_start();
		include( $this->phpPath() . '/views/page-form.php' );
		// $html .= ob_get_clean();

		return $html;
	}

	/**
	 * Admin info pages
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

		// Stop if Configure 8 is not the active theme.
		if ( 'configureight' != $site->theme() ) {
			return;
		}

		$html  = '';
		ob_start();
		if ( isset( $_GET['page'] ) && 'database' == $_GET['page'] ) {
			include( $this->phpPath() . '/views/page-database.php' );
		} elseif ( isset( $_GET['page'] ) && 'colors' == $_GET['page'] ) {
			include( $this->phpPath() . '/views/page-colors.php' );
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
	 * @global object $L Language class.
	 * @global object $site Site class.
	 * @return void
	 */
	public function dashboard() {

		// Access global variables.
		global $L, $site;

		// Stop if Configure 8 is not the active theme.
		if ( 'configureight' != $site->theme() ) {
			return;
		}

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
		$args['thumbnailQuality'] = $this->getValue( 'img_upload_quality' );

		// Return modified array.
		return editSettings( $args );
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
		return true;
	}

	/**
	 * Debug mode
	 *
	 * Checks if the site is in debug mode.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if in debug mode.
	 */
	public function debug_mode() {

		if ( defined( 'DEBUG_MODE' ) && DEBUG_MODE ) {
			return true;
		}
		return false;
	}

	/**
	 * Load scheme stylesheet
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns a link tag for the `<head>`.
	 */
	public function scheme_stylesheet( $type = '', $filename = 'style' ) {

		// Stop if no scheme type.
		if ( empty( $type ) ) {
			return null;
		}

		// Get options from the theme plugin.
		$colors = $this->color_scheme();
		$fonts  = $this->font_scheme();
		$html   = '';

		// Get minified if not in debug mode.
		$suffix = asset_min();

		// Color scheme stylesheet.
		if ( 'default' != $colors ) {
			if ( 'colors' === $type ) {
				$html = css( "assets/css/schemes/colors/{$colors}/{$filename}{$suffix}.css" );
			}
		}

		// Typography scheme stylesheet.
		if ( 'default' != $fonts ) {
			if ( 'fonts' == $type && 'default' != $fonts ) {
				$html .= css( "assets/css/schemes/fonts/{$fonts}/{$filename}{$suffix}.css" );
			}
		}
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
	public function loader_icon() {
		return $this->getValue( 'loader_icon' );
	}

	// @return boolean
	public function search_icon() {
		return $this->getValue( 'search_icon' );
	}

	// @return string
	public function loader_bg_color() {
		return $this->getValue( 'loader_bg_color' );
	}

	// @return string
	public function loader_bg_color_dark() {
		return $this->getValue( 'loader_bg_color_dark' );
	}

	// @return string
	public function loader_text_color() {
		return $this->getValue( 'loader_text_color' );
	}

	// @return string
	public function loader_text_color_dark() {
		return $this->getValue( 'loader_text_color_dark' );
	}

	// @return string
	public function loader_bg_default() {
		return '#ffffff';
	}

	// @return string
	public function loader_bg_default_dark() {
		return '#1e1e1e';
	}

	// @return string
	public function loader_text_default() {
		return '#333333';
	}

	// @return string
	public function loader_text_default_dark() {
		return '#eeeeee';
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

	/**
	 * Navigation options
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return array
	public function main_nav_pages() {
		return $this->getValue( 'main_nav_pages' );
	}

	// @return string
	public function main_nav_labels() {
		return $this->getValue( 'main_nav_labels' );
	}

	// @return string
	public function main_nav_children() {
		return $this->getValue( 'main_nav_children' );
	}

	// @return string
	public function main_nav_pos() {
		return $this->getValue( 'main_nav_pos' );
	}

	// @return string
	public function main_nav_icon() {
		return $this->getValue( 'main_nav_icon' );
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

	// @return array
	public function cover_images() {
		return $this->getValue( 'cover_images' );
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

	// @return integer
	public function cover_desaturate() {
		return $this->getValue( 'cover_desaturate' );
	}

	// @return integer
	public function cover_desaturate_use() {
		return $this->getValue( 'cover_desaturate_use' );
	}

	// @return string
	public function cover_blend_default() {
		return '#355e9a';
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

	/**
	 * @global $site Site class.
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
	 * @global $site Site class.
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
	 * @global $site Site class.
	 * @return string
	 */
	public function img_upload_quality() {

		// Access global variables.
		global $site;

		$quality = $this->getValue( 'img_upload_quality' );
		if ( empty( $site->thumbnailQuality() ) ) {
			$quality = $this->dbFields['img_upload_quality'];
		} elseif ( $site->thumbnailQuality() != $this->getValue( 'img_upload_quality' ) ) {
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
	public function loop_cover() {
		return $this->getValue( 'loop_cover' );
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
	public function posts_slider() {
		return $this->getValue( 'posts_slider' );
	}

	// @return string
	public function slider_content() {
		return $this->getValue( 'slider_content' );
	}

	// @return integer
	public function slider_number() {
		return $this->getValue( 'slider_number' );
	}

	// @return array
	public function slider_pages() {
		return $this->getValue( 'slider_pages' );
	}

	// @return boolean
	public function slider_icon() {
		return $this->getValue( 'slider_icon' );
	}

	// @return boolean
	public function slider_arrows() {
		return $this->getValue( 'slider_arrows' );
	}

	// @return boolean
	public function slider_dots() {
		return $this->getValue( 'slider_dots' );
	}

	// @return string
	public function slider_animate() {
		return $this->getValue( 'slider_animate' );
	}

	// @return string
	public function slider_duration() {
		return $this->getValue( 'slider_duration' );
	}

	// @return string
	public function slider_link_text() {
		return $this->getValue( 'slider_link_text' );
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
			'frontend' == $this->user_toolbar() ||
			'disabled' == $this->user_toolbar()
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
	public function content_width() {
		return $this->getValue( 'content_width' );
	}

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

	// @return string
	public function custom_scheme_from() {
		return $this->getValue( 'custom_scheme_from' );
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

	// @return string
	public function load_font_files() {
		return load_font_files();
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

	// @return string
	public function meta_keywords() {
		return $this->getValue( 'meta_keywords' );
	}

	// @return boolean
	public function meta_use_schema() {
		return $this->getValue( 'meta_use_schema' );
	}

	// @return boolean
	public function meta_use_og() {
		return $this->getValue( 'meta_use_og' );
	}

	// @return boolean
	public function meta_use_twitter() {
		return $this->getValue( 'meta_use_twitter' );
	}

	// @return boolean
	public function meta_use_dublin() {
		return $this->getValue( 'meta_use_dublin' );
	}

	/**
	 * Favicon SRC
	 *
	 * Gets the URL of the site's bookmark icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $site Site class.
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

		// Use the external URL.
		} elseif ( filter_var( $cover, FILTER_VALIDATE_URL ) ) {
			return $icon;

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
	 * Random cover image
	 *
	 * Get one random image from the array of selected
	 * cover image uploads. If only one is selected then
	 * the default cover will always be the same image.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns one filename or false.
	 */
	public function random_cover_image() {

		$covers = $this->cover_images();
		$image  = false;
		if ( is_array( $covers ) && $covers ) {
			$random = array_rand( $covers );
			$image  = $covers[$random];
		}
		return $image;
	}

	/**
	 * Cover SRC
	 *
	 * Gets the URL a default cover image.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global $site Site class.
	 * @return mixed Returns the URL or false.
	 */
	public function cover_src() {

		// Access global variables.
		global $site;

		// Get cover field value.
		$cover  = $this->random_cover_image();
		$album  = PATH_CONTENT . $this->storageRoot . DS . 'cover' . DS . $cover;
		$option = $site->url() . 'bl-content/' . $this->storageRoot . '/cover/' . $cover;

		if ( $cover && ! file_exists( $album ) ) {
			if ( file_exists( PATH_THEMES . $site->theme() . '/assets/images/' . $cover ) ) {
				return DOMAIN_THEME . 'assets/images/' . $cover;

			// Use cover.jpg file in theme assets/images if found.
			} elseif ( file_exists( PATH_THEMES . $site->theme() . '/assets/images/cover.jpg' ) ) {
				return DOMAIN_THEME . 'assets/images/cover.jpg';
			}

		} elseif ( $cover && file_exists( $album ) ) {
			return $option;

		// Use cover file in root content/uploads if found & set in options array.
		} elseif ( $cover && file_exists( PATH_UPLOADS . $cover ) ) {
			return DOMAIN_UPLOADS . $cover;

		// Use the external URL.
		} elseif ( filter_var( $cover, FILTER_VALIDATE_URL ) ) {
			return $cover;

		// Use cover file in theme assets/images if found & set in options array.
		} elseif ( $cover && file_exists( PATH_THEMES . $site->theme() . '/assets/images/' . $cover ) ) {
			return DOMAIN_THEME . 'assets/images/' . $cover;

		// Use cover.jpg file in theme assets/images if found.
		} elseif ( ! $cover && file_exists( PATH_THEMES . $site->theme() . '/assets/images/cover.jpg' ) ) {
			return DOMAIN_THEME . 'assets/images/cover.jpg';
		}
		return false;
	}
}
