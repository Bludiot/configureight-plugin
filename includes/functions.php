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
	$current = $site->adminTheme();

	// Get database content.
	$content = file_get_contents( $db_file );

	// Change admin theme to Configureight.
	$content = str_replace( $current . "\"", "configureight\"", $content);

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

	// Default admin theme.
	$default = 'booty';

	// Define database file.
	$db_file = DB_SITE;

	// Get current admin theme.
	$current = $site->adminTheme();

	// Get database content.
	$content = file_get_contents( $db_file );

	// Change admin theme to default.
	$content = str_replace( $current . "\"", $default . "\"", $content );

	// Write theme into the database file.
	file_put_contents ( $db_file, $content );
}

function is_dir_empty( $themes_dir ) {

    if ( ! is_readable( $themes_dir ) ) {
		return null;
	}

    return ( count( scandir( $themes_dir ) ) == 2 );
}

// @todo Remove if unnecessary.
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
