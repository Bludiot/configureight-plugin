<?php
/**
 * Image Gallery Lite - Image Gallery for Bludit3
 * Helper object
 *
 * @author     CFE_CLASS OÜ
 * @copyright  2022 by CFE_CLASS OÜ
 * @license    AGPL-3.0
 * @see        https://bludit-plugins.com
 * @notes      based on PHP Image Gallery novaGallery - https://novagallery.org
 * This program is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY.
 */
namespace CFE_CLASS;

class Cover_Images_Helper {

	public function adminJSData( $domainPath ) {

		global $L;
		return '<script>
				var imageGallery = {
				config: {
					ajaxUrl: "'.$domainPath.'ajax/request.php"
				},
				L: {
					startTypingPlaceholder: "'.$L->get('Start typing to see a list of suggestions.').'",
					deleteImageError: "'.$L->get('Error: Image could not be deleted.').'"
				}
				};
			</script>
			';
	}

	public function dropzoneJSData( $album ) {

		global $security, $L;

		$upload = "<strong>{$L->get( 'Upload images here' )}</strong>";

		return '<script>
			  Dropzone.options.imagegalleryUpload = {
				url: imageGallery.config.ajaxUrl,
				params: {
				  tokenCSRF: "'.$security->getTokenCSRF().'",
				  action: "uploadImage",
				  album: "' . $album . '"
				},
				addRemoveLinks : true,
				acceptedFiles : ".jpg,.jpeg,.png",
				dictDefaultMessage : "' . $upload . '",
				dictFileTooBig : "' . $L->get( 'File is to big. Max. file size:' ) . ' {{maxFilesize}} MiB",
				dictInvalidFileType : "' . $L->get( 'This is not a JPEG or PNG.' ) . '",
				dictResponseError : "{{statusCode}} ' . $L->get( 'Server error during upload.' ) . '",
				dictCancelUpload : "' . $L->get( 'Cancel' ) . '",
				dictUploadCanceled : "' . $L->get( 'Canceled' ) . '",
				dictCancelUploadConfirmation : "' . $L->get( 'Cancel?' ) . '",
				dictRemoveFile : "' . $L->get( 'Remove' ) . '",
				init : function(){
				  this.on("queuecomplete", function() { $("#uploaded-images").load( location.href + " #uploaded-images" );
				});
				  this.on("addedfile", function(file) { $(".refresh-after-upload").fadeIn( 250 ); });
				}
			  };
			</script>
			';
  }
}