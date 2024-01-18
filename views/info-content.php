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

<p><?php $L->p( 'Image upload fields coming for bookmark icon (favicon) and default cover image. For now, the options require you to use complete URLs, such as to CDN images, add the images to the theme\'s assets/images directory, or add to the bl-content/uploads directory. The theme will look first in the bl-content/uploads directory if not using an external image.' ); ?></p>

<p><?php $L->p( 'For both the bookmark icon and the default cover fields, simply add the URL, or add filename & extension (e.g. favicon.png or cover.jpg).' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Content Loops' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Singular Content' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>



<p><?php $L->p( '' ); ?></p>
