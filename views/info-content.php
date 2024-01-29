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

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Custom Fields' ) ] ); ?>

<p><?php $L->p( 'The Configure 8 theme is prepare to apply custom content fields for posts, pages, and various theme features. To take advantage of these fields simply copy the code into the text box in Settings > Custom Fields.' ); ?></p>

<p><?php $L->p( 'Various options of custom fields may be modified, such as label, placeholder, location, but the field name must remain as listed here as these field names are hard-coded into the theme.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Post/Page Subtitle' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>

<pre>
{
    "subtitle" : {
        "type" : "string",
        "placeholder" : "Subtitle"
    }
}
</pre>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Post/Page Gallery' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>

<pre></pre>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Slider More Link' ) ] ); ?>

<p><?php $L->p( '' ); ?></p>

<pre></pre>

<p><?php $L->p( '' ); ?></p>
<p><?php $L->p( '' ); ?></p>
