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
 * Is RTL language
 *
 * @since  1.0.0
 * @param  mixed $langs Arguments to be passed.
 * @param  array $rtl Default arguments.
 * @global object $L The Language class.
 * @return boolean Returns true if site is in RTL language.
 */
function is_rtl( $langs = null, $rtl = [] ) {

	// Access global variables.
	global $L;

	$rtl = [
		'ar',
		'fa',
		'he',
		'ks',
		'ku',
		'pa',
		'ps',
		'sd',
		'ug',
		'ur'
	];

	// Maybe override defaults.
	if ( is_array( $langs ) && $langs ) {
		$langs = array_merge( $rtl, $langs );
	} else {
		$langs = $rtl;
	}

	$current = $L->currentLanguageShortVersion();

	if ( in_array( $current, $rtl ) ) {
		return true;
	}
	return false;
}

/**
 * System can search
 *
 * Checks if the system has search functionality.
 *
 * @since  1.0.0
 * @return boolean Returns true if a search plugin is activated.
 */
function can_search() {
	if (
		getPlugin( 'Search_Forms' ) ||
		getPlugin( 'pluginSearch' )
	) {
		return true;
	}
	return false;
}

/**
 * Frontend title tag
 *
 * @since  1.0.0
 * @global object $categories The Categories class.
 * @global object $L The Language class.
 * @global object $page The Page class.
 * @global object $site The Site class.
 * @global object $tags The Tags class.
 * @global object $url The Url class.
 * @return string Returns the meta tag.
 */
function title_tag() {

	global $categories, $L, $page, $site, $tags, $url;

	// Title separator.
	$sep = plugin()->dbFields['title_sep'];
	if ( 'custom' == plugin()->title_sep() && plugin()->custom_sep() ) {
		$sep = plugin()->custom_sep();
	} elseif ( 'custom' != plugin()->title_sep() ) {
		$sep = plugin()->title_sep();
	}

	// Loop page.
	$loop_page = '';
	$loop_sep  = '>';
	if ( is_rtl() ) {
		$loop_sep  = '<';
	}
	if ( isset( $_GET['page'] ) && $_GET['page'] > 1 ) {
		$loop_page = sprintf(
			' %s %s %s',
			$loop_sep,
			$L->get( 'Page' ),
			$_GET['page']
		);
		if ( is_rtl() ) {
			$loop_page = sprintf(
				'%s %s %s ',
				$_GET['page'],
				$L->get( 'Page' ),
				$loop_sep
			);
		}
	}

	// Default title.
	if ( is_rtl() && plugin()->default_ttag_rtl() ) {
		$format = plugin()->default_ttag_rtl();
	} elseif ( plugin()->default_ttag() ) {
		$format = plugin()->default_ttag();
	} else {
		$format = sprintf(
			'%s %s %s',
			$site->title(),
			$site->slogan() ? $sep : '',
			$site->slogan()
		);
		if ( is_rtl() ) {
			$format = sprintf(
				'%s %s %s',
				$site->slogan(),
				$site->slogan() ? $sep : '',
				$site->title()
			);
		}
	}

	// Default 404 page.
	if ( $url->notFound() && ! $site->pageNotFound() ) {

		if ( is_rtl() && plugin()->error_ttag_rtl() ) {
			$format = plugin()->error_ttag_rtl();
		} elseif ( plugin()->error_ttag() ) {
			$format = plugin()->error_ttag();
		} else {
			$format = sprintf(
				'%s %s %s',
				$L->get( 'URL Error: Page Not Found' ),
				$sep,
				$site->title()
			);
			if ( is_rtl() ) {
				$format = sprintf(
					'%s %s %s',
					$site->title(),
					$sep,
					$L->get( 'URL Error: Page Not Found' )
				);
			}
		}

	// Posts loop.
	} elseif ( 'blog' == $url->whereAmI() ) {

		if ( is_rtl() && plugin()->loop_ttag_rtl() ) {
			$format = plugin()->loop_ttag_rtl();
		} elseif ( plugin()->loop_ttag() ) {
				$format = plugin()->loop_ttag();
		} else {
			$format = sprintf(
				'%s%s %s %s',
				ucwords( plugin()->loop_type() ),
				$loop_page,
				$sep,
				$site->title()
			);
			if ( is_rtl() ) {
				$format = sprintf(
					'%s %s %s%s',
					$site->title(),
					$sep,
					$loop_page,
					ucwords( plugin()->loop_type() )
				);
			}
		}

	// Post or page.
	} elseif ( 'page' == $url->whereAmI() ) {

		// Page (static).
		if ( $page->isStatic() ) {
			if ( is_rtl() && plugin()->page_ttag_rtl() ) {
				$format = plugin()->page_ttag_rtl();
			} elseif ( plugin()->page_ttag() ) {
					$format = plugin()->page_ttag();
			} else {
				$format = sprintf(
					'%s %s %s',
					$page->title(),
					$sep,
					$site->title()
				);
				if ( is_rtl() ) {
					$format = sprintf(
						'%s %s %s',
						$site->title(),
						$sep,
						$page->title()
					);
				}
			}
		} else {
			if ( is_rtl() && plugin()->post_ttag_rtl() ) {
				$format = plugin()->post_ttag_rtl();
			} elseif ( plugin()->post_ttag() ) {
					$format = plugin()->post_ttag();
			} else {
				$format = sprintf(
					'%s %s %s %s %s',
					$page->title(),
					$sep,
					$page->date(),
					$sep,
					$site->title()
				);
				if ( is_rtl() ) {
					$format = sprintf(
						'%s %s %s %s %s',
						$site->title(),
						$sep,
						$page->date(),
						$sep,
						$page->title()
					);
				}
			}
		}
		$format = str_replace( '{{page-title}}', $page->title(), $format );
		$format = str_replace( '{{page-description}}', $page->description(), $format );
		$format = str_replace( '{{published}}', $page->date(), $format );

	// Category loop.
	} elseif ( 'category' == $url->whereAmI() ) {
		try {
			$key    = $url->slug();
			$cat    = new \Category( $key );

			if ( is_rtl() && plugin()->cat_ttag_rtl() ) {
				$format = plugin()->cat_ttag_rtl();
			} elseif ( plugin()->cat_ttag() ) {
					$format = plugin()->cat_ttag();
			} else {
				$format = sprintf(
					'%s %s %s',
					$cat->name(),
					$sep,
					$site->title()
				);
				if ( is_rtl() ) {
					$format = sprintf(
						'%s %s %s',
						$site->title(),
						$sep,
						$cat->name()
					);
				}
			}
			$format = str_replace( '{{category-name}}', $cat->name(), $format );
		} catch ( \Exception $e ) {
			// Category doesn't exist.
		}

	// Tag loop.
	} elseif ( 'tag' == $url->whereAmI() ) {
		try {
			$key    = $url->slug();
			$tag    = new \Tag( $key );

			if ( is_rtl() && plugin()->tag_ttag_rtl() ) {
				$format = plugin()->tag_ttag_rtl();
			} elseif ( plugin()->tag_ttag() ) {
					$format = plugin()->tag_ttag();
			} else {
				$format = sprintf(
					'%s %s %s',
					$tag->name(),
					$sep,
					$site->title()
				);
				if ( is_rtl() ) {
					$format = sprintf(
						'%s %s %s',
						$site->title(),
						$sep,
						$tag->name()
					);
				}
			}
			$format = str_replace( '{{tag-name}}', $tag->name(), $format );
		} catch ( \Exception $e ) {
			// Tag doesn't exist.
		}

	} elseif ( 'search' == $url->whereAmI() ) {

		$slug  = $url->slug();
		$terms = '';
		if ( str_contains( $slug, 'search/' ) ) {
			$terms = str_replace( 'search/', '', $slug );
			$terms = str_replace( '+', ' ', $terms );
		}

		if ( is_rtl() && plugin()->search_ttag_rtl() ) {
			$format = plugin()->search_ttag_rtl();
		} elseif ( plugin()->search_ttag() ) {
				$format = plugin()->search_ttag();
		} else {
			$format = sprintf(
				'%s "%s" %s %s',
				$L->get( 'Searching' ),
				$terms,
				$sep,
				$site->title()
			);
			if ( is_rtl() ) {
				$format = sprintf(
					'%s %s "%s" %s',
					$site->title(),
					$sep,
					$terms,
					$L->get( 'Searching' )
				);
			}
		}
		$format = str_replace( '{{search-terms}}', $terms, $format );
	}

	$format = str_replace( '{{separator}}', $sep, $format );
	$format = str_replace( '{{site-title}}', $site->title(), $format );
	$format = str_replace( '{{site-slogan}}', $site->slogan(), $format );
	$format = str_replace( '{{site-description}}', $site->description(), $format );
	$format = str_replace( '{{loop-type}}', ucwords( plugin()->loop_type() ), $format );
	$format = str_replace( '{{page-number}}', $loop_page, $format );

	$title = sprintf(
		'<title dir="%s">%s</title>',
		is_rtl() ? 'rtl' : 'ltr',
		$format
	);
	return $title;
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
	$content = str_replace( $current, $replace, $content );

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

	// Get search plugin object,
	$search = getPlugin( 'Search_Forms' );
	if ( ! $search ) {
		return null;
	}

	// Set up arguments array.
	$args = [];

	if ( ! plugin()->error_search_label() ) {
		$args = array_merge( $args, [ 'label' => false ] );
	} elseif ( plugin()->error_search_label() ) {
		$args = array_merge( $args, [ 'label' => plugin()->error_search_label() ] );
	}
	if ( ! plugin()->error_search_heading() ) {
		$args = array_merge( $args, [ 'label_wrap' => false ] );
	}
	if ( plugin()->error_search_holder() ) {
		$args = array_merge( $args, [ 'placeholder' => plugin()->error_search_holder() ] );
	} elseif ( ! plugin()->error_search_holder() ) {
		$args = array_merge( $args, [ 'placeholder' => false ] );
	}
	if ( ! plugin()->error_search_btn() ) {
		$args = array_merge( $args, [ 'button' => false ] );
	}
	if ( plugin()->error_search_btn_text() ) {
		$args = array_merge( $args, [ 'button_text' => plugin()->error_search_btn_text() ] );
	}
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
