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

/**
 * Basic font schemes
 *
 * Listed first in the option.
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array Returns array of font schemes data.
 */
function basic_font_schemes() {

	// Access global variables.
	global $L;

	$schemes = [
		'default' => [
			'slug'     => 'default',
			'name'     => $L->get( 'System Default' ),
			'variable' => false,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '400',
				'high'   => '700'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '400',
				'high'   => '700'
			]
		],
		'sans' => [
			'slug'     => 'sans',
			'name'     => $L->get( 'Sans Serif' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			]
		],
		'serif' => [
			'slug'     => 'serif',
			'name'     => $L->get( 'Serif' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '200',
				'high'   => '900'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '200',
				'high'   => '900'
			]
		]
	];
	return $schemes;
}

/**
 * Style font schemes
 *
 * @since  1.0.0
 * @global object $L The Language class.
 * @return array Returns array of font schemes data.
 */
function style_font_schemes() {

	// Access global variables.
	global $L;

	$schemes = [
		'code' => [
			'slug'     => 'code',
			'name'     => $L->get( 'Code' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '200',
				'high'   => '900'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '200',
				'high'   => '900'
			]
		],
		'cosmo' => [
			'slug'     => 'cosmo',
			'name'     => $L->get( 'Cosmopolitan' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			]
		],
		'modern' => [
			'slug'     => 'modern',
			'name'     => $L->get( 'Modern' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '200',
				'high'   => '1000'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			]
		],
		'slab' => [
			'slug'     => 'slab',
			'name'     => $L->get( 'Slab Serif' ),
			'variable' => true,
			'text'     => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '400',
				'high'   => '700'
			],
			'display' => [
				'normal' => '400',
				'bold'   => '700',
				'low'    => '100',
				'high'   => '900'
			]
		]
	];
	return $schemes;
}
