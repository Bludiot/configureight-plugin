<?php
/**
 * Guide page navigation tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 *
 * @todo Monitor mobile menu text for accuracy.
 */

?>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Navigation Menu' ) ] ); ?>

<p><?php $L->p( 'The primary navigation menu in the Configure 8 theme is a great improvement on those in the vast majority of public Bludit themes. Many options are available for tailoring the menu to the needs of your website.' ); ?></p>

<p><?php $L->p( 'There are several menu item options available, including a home link, link to posts loop when not on the home page, and search & social icon links. The biggest improvement is in the ability to pick the pages that appear in the menu, rather than printing all published pages.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Menu Items' ) ] ); ?>

<p><?php $L->p( 'Aside from the home and loop links, only public, static pages are available for inclusion in the menu. Blog/news posts cannot be selected as this is not a good user-experience practice.' ); ?></p>

<p><?php $L->p( '' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Menu Options' ) ] ); ?>

<p><?php $L->p( 'Many presentation options are available for the main menu however the mobile menu is currently rather plain. Mobile menu options may be implemented in future versions of the theme.' ); ?></p>



<p><?php $L->p( '' ); ?></p>
