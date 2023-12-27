<?php
/**
 * Font functions
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Fonts;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin,
	domain
};

/**
 * Load font files
 *
 * @since  1.0.0
 * @return mixed Returns link tags for the `<head>` or null.
 */
function load_font_files() {

	// Get the font scheme setting.
	$fonts = plugin()->font_scheme();

	// Stop if default font, no directory exists.
	if ( 'default' == $fonts || empty( plugin()->font_scheme() ) ) {
		return null;
	}
	$valid = [ 'woff', 'woff2', 'otf', 'ttf' ];
	$files = scandir( PATH_PLUGINS . plugin()->className() . "/assets/fonts/{$fonts}/" );
	$tags  = '';

	foreach ( $files as $font => $file ) {

		$href = domain( "/assets/fonts/{$fonts}/{$file}" );
		$tab = '	';

		// Get the font file extension.
		$info = pathinfo( $file );
		$type = $info['extension'];
		if ( 'ttf' == $info ) {
			$type = 'truetype';
		}

		if ( ! in_array( $type, $valid ) ) {
			$tags  .= '';
		} else {
			$tags .= sprintf(
				'<link rel="preload" href="%s" as="font" type="font/%s" crossorigin="anonymous">',
				$href,
				$type
			) . "\n" . $tab;
		}
	}
	return $tags;
}
