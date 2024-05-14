<?php
/**
 * Guide page content tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

?>

<h2 class="form-heading"><?php $L->p( 'Custom Fields for Templates' ); ?></h2>

<p><?php $L->p( 'The Configure 8 theme provides custom content fields for posts, pages, and various theme features. These fields can be added via the options interface or added manually by copying the code into the text box in Settings > Custom Fields.' ); ?></p>

<p><?php $L->p( 'If fields are added manually, various options of custom fields may be modified, such as label, placeholder, location, but the field name must remain as listed here as these field names are hard-coded into the theme.' ); ?></p>

<p><?php $L->p( 'When adding fields manually, the JSON code for each field must be separated by commas, and all fields must be inside curly ( <code>{}</code> ) braces. See example below of all Configure 8 custom fields.' ); ?></p>

<p><?php $L->p( 'Note that Bludit only offers two types of custom fields: checkbox and text.' ); ?></p>

<h3 class="form-heading"><?php $L->p( 'Random Cover Image' ); ?></h3>

<p><?php $L->p( 'This is a checkbox field. Displays a random cover image from images uploaded to the page.' ); ?></p>

<pre>
"random_cover": {
	"type": "bool",
	"label": "Random Cover",
	"tip": "Display a random cover image from images uploaded to this page. Requires no cover image set."
}
</pre>

<h3 class="form-heading"><?php $L->p( 'Menu Label' ); ?></h3>

<p><?php $L->p( 'This is a text field. Text for the page link in the navigation menus.' ); ?></p>
<p><?php $L->p( 'This field, if it contains text, will supersede other menu label options.' ); ?></p>

<pre>
"menu_label": {
	"type": "string",
	"label": "Menu Label",
	"tip": "Text used in the navigation menus."
}
</pre>

<h3 class="form-heading"><?php $L->p( 'Image Gallery' ); ?></h3>

<p><?php $L->p( 'This is a checkbox field. Adds a gallery of images uploaded to the post/page.' ); ?></p>
<p><?php $L->p( 'The gallery is displayed below the post/page main content.' ); ?></p>

<pre>
"page_gallery": {
	"type": "bool",
	"label": "Gallery",
	"tip": "Add a gallery of images uploaded to this page."
}
</pre>

<h3 class="form-heading"><?php $L->p( 'Gallery Heading' ); ?></h3>

<p><?php $L->p( 'This is a text field. Text used above the post/page\'s image gallery.' ); ?></p>

<pre>
"gallery_heading": {
	"type": "string",
	"label": "Gallery Heading",
	"tip": "Text used above this page's image gallery.",
	"placeholder": "Image Gallery"
}
</pre>

<h3 class="form-heading"><?php $L->p( 'Read More Link' ); ?></h3>

<p><?php $L->p( 'This is a text field. Text used if the content is linked in the front page slider or when abbreviated in some contexts.' ); ?></p>

<pre>
"read_more": {
	"type": "string",
	"label": "Read Link",
	"tip": "Text used if this content is linked in the front page slider or when abbreviated in some contexts."
}
</pre>

<h3 class="form-heading"><?php $L->p( 'All Configure 8 Custom Fields' ); ?></h3>

<p><?php $L->p( 'The following is all theme fields as in the Bludit setting text area, including necessary braces around them.' ); ?></p>

<pre>
{
	"menu_label": {
		"type": "string",
		"label": "Menu Label",
		"tip": "Text used in the navigation menus."
	},
	"random_cover": {
		"type": "bool",
		"label": "Random Cover",
		"tip": "Display a random cover image from images uploaded to this page. Requires no cover image set."
	},
	"page_gallery": {
		"type": "bool",
		"label": "Gallery",
		"tip": "Add a gallery of images uploaded to this page."
	},
	"gallery_heading": {
		"type": "string",
		"label": "Gallery Heading",
		"tip": "Text used above this page's image gallery.",
		"placeholder": "Image Gallery"
	},
	"read_more": {
		"type": "string",
		"label": "Read Link",
		"tip": "Text used if this content is linked in the front page slider or when abbreviated in some contexts."
	}
}
</pre>
