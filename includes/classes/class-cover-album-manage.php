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
		$html = '<div class="row w-100">';

		foreach ( $images as $image => $timestamp ) {

			$html .= sprintf(
				'<div class="col-6 col-md-3 mb-5 text-break imagegallery-images text-center" id="imagegallery-image-%s">',
				++$count
			);

			$html .= sprintf(
				'<a href="%s%s%s" class="image" title="%s">',
				$this->urlPath( $album ),
				$this->pathLarge,
				$image,
				$image
			);

			$html .= sprintf(
				'<img src="%s%s%s" style="max-height: 320px;" />',
				$this->urlPath( $album ),
				$this->pathThumbnail,
				$image
			);
			$html .= '</a>';
			$html .= sprintf(
				'<p>%s<br /><span class="fa fa-trash"> <a href="javascript: void;" class="delete-image" data-album="%s" data-file="%s" data-number="%s">%s</a></p>',
				$image,
				$album,
				$image,
				$count,
				$L->get( 'Delete Image' )
			);
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
