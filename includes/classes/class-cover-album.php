<?php
/**
 * Cover image album
 *
 * @package    Configure 8 Options
 * @subpackage Classes
 * @since      1.0.0
 */

namespace CFE_CLASS;

// Access namespaced functions.
use function CFE_Plugin\{
	plugin
};

class Cover_Album extends Cover_Images {

	/**
	 * Album markup
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $album
	 * @global object $L The Language class.
	 * @return string Returns the album markup.
	 */
	public function outputImagesAdmin( $album ) {

		// Access global variables.
		global $L;

		$this->loadGallery( $album );
		$imagesSort = $this->config['imagesSort'];

		// Get images.
		$images = $this->images( $album, $imagesSort );
		$count  = 0;

		// Generate HTML output.
		$html = '<ul id="image-upload-list">';
		foreach ( $images as $image => $timestamp ) {

			$count++;

			$html .= sprintf(
				'<li class="%s image-upload-item" id="imagegallery-image-%s">',
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
