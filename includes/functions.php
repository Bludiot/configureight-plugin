<?php
/**
 * Plugin functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Plugin;

/**
 * Plugin object
 *
 * Gets this plugin's core class.
 *
 * @since  1.0.0
 * @global object $site The Site class.
 * @return mixed Returns the class object or false.
 */
function plugin() {

	// Access global variables.
	global $site;

	if ( getPlugin( $site->theme() ) ) {
		return getPlugin( $site->theme() );
	} else {
		return false;
	}
}

/**
 * Change theme
 *
 * Replaces admin theme value in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function change_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = '"adminTheme":"' . $site->adminTheme() . '"';
	if ( DEBUG_MODE ) {
		$current = '"adminTheme": "' . $site->adminTheme() . '"';
	}

	// Get database content.
	$content = file_get_contents( $db_file );
	$replace = '"adminTheme":"configureight"';
	if ( DEBUG_MODE ) {
		$replace = '"adminTheme": "configureight"';
	}

	// Change admin theme to Configureight.
	$content = str_replace( $current, $replace, $content);

	// Write theme into the database file.
	file_put_contents( $db_file, $content );
}

/**
 * Default theme
 *
 * Restore admin theme to default in the site database.
 *
 * @since  1.0.0
 * @return void
 */
function default_theme() {

	// Access global variables.
	global $site;

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = '"adminTheme":"' . $site->adminTheme() . '"';
	if ( DEBUG_MODE ) {
		$current = '"adminTheme": "' . $site->adminTheme() . '"';
	}

	// Get database content.
	$content = file_get_contents( $db_file );
	$replace = '"adminTheme":"booty"';
	if ( DEBUG_MODE ) {
		$replace = '"adminTheme": "booty"';
	}

	// Change admin theme to default.
	$content = str_replace( $current, $replace, $content );

	// Write theme into the database file.
	file_put_contents ( $db_file, $content );
}

/**
 * Is admin theme directory empty
 *
 * @since  1.0.0
 * @param  string $themes_dir
 * @return mixed
 */
function is_dir_empty( $themes_dir ) {

    if ( ! is_readable( $themes_dir ) ) {
		return null;
	}
    return ( count( scandir( $themes_dir ) ) == 2 );
}

/**
 * Admin theme
 *
 * Checks for the Configure 8 admin theme.
 *
 * @since  1.0.0
 * @return boolean Returns true if the admin theme is
 *                 in hte admin themes directory.
 */
function admin_theme() {

	$themes_dir = PATH_ADMIN_THEMES;

	if ( ! is_readable( $themes_dir ) ) {
		return false;
	}

	$themes = [];
	foreach ( glob( $themes_dir . '*', GLOB_ONLYDIR ) as $theme ) {
		if ( ! is_dir_empty( $theme ) ) {

			// Truncate the theme path and keep the theme name only.
			$theme    = str_replace( $themes_dir, '', $theme );
			$themes[] = $theme;
		}
	}

	if ( in_array( 'configureight', $themes ) ) {
		return true;
	}
	return false;
}

/**
 * Search form
 *
 * @since  1.0.0
 * @param  mixed $args Arguments to be passed.
 * @param  array $defaults Default arguments.
 * @return mixed Returns the search form markup
 *               or null;
 */
function search_form( $args = null, $defaults = [] ) {

	// Return null if the Search plugin is not installed and activated.
	if ( ! getPlugin( 'pluginSearch' ) ) {
		return null;
	}

	// Access global variables.
	global $L;

	// Default arguments.
	$defaults = [
		'wrap'      => false,
		'title'     => false,
		'heading'   => 'h2',
		'button'    => true
	];

	// Maybe override defaults.
	if ( is_array( $args ) && $args ) {
		$args = array_merge( $defaults, $args );
	} else {
		$args = $defaults;
	}

	// List markup.
	$html = '';
	if ( $args['wrap'] ) {
		$html .= '<div class="form-wrap search-form-wrap">';
	}

	if ( $args['title'] ) {
		$html .= sprintf(
			'<label for="%s"><%s>%s</%s></label>',
			'error_search_text',
			$args['heading'],
			$args['title'],
			$args['heading']
		);
	}
	$html .= '<form class="form search-form" role="search">';
	$html .= sprintf(
		'<input type="search" id="%s" name="%s" placeholder="%s" onkeypress="%s" />',
		'error_search_text',
		'error_search_text',
		$L->get( 'Search&hellip;' ),
		'error_plugin_search()'
	);

	if ( $args['button'] ) {
		$html .= sprintf(
			'<input type="button" id="%s" value="%s" onClick="%s" />',
			'search-submit',
			$L->get( 'Submit' ),
			'error_plugin_search()'
		);
	}

	$html .= '</form>';
	if ( $args['wrap'] ) {
		$html .= '</div>';
	}
	$html .= search_script();

	return $html;
}

/**
 * Search form script
 *
 * Prints the JavaScript necessary
 * to perform the search function.
 *
 * @since  1.0.0
 * @return void
 */
function search_script() {

	?>
	<script>
		/**
		 * Search function
		 *
		 * The results target must be `_blank' since
		 * there is no `_self` as used in the original
		 * search plugin.
		 *
		 * @return false
		 */
		function error_plugin_search() {
			var text = document.getElementById( 'error_search_text' ).value;
			window.open( '<?php echo DOMAIN_BASE; ?>' + 'search/' + text, '_blank' );
			return false;
		}
	</script>
	<?php
}

/**
 * Static pages list
 *
 * @since  1.0.0
 * @param  mixed $args Arguments to be passed.
 * @param  array $defaults Default arguments.
 * @global object $site The Site class.
 * @return string Returns the list markup.
 */
function static_list( $args = null, $defaults = [] ) {

	// Access global variables.
	global $site;

	// Default arguments.
	$defaults = [
		'wrap'      => false,
		'direction' => 'vert',
		'title'     => false,
		'heading'   => 'h2',
		'links'     => true
	];

	// Maybe override defaults.
	if ( is_array( $args ) && $args ) {
		$args = array_merge( $defaults, $args );
	} else {
		$args = $defaults;
	}

	// List classes.
	$classes   = [];
	$classes[] = 'static-list';
	if ( 'vert' == $args['direction'] ) {
		$classes[] = 'static-list-vertical';
	} else {
		$classes[] = 'static-list-horizontal';
	}
	$classes = implode( ' ', $classes );

	// List markup.
	$html = '';
	if ( $args['wrap'] ) {
		$html = '<div class="static-list-wrap">';
	}

	if ( $args['title'] ) {
		$html .= sprintf(
			'<%s>%s</%s>',
			$args['heading'],
			$args['title'],
			$args['heading']
		);
	}

	$html .= sprintf(
		'<ul class="%s">',
		$classes
	);

	$static = buildStaticPages();
	foreach ( $static as $page ) {

		// Item class.
		$classes = [ 'static-page' ];
		if ( $page->hasChildren() ) {
			$classes[] = 'parent-page';
		} elseif ( $page->isChild() ) {
			$classes[] = 'child-page';
		}
		$classes = implode( ' ', $classes );

		if (
			$page->key() != $site->homepage() &&
			$page->key() != $site->pageNotFound()
		) {
			$html .= "<li class='{$classes}'>";

			if ( $args['links'] ) {
				$html .= '<a href="' . $page->permalink() . '">';
			}
			$html .= $page->title();
			if ( $args['links'] ) {
				$html .= '</a>';
			}
			$html .= '</li>';
		}
	}
	$html .= '</ul>';

	if ( $args['wrap'] ) {
		$html .= '</div>';
	}
	return $html;
}

/**
 * Categories list
 *
 * @since  1.0.0
 * @param  mixed $args Arguments to be passed.
 * @param  array $defaults Default arguments.
 * @global object $categories The Categories class.
 * @return string Returns the list markup.
 */
function categories_list( $args = null, $defaults = [] ) {

	// Access global variables.
	global $categories;

	// Default arguments.
	$defaults = [
		'wrap'      => false,
		'direction' => 'horz',
		'buttons'   => false,
		'title'     => false,
		'heading'   => 'h2',
		'links'     => true,
		'count'     => false
	];

	// Maybe override defaults.
	if ( is_array( $args ) && $args ) {
		$args = array_merge( $defaults, $args );
	} else {
		$args = $defaults;
	}

	// List classes.
	$classes   = [];
	$classes[] = 'categories-list';
	if ( 'vert' == $args['direction'] ) {
		$classes[] = 'categories-list-vertical';
	} else {
		$classes[] = 'categories-list-horizontal';
	}
	if ( $args['buttons'] ) {
		$classes[] = 'categories-list-buttons';
	}
	$classes = implode( ' ', $classes );

	// List markup.
	$html = '';
	if ( $args['wrap'] ) {
		$html = '<div class="categories-list-wrap">';
	}

	if ( $args['title'] ) {
		$html .= sprintf(
			'<%s>%s</%s>',
			$args['heading'],
			$args['title'],
			$args['heading']
		);
	}
	$html .= sprintf(
		'<ul class="%s">',
		$classes
	);

	// By default the database of categories are alphanumeric sorted.
	foreach ( $categories->db as $key => $fields ) {

		$get_count = count( $fields['list'] );
		$get_name  = $fields['name'];

		$name = $get_name;
		if ( $args['count'] ) {
			$name = sprintf(
				'%s (%s)',
				$get_name,
				$get_count
			);
		}

		if ( $get_count > 0 ) {
			$html .= '<li>';
			if ( $args['links'] ) {
				$html .= '<a href="' . DOMAIN_CATEGORIES . $key . '">';
			}
			$html .= $name;
			if ( $args['links'] ) {
				$html .= '</a>';
			}
			$html .= '</li>';
		}
	}
	$html .= '</ul>';

	if ( $args['wrap'] ) {
		$html .= '</div>';
	}

	return $html;
}

/**
 * Tags list
 *
 * @since  1.0.0
 * @param  mixed $args Arguments to be passed.
 * @param  array $defaults Default arguments.
 * @global object $tags The Tags class.
 * @return string Returns the list markup.
 */
function tags_list( $args = null, $defaults = [] ) {

	// Access global variables.
	global $tags;

	// Default arguments.
	$defaults = [
		'wrap'      => false,
		'direction' => 'horz',
		'buttons'   => false,
		'title'     => false,
		'heading'   => 'h2',
		'links'     => true,
		'count'     => false
	];

	// Maybe override defaults.
	if ( is_array( $args ) && $args ) {
		$args = array_merge( $defaults, $args );
	} else {
		$args = $defaults;
	}

	// List classes.
	$classes   = [];
	$classes[] = 'tags-list';
	if ( 'vert' == $args['direction'] ) {
		$classes[] = 'tags-list-vertical';
	} else {
		$classes[] = 'tags-list-horizontal';
	}
	if ( $args['buttons'] ) {
		$classes[] = 'tags-list-buttons';
	}
	$classes = implode( ' ', $classes );

	// List markup.
	$html = '';
	if ( $args['wrap'] ) {
		$html = '<div class="tags-list-wrap">';
	}

	if ( $args['title'] ) {
		$html .= sprintf(
			'<%s>%s</%s>',
			$args['heading'],
			$args['title'],
			$args['heading']
		);
	}
	$html .= sprintf(
		'<ul class="%s">',
		$classes
	);

	// By default the database of tags are alphanumeric sorted.
	foreach ( $tags->db as $key => $fields ) {

		$get_count = $tags->numberOfPages( $key );
		$get_name  = $fields['name'];

		$name = $get_name;
		if ( $args['count'] ) {
			$name = sprintf(
				'%s (%s)',
				$get_name,
				$get_count
			);
		}
		$html .= '<li>';
		if ( $args['links'] ) {
			$html .= '<a href="' . DOMAIN_TAGS . $key . '">';
		}
		$html .= $name;
		if ( $args['links'] ) {
			$html .= '</a>';
		}
		$html .= '</li>';
	}
	$html .= '</ul>';

	if ( $args['wrap'] ) {
		$html .= '</div>';
	}
	return $html;
}

/**
 * Search error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_search_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// Form heading element.
	if ( plugin()->error_search_heading() ) {
		$args['heading'] = plugin()->error_search_heading();
	}

	// Form heading text.
	if ( plugin()->error_search_title() ) {
		$args['title'] = plugin()->error_search_title();
	}

	// Form button.
	$args['button'] = plugin()->error_search_btn();
	return $args;
}

/**
 * Static pages error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_static_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// List heading element.
	if ( plugin()->error_static_heading() ) {
		$args['heading'] = plugin()->error_static_heading();
	}

	// List heading text.
	if ( plugin()->error_static_title() ) {
		$args['title'] = plugin()->error_static_title();
	}

	// List direction.
	if ( plugin()->error_static_dir() ) {
		$args['direction'] = plugin()->error_static_dir();
	}
	return $args;
}

/**
 * Categories error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_cats_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// List heading element.
	if ( plugin()->error_cats_heading() ) {
		$args['heading'] = plugin()->error_cats_heading();
	}

	// List heading text.
	if ( plugin()->error_cats_title() ) {
		$args['title'] = plugin()->error_cats_title();
	}

	// List direction.
	if ( plugin()->error_cats_dir() ) {
		$args['direction'] = plugin()->error_cats_dir();
	}
	return $args;
}

/**
 * Tags error display
 *
 * @since  1.0.0
 * @return array Returns an array of modified arguments.
 */
function error_tags_display() {

	// Set up arguments array.
	$args = [];
	$args['wrap'] = true;

	// List heading element.
	if ( plugin()->error_tags_heading() ) {
		$args['heading'] = plugin()->error_tags_heading();
	}

	// List heading text.
	if ( plugin()->error_tags_title() ) {
		$args['title'] = plugin()->error_tags_title();
	}

	// List direction.
	if ( plugin()->error_tags_dir() ) {
		$args['direction'] = plugin()->error_tags_dir();
	}
	return $args;
}
