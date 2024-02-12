<?php
/**
 * Cover logo images album
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

class Logo_Cover_Album extends Logo_Cover_Images {

	/**
	 * Album name
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $album = 'logo_cover';

	/**
	 * Count album images
	 *
	 * @since  1.0.0
	 * @access public
	 * @return integer
	 */
	public function count_images() {
		return count( $this->images( $this->album ) );
	}

	/**
	 * Select logo image
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
				'<li id="logo-cover-select-item-%s" style="background-color: #555"><label for="logo-cover-image-select-%s" class="%s"><img src="%s%s%s" /><input type="radio" name="cover_logo[]" id="logo-cover-image-select-%s" value="%s" %s /><span class="screen-reader-text">%s</span></label></li>',
				$count,
				$count,
				( in_array( $image, plugin()->cover_logo() ) ? 'image-select-label logo-cover-select-label selected' : 'image-select-label logo-cover-select-label' ),
				$this->urlPath( $album ),
				$this->pathThumbnail,
				$image,
				$count,
				$image,
				( in_array( $image, plugin()->cover_logo() ) ? 'checked' : '' ),
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
	 * Manage logo images
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
				'<li class="upload-form-album image-upload-item" id="logo-cover-image-%s">',
				$count
			);

			$html .= sprintf(
				'<div class="image-album-preview" style="background-color: #555"><a href="%s%s" class="image-in-album" title="%s" rel="lightbox" data-fancybox data-caption="%s">',
				$this->urlPath( $album ),
				$image,
				$L->get( 'Enlarge' ),
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
				'<div class="image-album-details"><p class="image-album-name">%s</p><p class="image-album-buttons"><span class="button button-small btn btn-secondary btn-sm btn-danger delete-logo-cover" data-album="%s" data-file="%s" data-number="%s">%s</span></p></div>',
				$image,
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
