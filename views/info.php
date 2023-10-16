<?php
/**
 * Theme information
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Theme Information' ) ] ); ?>

<p><?php $L->p( 'The Configure 8 theme began under a different name as a starter theme, a boilerplate for developing themes for Bludit CMS. It still is is considered by its developer to be a starter theme however it now has many presentation options and the theme can be used for a simple yet attractive blog, or a small brochure site.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Available Templates' ) ] ); ?>

<p><?php $L->p( 'Several page template options are built into the theme, which can be employed in the page edit screen under Options > Advanced. More than one template may be used at once, with space between each template slug, depending on the template type.' ); ?></p>

<ul>
	<li><?php $L->p( 'Full screen cover image:' ); ?> <code class="select">full-cover</code></li>
    <li><?php $L->p( 'No sidebar:' ); ?> <code class="select">no-sidebar</code></li>
    <li><?php $L->p( 'Bottom sidebar:' ); ?> <code class="select">sidebar-bottom</code></li>
    <li><?php $L->p( 'Static front page (used automatically)' ); ?> <code class="select"></code></li>
    <li><?php $L->p( 'About page:' ); ?> <code class="select">about</code></li>
    <li><?php $L->p( 'Contact page:' ); ?> <code class="select">contact</code></li>
</ul>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Support' ) ] ); ?>

<p><a href="https://github.com/Bludiot" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot</a></p>

<p><?php $L->p( 'Let me know if you need me to develop a custom version of the Configure 8 theme for you.' ); ?></p>
