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
			'text'     => [
				'family' => $L->get( 'System sans-serif stack' ),
				'var'    => false,
				'weight' => '400',
				'min'    => '100',
				'max'    => '1000',
				'step'   => '300',
				'space'  => '0'
			],
			'primary' => [
				'family' => $L->get( 'System sans-serif stack' ),
				'var'    => false,
				'weight' => '700',
				'min'    => '100',
				'max'    => '1000',
				'step'   => '300',
				'space'  => '-0.015'
			],
			'secondary' => [
				'family' => $L->get( 'System sans-serif stack' ),
				'var'    => false,
				'weight' => '700',
				'min'    => '100',
				'max'    => '1000',
				'step'   => '300',
				'space'  => '0'
			]
		],
		'sans' => [
			'slug'     => 'sans',
			'name'     => $L->get( 'Sans Serif' ),
			'text'     => [
				'family' => 'Inter',
				'var'    => true,
				'weight' => '385',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Inter',
				'var'    => true,
				'weight' => '800',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '-0.025'
			],
			'secondary' => [
				'family' => 'Inter',
				'var'    => true,
				'weight' => '700',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			]
		],
		'serif' => [
			'slug'     => 'serif',
			'name'     => $L->get( 'Serif' ),
			'text'     => [
				'family' => $L->get( 'System serif stack' ),
				'var'    => false,
				'weight' => '400',
				'min'    => '100',
				'max'    => '1000',
				'step'   => '300',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Crimson Pro',
				'var'    => true,
				'weight' => '550',
				'min'    => '200',
				'max'    => '900',
				'step'   => '1',
				'space'  => '-0.025'
			],
			'secondary' => [
				'family' => 'Crimson Pro',
				'var'    => true,
				'weight' => '500',
				'min'    => '200',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
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
			'text'     => [
				'family' => 'Source Code Pro',
				'var'    => true,
				'weight' => '400',
				'min'    => '200',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Source Code Pro',
				'var'    => true,
				'weight' => '700',
				'min'    => '200',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			],
			'secondary' => [
				'family' => 'Source Code Pro',
				'var'    => true,
				'weight' => '700',
				'min'    => '200',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			]
		],
		'cosmo' => [
			'slug'     => 'cosmo',
			'name'     => $L->get( 'Cosmopolitan' ),
			'text'     => [
				'family' => 'Raleway',
				'var'    => true,
				'weight' => '450',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Playfair',
				'var'    => true,
				'weight' => '500',
				'min'    => '400',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			],
			'secondary' => [
				'family' => 'Playfair',
				'var'    => true,
				'weight' => '550',
				'min'    => '400',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			]
		],
		'modern' => [
			'slug'     => 'modern',
			'name'     => $L->get( 'Modern' ),
			'text'     => [
				'family' => 'Nunito Sans',
				'var'    => true,
				'weight' => '465',
				'min'    => '200',
				'max'    => '1000',
				'step'   => '1',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Montserrat',
				'var'    => true,
				'weight' => '600',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0.013'
			],
			'secondary' => [
				'family' => 'Montserrat',
				'var'    => true,
				'weight' => '600',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0.025'
			]
		],
		'slab' => [
			'slug'     => 'slab',
			'name'     => $L->get( 'Slab Serif' ),
			'text'     => [
				'family' => $L->get( 'System sans-serif stack' ),
				'var'    => false,
				'weight' => '400',
				'min'    => '100',
				'max'    => '1000',
				'step'   => '300',
				'space'  => '0'
			],
			'primary' => [
				'family' => 'Rokkitt',
				'var'    => true,
				'weight' => '750',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '-0.025'
			],
			'secondary' => [
				'family' => 'Rokkitt',
				'var'    => true,
				'weight' => '800',
				'min'    => '100',
				'max'    => '900',
				'step'   => '1',
				'space'  => '0'
			]
		]
	];
	return $schemes;
}

/**
 * All font schemes
 *
 * Merges basic schemes and style schemes.
 *
 * @since  1.0.0
 * @return array
 */
function font_schemes() {
	return array_merge( basic_font_schemes(), style_font_schemes() );
}

/**
 * Current font scheme
 *
 * Gets the data for the selected
 * font scheme option value.
 *
 * Used to define font scheme variables.
 *
 * @since  1.0.0
 * @return array Returns the font scheme data array.
 */
function current_font_scheme() {

	// Option from database.
	$slug = plugin()->font_scheme();

	// Get font schemes.
	$schemes = font_schemes();
	$name    = false;

	// Get all schemes.
	foreach ( $schemes as $option => $scheme ) {

		// Filter out all but the selected option.
		if ( $slug == $scheme['slug'] ) {
			$name = $scheme;
		}
	}
	return $name;
}
