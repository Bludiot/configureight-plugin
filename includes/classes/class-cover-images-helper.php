<?php
/**
 * Image Gallery Lite - Image Gallery for Bludit3
 * Helper object
 *
 * @author     CFE_AJAX OÜ
 * @copyright  2022 by CFE_AJAX OÜ
 * @license    AGPL-3.0
 * @see        https://bludit-plugins.com
 * @notes      based on PHP Image Gallery novaGallery - https://novagallery.org
 * This program is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY.
 */
namespace CFE_AJAX;

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

		$upload = "<strong>{$L->get( 'Drag & drop images or click to browse' )}</strong>";

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
				dictCancelUpload : "' . $L->get( 'Cancel upload' ) . '",
				dictUploadCanceled : "' . $L->get( 'Upload canceled' ) . '",
				dictCancelUploadConfirmation : "' . $L->get( 'Cancel upload?' ) . '",
				dictRemoveFile : "' . $L->get( 'Remove' ) . '",
				init : function(){
				  this.on("queuecomplete", function() { $("#imagegallery-reload-button").removeClass("d-none"); });
				  this.on("addedfile", function(file) { $("#imagegallery-reload-button").addClass("d-none"); });
				}
			  };
			</script>
			';
  }
}