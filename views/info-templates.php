<?php
/**
 * Guide page templates tab
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

?>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Available Page Templates' ) ] ); ?>

<p><?php $L->p( 'Several template options are built into the theme, which can be employed in the page edit screen under Options > Advanced. These are available for posts in the loop as well as for static pages. More than one template may be used at once, with space between each template slug, depending on the template type.' ); ?></p>

<hr />

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Front Page' ) ] ); ?>

<p><?php $L->p( 'The front page template is used automatically when a page or post is set in Settings > Advanced > Homepage. So no template slug is needed for this template.' ); ?></p>

<p><?php $L->p( 'Out of the box, the front page template is identical to the static page template. It is provided so that developers only need to edit one file to create a distinct layout for the front page.' ); ?></p>

<p><?php $L->p( 'However, the page used as the front page accepts the optional templates so, for example, without editing the front page template you can set the page to have a full-screen cover image and no sidebar ( <code class="select">full-cover no-sidebar</code> ).' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Posts Loop' ) ] ); ?>

<p><?php $L->p( 'There are several templates used automatically based on the default sidebar layout and the loop content style options.' ); ?></p>

<p><?php $L->p( 'When using a static page for the posts loop, a sidebar template sidebar template can be used to override the default sidebar layout. Only applies to the main posts index, not to taxonomy and search loops.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Post Page' ) ] ); ?>

<p><?php $L->p( 'No slug needed. The post template is used automatically for any standard page that appears in the loop, not static pages.' ); ?></p>

<p><?php $L->p( 'This template displays post metadata that is not displayed on static pages, such as date, author, category, tags, etc. This also displays related posts. Options are available under the Page tab for the post data and elements to be displayed.' ); ?></p>

<p><?php $L->p( 'Posts accept the template options for cover image and sidebar on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Sticky Post' ) ] ); ?>

<p><?php $L->p( 'No slug needed. The sticky template is used automatically for any standard post that has been set to sticky.' ); ?></p>

<p><?php $L->p( 'Out of the box, this template is identical to the standard post template. It is provided so that developers only need to edit one file to create a distinct layout for sticky posts.' ); ?></p>

<p><?php $L->p( 'Sticky posts accept the template options for cover image and sidebar on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Static Page' ) ] ); ?>

<p><?php $L->p( 'No slug needed.  The static template is used automatically for any page that has been set to static. It does not display metadata such as date & author, only the content from the editor field. No related pages are displayed.' ); ?></p>

<p><?php $L->p( 'Static pages accept the template options for cover image and sidebar, as well as the content-based template options, on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Full-Screen Cover' ) ] ); ?>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Sticky Header' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">full-cover</code></p>

<p><?php $L->p( 'The full-screen cover template uses the page\'s cover image to fill the viewport at the top of the page as a background for the header, navigation, title & description. If a page does not have a cover image set then the default cover image is used. There is an option for the color and opacity of the image overlay.' ); ?></p>

<p><?php $L->p( 'This template is available to posts, sticky posts, and static pages on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Default Cover' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">default-cover</code></p>

<p><?php $L->p( 'The default cover template will display the cover image banner below the header of a post or a page when viewing the singular template. This can be used to override the default post/page cover option.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'No Cover' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">no-cover</code></p>

<p><?php $L->p( 'The no cover template will hide the cover image of a post or a page when viewing the singular template. The cover image remains intact for loops and meta data.' ); ?></p>

<p><?php $L->p( 'This template is available to posts, sticky posts, and static pages on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Color Scheme' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">color-scheme-$slug</code></p>

<p><?php $L->p( 'The color scheme template overrides the current color scheme to allow for color schemes on a per page basis. Simply add the template slug where <code>$slug</code> is the slug of the color scheme.' ); ?></p>

<p><?php $L->p( 'Example: the template <code>color-scheme-forest</code> will apply the Forest color scheme to that page or post.' ); ?></p>

<hr />

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Sidebar Templates' ) ] ); ?>

<p><?php $L->p( 'Sidebar templates are available to posts, sticky posts, and static pages on an individual basis. They have no associated file, using body classes and CSS to affect when and where to display the sidebar.' ); ?></p>

<p><?php $L->p( "The <a href='{$settings_page}#sidebar'>Sidebar in Pages</a> option can be overridden by a sidebar template. For instance, if the default is set to display the sidebar below the content, a page with the <code class='select'>sidebar-side</code> template will move the sidebar to the side of the content." ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Standard Sidebar' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">sidebar-side</code></p>

<p><?php $L->p( 'The standard sidebar template displays sidebar widgets to the side of the main content. This will override the default sidebar layout option.' ); ?></p>

<p><?php $L->p( 'This template is available to posts, sticky posts, and static pages on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Bottom Sidebar' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">sidebar-bottom</code></p>

<p><?php $L->p( 'The bottom sidebar template moves the sidebar widgets to below the main content and sets the main content to full width. Widgets display as a grid. This will override the default sidebar layout option.' ); ?></p>

<p><?php $L->p( 'This template is available to posts, sticky posts, and static pages on an individual basis.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'No Sidebar' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">no-sidebar</code></p>

<p><?php $L->p( 'The no sidebar template does not load any sidebar widgets and sets the main content to full width. This will override the default sidebar layout option.' ); ?></p>

<p><?php $L->p( 'This template is available to posts, sticky posts, and static pages on an individual basis.' ); ?></p>

<hr />

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'About Page' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">about</code></p>

<p><?php $L->p( 'Out of the box, this template is identical to the static page template. It is provided so that developers only need to edit one file to create a distinct layout for an about page.' ); ?></p>

<p><?php $L->p( 'This template is available to static pages only.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Contact Page' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">contact</code></p>

<p><?php $L->p( 'Out of the box, this template is identical to the static page template. It is provided so that developers only need to edit one file to create a distinct layout for a contact page.' ); ?></p>

<p><?php $L->p( 'This template is available to static pages only.' ); ?></p>

<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( '404 Error Page' ) ] ); ?>

<p><?php $L->p( 'Template slug:' ); ?> <code class="select">404</code></p>

<p><?php $L->p( 'The 404 error template optionally displays a search form and navigation lists as suggested user actions. This template is available to a static page that has been set in Settings > Advanced > Page not found.' ); ?></p>
