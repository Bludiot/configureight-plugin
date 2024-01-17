/**
 * AdminJS for Bludit Image Gallery Lite
 * @author    novafacile OÜ
 * @copyright 2022 by novafacile OÜ
 * @license   AGPL-3.0
 * @see       https://bludit-plugins.com
 * This program is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY.
 */
$( function() {
	$( '.delete-image' ).bind( 'click', function() {
		if ( ! confirm( 'Are you sure?' ) ) { return; };
		deleteImage(this);
	});
});

function deleteImage(el) {
	$.post( imageGallery.config.ajaxUrl, {
		tokenCSRF : $( '#jstokenCSRF' ).val(),
		action    : 'deleteImage',
		album     : $(el).data( 'album' ),
		file      : $(el).data( 'file' )
	},
	function() {
		let selector = '#imagegallery-image-' + $(el).data( 'number' );
		$(selector).hide();

	}).fail( function() {
		$.alert({
			title   : imageGallery.L.error,
			content : imageGallery.L.deleteImageError
		});
	});
}