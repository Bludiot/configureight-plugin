<?php
/**
 * Create image based on SimpleImage
 *
 * @package    Configure 8 Options
 * @subpackage Classes
 * @since      1.0.0
 */

namespace CFE_AJAX;

// Access namespaced classes.
use \CFE_Images\SimpleImage;

class Image_Upload {

	private $image;
	private $mimeType;
	private $error = false;

	function __construct( $file ) {
		$this->image = new SimpleImage( $file );
		$this->image->autoOrient();
		$this->mimeType = $this->image->getMimeType();
	}

	public function resize( $width, $height, $format = null ) {

		switch ( $format ) {
			case 'crop':
			$this->image->thumbnail( $width, $height );
			break;

			default:
			$this->image->bestFit( $width, $height );
			break;
		}
	}

	public function toFile( $file, $quality = 100 ) {
		return $this->image->toFile( $file, $this->mimeType, $quality );
	}

	public function toScreen( $quality = 100 ) {
		$this->image->toScreen( $this->mimeType, $quality );
	}
}
