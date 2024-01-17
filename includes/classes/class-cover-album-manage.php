<?php
/**
 * Image Gallery Lite - Image Gallery for Bludit3
 * Image gallery object for admin
 *
 * @author     CFE_AJAX OÜ
 * @copyright  2022 by CFE_AJAX OÜ
 * @license    AGPL-3.0
 * @see        https://bludit-plugins.com
 * @notes      based on PHP Image Gallery novaGallery - https://novagallery.org
 * This program is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY.
 */
namespace CFE_AJAX;

class Cover_Album_Manage extends Cover_Images {

	public function outputImagesAdmin( $album ) {

		global $L;

		$this->loadGallery( $album );

		$imagesSort = $this->config['imagesSort'];

		// Get images.
		$images = $this->images( $album, $imagesSort );
		$count  = 0;

		// Generate HTML output.
		$html = '';

		foreach ( $images as $image => $timestamp ) {

			$html .= sprintf(
				'<div class="upload-form-album imagegallery-images" id="imagegallery-image-%s">',
				++$count
			);

			$html .= sprintf(
				'<div class="image-album-preview"><a href="%s%s%s" class="image-in-album" title="%s" rel="lightbox" data-fancybox>',
				$this->urlPath( $album ),
				$this->pathLarge,
				$image,
				$L->get( 'View Full Size' )
			);

			$html .= sprintf(
				'<img src="%s%s%s" width="80" height="80" />',
				$this->urlPath( $album ),
				$this->pathThumbnail,
				$image
			);
			$html .= '</a></div>';
			$html .= sprintf(
				'<div class="image-album-details"><p class="image-album-name">%s</p><p class="image-album-buttons"><span class="button button-small set-cover" id="set-cover-%s" data-album="%s" data-file="%s" data-number="%s">%s</span> <span class="button button-small btn-danger delete-image" data-album="%s" data-file="%s" data-number="%s">%s</span></p></div>',
				$image,
				$count,
				$album,
				$image,
				$count,
				$L->get( 'Set Cover' ),
				$album,
				$image,
				$count,
				$L->get( 'Delete Image' )
			);
			$html .= '</div>';
		}

		if ( 0 == $count ) {
			$html = sprintf(
				'<div class="upload-album-empty"><p>%s</p></div>',
				$L->get( 'No images uploaded' )
			);
		}

		return $html;
	}
}
