<?php
/**
 * Guide page info tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 *
 * @todo Monitor accuracy of translation message.
 */

// Theme name.
$theme = 'Configure 8';

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';

// Font schemes page URL.
$fonts_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=fonts';

// Database page URL.
$database_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=database';

//Search plugin URLs.
$s_settings = DOMAIN_ADMIN . 'configure-plugin/Search_Forms';
$s_guide    = DOMAIN_ADMIN . 'plugin/Search_Forms';

?>

<h2 class="form-heading"><?php $L->p( 'Reference Pages' ); ?></h2>

<p><?php $L->p( 'This options guide includes several separate reference pages:' ); ?></p>
<ul style="list-style: none; padding:0;">
	<li><a href="<?php echo $colors_page; ?>"><strong><?php $L->p( 'Color Schemes' ); ?></strong></a></li>
	<li><a href="<?php echo $fonts_page; ?>"><strong><?php $L->p( 'Font Schemes' ); ?></strong></a></li>
	<li><a href="<?php echo $database_page; ?>"><strong><?php $L->p( 'Options Database' ); ?></strong></a></li>
</ul>

<h2 class="form-heading"><?php $L->p( 'Compatibility' ); ?></h2>

<p><?php $L->p( "The {$theme} theme was designed with great extensibility by plugins. All of the core plugin hooks are included and placed in appropriate positions in the various template parts. That said, we cannot maintain compatibility for all plugins nor take responsibility for poorly developed plugins. If there is a plugin hook you would like to have us include, please see the support tab." ); ?></p>

<p><?php $L->p( 'Custom plugin hooks have been created and are included included in various template locations, where features and supplemental content may be displayed.' ); ?></p>

<h2 class="form-heading"><?php $L->p( 'Search Functionality' ); ?></h2>

<p><?php $L->p( "The core search plugin, simply named 'Search', is supported and will display a search form in the site sidebar. However, to take full advantage of the search form options, we recommend using the 'Search Forms' plugin, developed by us for use in the {$theme} theme." ); ?></p>

<?php if ( ! getPlugin( 'Search_Forms' ) ) : ?>

<p><?php $L->p( 'There can only be one functional instance of the core search plugin per page without causing a JavaScript conflict. The Search Forms plugin creates unique JavaScript for each instance of a search form, so more than one form may be used on one page. Also there are more options available for each form, including options for the sidebar search form which require no coding.' ); ?></p>

<p><?php $L->p( "If you downloaded the full {$theme} suite then you should have received a copy of Search Forms. Or find it at <a href='https://github.com/Bludiot/searchforms' target='_blank' rel='noopener noreferrer'>https://github.com/Bludiot/searchforms</a>" ); ?></p>

<?php else : ?>

<p><?php $L->p( '<strong>Good news!</strong> You have the Search Forms plugin installed.' ); ?></p>

<p><?php $L->p( "Go to the <a href='{$s_settings}'>search settings</a> page. Developers, go to the <a href='{$s_guide}'>search guide</a> page." ); ?></p>

<?php endif; ?>

<h2 class="form-heading"><?php $L->p( 'Languages' ); ?></h2>

<p><?php $L->p( 'The public theme and the admin theme are both ready for RTL languages. Layout direction is automatically reversed where appropriate. Some are not flipped automatically due to layout options. For example, the main navigation position option includes left and right. Since this refers to the left and right sides of the screen, not the flow of the language, it is up to administrators to adjust the option for the target language.' ); ?></p>

<p><?php $L->p( 'Translation of hard-coded text is not complete. We welcome the submission of translations.' ); ?></p>

<h2 class="form-heading"><?php $L->p( 'Product Support' ); ?></h2>

<p><?php $L->p( 'Please register errors, conflicts, or other problems with the Configure 8 suite of products under the Issues tab in the relevant GitHub repository.' ); ?></p>

<p><strong class="semi-bold"><?php $L->p( 'Theme:' ); ?></strong> <a href="https://github.com/Bludiot/configureight" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight</a></p>

<p><strong class="semi-bold"><?php $L->p( 'Plugin:' ); ?></strong> <a href="https://github.com/Bludiot/configureight-plugin" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight-plugin</a></p>

<p><strong class="semi-bold"><?php $L->p( 'Admin:' ); ?></strong> <a href="https://github.com/Bludiot/configureight-admin" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight-admin</a></p>

<p><strong class="semi-bold"><?php $L->p( 'Search:' ); ?></strong> <a href="https://github.com/Bludiot/searchforms" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/searchforms</a></p>
