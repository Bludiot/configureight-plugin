<?php
/**
 * Cover images
 *
 * @package    Configure 8 Options
 * @subpackage Classes
 * @since      1.0.0
 */

namespace CFE_CLASS;

class Cover_Images {

	protected $gallery = null;
	protected $storageRoot = 'configureight';
	protected $maxCacheAge = 360;
	protected $onlyWithImages = true;
	protected $pathThumbnail = 'cache' . DS . 'thumb' . DS;
	protected $pathLarge = 'cache' . DS . 'large' . DS;
	protected $config = [ 'imagesSort' => 'newest' ];

	function __construct( $config, $adminView = false ) {

		$this->config = array_merge( $this->config, $config );
		if ( $adminView ) {
			$this->onlyWithImages = false;
			$this->maxCacheAge    = false;
		}
	}

	protected function loadGallery( $album = '' ) {

		if ( is_null( $this->gallery ) ) {
			$storage = $this->storage( $album );
			$this->gallery = new novaGallery( $storage, $this->onlyWithImages, $this->maxCacheAge );
		}
	}

	protected function urlPath( $album = '' ) {

		global $site;

		$url = $this->addSlash( $site->url(), true );
		$path = $url . 'bl-content/' . $this->storageRoot . '/' . $album;
		return $this->addSlash( $path, true );
	}

	protected function storage( $album ) {
		$path = PATH_CONTENT . $this->storageRoot . DS . $album;
		return $this->addSlash( $path );
	}

	protected function addSlash( $string, $urlPath = false ) {

		// If urlPath always use '/' else use delimiter of the filesystem.
		$delimiter = $urlPath ? '/' : DS;
		$lastChar  = substr( $string, -1 );

		if ( $lastChar != $delimiter ) {
			$string = $string . $delimiter;
		}
		return $string;
	}

	/**
	 * Public method to load images
	 **/
	public function images( $album, $sort = 'default' ) {

		$this->loadGallery( $album );
		$imagesList = $this->gallery->images( $sort );
		$images     = [];

		foreach ( $imagesList as $image => $timestamp ) {
			$images[$image]['filename']  = $image;
			$images[$image]['thumbnail'] = $this->urlPath( $album ) . $this->pathThumbnail . $image;
			$images[$image]['large']     = $this->urlPath( $album ) . $this->pathLarge . $image;
		}
		return $images;
	}
}
