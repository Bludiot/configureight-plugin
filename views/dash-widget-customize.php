<?php
/**
 * Dashboard widget: customize links
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Dashboard
 * @since      1.0.0
 */

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

// Guide page URL.
$guide_page = DOMAIN_ADMIN . 'plugin/' . $this->className();

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';

// Font schemes page URL.
$fonts_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=fonts';

// Database page URL.
$database_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=database';

// Categories settings page URL.
$categories_settings = DOMAIN_ADMIN . 'configure-plugin/Categories_Lists';

// Tags settings page URL.
$tags_settings = DOMAIN_ADMIN . 'configure-plugin/Tags_Lists';

// Pages settings page URL.
$pages_settings = DOMAIN_ADMIN . 'configure-plugin/Pages_Lists';

// Search settings page URL.
$search_settings = DOMAIN_ADMIN . 'configure-plugin/Search_Forms';

?>
<style>
.customize-links-list {
	list-style: none;
	margin: 0;
}
.customize-links-list li {
	margin: var( --cfe-element--margin, 0.5rem 0 0 0 );
}
.customize-links-list li a {
	text-decoration: none;
	font-weight: var( --cfe-display--font-weight, 600 );
}
</style>
<div id="dashboard-customize-links">

	<h2><?php $L->p( 'Customize This Website' ); ?></h2>

	<ul class="customize-links-list">
		<li><a href="<?php echo $settings_page; ?>"><?php $L->p( 'Theme Options' ); ?></a></li>
		<li><a href="<?php echo $guide_page; ?>"><?php $L->p( 'Theme Guide' ); ?></a></li>
		<li><a href="<?php echo $colors_page; ?>"><?php $L->p( 'Colors Reference' ); ?></a></li>
		<li><a href="<?php echo $fonts_page; ?>"><?php $L->p( 'Fonts Reference' ); ?></a></li>
		<?php if ( getPlugin( 'Search_Forms' ) ) : ?>
		<li><a href="<?php echo $search_settings; ?>"><?php $L->p( 'Search Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Categories_Lists' ) ) : ?>
		<li><a href="<?php echo $categories_settings; ?>"><?php $L->p( 'Categories Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Tags_Lists' ) ) : ?>
		<li><a href="<?php echo $tags_settings; ?>"><?php $L->p( 'Tags Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Pages_Lists' ) ) : ?>
		<li><a href="<?php echo $pages_settings; ?>"><?php $L->p( 'Pages Options' ); ?></a></li>
		<?php endif; ?>
		<li><a href="<?php echo $database_page; ?>"><?php $L->p( 'Options Database' ); ?></a></li>
	</ul>
</div>
