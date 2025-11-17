<?php
/**
 * Gallery functions
 *
 * @todo Explore adding an advanced gallery option
 *       with custom captions and layout options.
 *
 * @package    Configure 8 Options
 * @subpackage Includes
 * @since      1.0.0
 */

namespace CFE_Galleries;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin
};

/**
 * Uploaded images
 *
 * Gets full-size image files uploaded to a page.
 *
 * @since  1.0.0
 * @global object $page The Page class.
 * @global object $url The Url class.
 * @return mixed Returns an array im images or false.
 */
function page_images() {

	// Access global variables,
	global $page, $url;

	// False if not singular content.
	if ( 'page' != $url->whereAmI() ) {
		return false;
	}

	// Variables.
	$build  = buildPage( $page->key() );
	$uuid   = $build->uuid();
	$dir    = PATH_UPLOADS_PAGES . $uuid . DS;
	$files  = \Filesystem :: listFiles( $dir, '*', '*', true, 0 );
	$images = [];

	// False if no images uploaded to page.
	if ( 0 == count( $files ) ) {
		return false;
	}

	// False if the random cover field not checked.
	if ( ! $build->custom( 'random_cover' ) ) {
		if ( $build->coverImage() ) {
			$images[] = $build->coverImage();
			return $images;
		}
		return false;
	}

	// Get the URL for each full-size image.
	foreach ( $files as $file ) {
		$images[] = DOMAIN_UPLOADS_PAGES . $uuid . '/' . str_replace( $dir, '', $file );
	}
	return $images;
}

/**
 * Basic page gallery
 *
 * Displays a lightbox gallery of images uploaded to a page.
 *
 * @since  1.0.0
 * @global object $page The Page class.
 * @global object $url The Url class.
 * @return mixed Returns the gallery markup or false.
 */
function basic_gallery() {

	// Access global variables,
	global $page, $url;

	// False if not singular content.
	if ( 'page' != $url->whereAmI() ) {
		return false;
	}

	// Variables.
	$page  = buildPage( $page->key() );
	$uuid  = $page->uuid();
	$dir   = PATH_UPLOADS_PAGES . $uuid . DS . 'thumbnails' . DS;
	$files = \Filesystem :: listFiles( $dir, '*', '*', true, 0 );
	$class = 'page-gallery-list';
	if (
		'blend' == plugin()->cover_style() &&
		is_array( plugin()->cover_blend_use() ) &&
		in_array( 'galleries', plugin()->cover_blend_use() )
	) {
		$class = 'page-gallery-list cover-blend';
	}

	// False if no images uploaded to page.
	if ( 0 == count( $files ) ) {
		return false;
	}

	// Gallery markup.
	$images = "<ul id='page-gallery-list-{$page->key()}' class='{$class}'>";
	foreach ( $files as $file ) {

		$filename = str_replace( $dir, '', $file );

		$thumb = DOMAIN_UPLOADS_PAGES . $uuid . '/thumbnails/' . $filename;
		$full  = DOMAIN_UPLOADS_PAGES . $uuid . '/' . $filename;

		$images .= "<li class='page-gallery-item'><a class='page-gallery-link' href='{$full}'  rel='gallery' data-fancybox='{$page->key()}'><figure class='page-gallery-thumb'><img class='page-gallery-thumb-image' src='{$thumb}' /><figcaption class='screen-reader-text'>{$filename}</figcaption></figure></a></li>";
	}
	$images .= '</ul>';
	return $images;
}
