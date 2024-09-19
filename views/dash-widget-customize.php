<?php
/**
 * Dashboard widget: customize links
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Dashboard
 * @since      1.0.0
 */

// Admin page links.
$settings = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();
$guide    = DOMAIN_ADMIN . 'plugin/' . $this->className();
$colors   = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';
$fonts    = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=fonts';
$database = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=database';
$cats     = DOMAIN_ADMIN . 'configure-plugin/Categories_Lists';
$tags     = DOMAIN_ADMIN . 'configure-plugin/Tags_Lists';
$pages    = DOMAIN_ADMIN . 'configure-plugin/Pages_Lists';
$posts    = DOMAIN_ADMIN . 'configure-plugin/Posts_Lists';
$search   = DOMAIN_ADMIN . 'configure-plugin/Search_Forms';
$comments = DOMAIN_ADMIN . 'configure-plugin/Post_Comments';
$crumbs   = DOMAIN_ADMIN . 'configure-plugin/Breadcrumbs';
$profiles = DOMAIN_ADMIN . 'configure-plugin/User_Profiles';

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
		<li><a href="<?php echo $settings; ?>"><?php $L->p( 'Theme Options' ); ?></a></li>
		<li><a href="<?php echo $guide; ?>"><?php $L->p( 'Theme Guide' ); ?></a></li>
		<li><a href="<?php echo $colors; ?>"><?php $L->p( 'Colors Reference' ); ?></a></li>
		<li><a href="<?php echo $fonts; ?>"><?php $L->p( 'Fonts Reference' ); ?></a></li>
		<?php if ( getPlugin( 'Search_Forms' ) ) : ?>
		<li><a href="<?php echo $search; ?>"><?php $L->p( 'Search Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'User_Profiles' ) ) : ?>
		<li><a href="<?php echo $profiles; ?>"><?php $L->p( 'User Profiles' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Post_Comments' ) ) : ?>
		<li><a href="<?php echo $comments; ?>"><?php $L->p( 'Post Comments' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Breadcrumbs' ) ) : ?>
		<li><a href="<?php echo $crumbs; ?>"><?php $L->p( 'Breadcrumbs' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Categories_Lists' ) ) : ?>
		<li><a href="<?php echo $cats; ?>"><?php $L->p( 'Categories Lists Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Tags_Lists' ) ) : ?>
		<li><a href="<?php echo $tags; ?>"><?php $L->p( 'Tags Lists Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Posts_Lists' ) ) : ?>
		<li><a href="<?php echo $posts; ?>"><?php $L->p( 'Posts Lists Options' ); ?></a></li>
		<?php endif; ?>
		<?php if ( getPlugin( 'Pages_Lists' ) ) : ?>
		<li><a href="<?php echo $pages; ?>"><?php $L->p( 'Pages Lists Options' ); ?></a></li>
		<?php endif; ?>
		<li><a href="<?php echo $database; ?>"><?php $L->p( 'Options Databases' ); ?></a></li>
	</ul>
</div>
