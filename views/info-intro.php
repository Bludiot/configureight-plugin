<?php
/**
 * Guide page info tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Theme name.
$theme = 'Configure 8';

//Search plugin URLs.
$s_settings = DOMAIN_ADMIN . 'configure-plugin/Search_Forms';
$s_guide    = DOMAIN_ADMIN . 'plugin/Search_Forms';

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Compatibility' ) ] ); ?>

<p><?php $L->p( "The {$theme} theme was designed with great extensibility by plugins. All of the core plugin hooks are included and placed in appropriate positions in the various template parts. That said, we cannot maintain compatibility for all plugins nor take responsibility for poorly developed plugins. If there is a plugin hook you would like to have us include, please see the support tab." ); ?></p>

<p><?php $L->p( 'Custom plugin hooks have been created and are included included in various template locations, where features and supplemental content may be displayed.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Search Functionality' ) ] ); ?>

<p><?php $L->p( "The core search plugin, simply named 'Search', is supported and will display a search form in the site sidebar. However, to take full advantage of the search form options, we recommend using the 'Search Forms' plugin, developed by us for use in the {$theme} theme." ); ?></p>

<?php if ( ! getPlugin( 'Search_Forms' ) ) : ?>

<p><?php $L->p( 'There can only be one functional instance of the core search plugin per page without causing a JavaScript conflict. The Search Forms plugin creates unique JavaScript for each instance of a search form, so more than one form may be used on one page. Also there are more options available for each form, including options for the sidebar search form which require no coding.' ); ?></p>

<p><?php $L->p( "If you downloaded the full {$theme} suite then you should have received a copy of Search Forms. Or find it at <a href='https://github.com/Bludiot/searchforms' target='_blank' rel='noopener noreferrer'>https://github.com/Bludiot/searchforms</a>" ); ?></p>

<?php else : ?>

<p><?php $L->p( "<strong>Good news!</strong> You have the Search Forms plugin installed." ); ?></p>

<p><?php $L->p( "Go to the <a href='{$s_settings}'>search settings</a> page. Developers, go to the <a href='{$s_guide}'>search guide</a> page." ); ?></p>

<?php endif; ?>

<hr />

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Languages' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>
