<?php
/**
 * Cover image album
 *
 * @package    Configure 8 Options
 * @subpackage Classes
 * @since      1.0.0
 */

namespace CFE_Classes;

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

// Access namespaced functions.
use function CFE_Plugin\{
	plugin
};

class Cover_Album extends Cover_Images {

	/**
	 * Select cover images
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $album
	 * @global object $L The Language class.
	 * @return string Returns the album markup.
	 */
	public function select_images( $album ) {

		// Access global variables.
		global $L;

		$this->loadGallery( $album );
		$imagesSort = $this->config['imagesSort'];

		// Get images.
		$images = $this->images( $album, $imagesSort );
		$count  = 0;

		// Generate HTML output.
		$html = '<ul class="image-select-list">';
		foreach ( $images as $image => $timestamp ) {

			$count++;

			$html .= sprintf(
				'<li id="cover-select-item-%s"><label for="cover-image-select-%s" class="%s"><img src="%s%s%s" /><input type="checkbox" name="cover_images[]" id="cover-image-select-%s" value="%s" %s /><span class="screen-reader-text">%s</span></label></li>',
				$count,
				$count,
				( in_array( $image, plugin()->cover_images() ) ? 'image-select-label selected' : 'image-select-label' ),
				$this->urlPath( $album ),
				$this->pathThumbnail,
				$image,
				$count,
				$image,
				( in_array( $image, plugin()->cover_images() ) ? 'checked' : '' ),
				$image
			);
		}
		$html .= '</ul>';

		if ( 0 == $count ) {
			$html = sprintf(
				'<div class="upload-album-empty"><p>%s</p></div>',
				$L->get( 'No images uploaded' )
			);
		}

		return $html;
	}

	/**
	 * Manage cover images
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $album
	 * @global object $L The Language class.
	 * @return string Returns the album markup.
	 */
	public function manage_images( $album ) {

		// Access global variables.
		global $L;

		$this->loadGallery( $album );
		$imagesSort = $this->config['imagesSort'];

		// Get images.
		$images = $this->images( $album, $imagesSort );
		$count  = 0;

		// Generate HTML output.
		$html = '<ul class="image-upload-list">';
		foreach ( $images as $image => $timestamp ) {

			$count++;

			$html .= sprintf(
				'<li class="%s image-upload-item" id="cover-image-%s">',
				( $image == plugin()->default_cover() ? 'upload-form-album current' : 'upload-form-album' ),
				$count
			);

			$html .= sprintf(
				'<div class="image-album-preview"><a href="%s%s%s" class="image-in-album" title="%s" rel="lightbox" data-fancybox data-caption="%s">',
				$this->urlPath( $album ),
				$this->pathLarge,
				$image,
				$L->get( 'View Full Size' ),
				$image
			);

			$html .= sprintf(
				'<img src="%s%s%s" width="80" height="80" />',
				$this->urlPath( $album ),
				$this->pathThumbnail,
				$image
			);
			$html .= '</a></div>';
			$html .= sprintf(
				'<div class="image-album-details"><p class="image-album-name">%s</p><p class="image-album-buttons"><span class="button button-small btn btn-secondary btn-sm %s" id="set-cover-%s" data-album="%s" data-file="%s" data-number="%s">%s</span> <span class="button button-small btn btn-secondary btn-sm btn-danger delete-image" data-album="%s" data-file="%s" data-number="%s">%s</span></p></div>',
				$image,
				( $image == plugin()->default_cover() ? 'current-cover' : 'set-cover' ),
				$count,
				$album,
				$image,
				$count,
				( $image == plugin()->default_cover() ? $L->get( 'Current Cover' ) : $L->get( 'Set Cover' ) ),
				$album,
				$image,
				$count,
				$L->get( 'Delete' )
			);
			$html .= '</li>';
		}
		$html .= '</ul>';

		if ( 0 == $count ) {
			$html = sprintf(
				'<div class="upload-album-empty"><p>%s</p></div>',
				$L->get( 'No images uploaded' )
			);
		}

		return $html;
	}
}
