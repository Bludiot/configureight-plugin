<?php
/**
 * Navigation options fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

 use function CFE_Plugin\{
	static_for_nav
 };

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Navigation Options' ) ] ); ?>
<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Navigation' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pages"><?php $L->p( 'Pages in Menu' ); ?></label>
		<div class="col-sm-10">
			<small class="form-text"><?php $L->p( 'Which static pages shall display in the main navigation menu. Use the page position feature on page edit screens to set the menu order. At least one page is required.' ); ?></small>

			<div id="main-nav-pages-wrap" class="multi-check-wrap">

 				<?php

				$static  = buildStaticPages();
				$count_p = 0;
				$count_c = 0;
				if ( $static ) : foreach ( $static as $page ) :

					$relation = '';
					$title    = $L->get( 'Standalone page' );

					if ( $page->hasChildren() ) {

						$count_p++;
						$children    = $page->children();
						$child_names = [];
						foreach ( $children as $child ) {
							$child_names[] = $child->title();
						}
						asort( $child_names );
						$children = implode( ', ', $child_names );
						$relation = ' ' . $L->get( '(p)' );
						$title    = $L->get( 'Parent to ' ) . $children;

					} elseif ( $page->isChild() ) {

						$count_c++;
						$parent = new \Page( $page->key() );
						$relation = ' ' . $L->get( '(c)' );
						$title    = $L->get( 'Child of ' . $parent->title() );
					}

					if ( $page->key() === $site->homepage() ) {
						echo '';
					} elseif ( $page->slug() === str_replace( '/', '', $site->getField( 'uriBlog' ) ) ) {
						echo '';
					} elseif ( $page->slug() === $site->pageNotFound() ) {
						echo '';
					} else {
						printf(
							'<label class="check-label-wrap" for="page-%s" title="%s"><input type="checkbox" name="main_nav_pages[]" id="page-%s" value="%s" %s> %s%s</label>',
							$page->key(),
							$title,
							$page->key(),
							$page->key(),
							( is_array( $this->main_nav_pages() ) && in_array( $page->key(), $this->main_nav_pages() ) ? 'checked' : '' ),
							$page->title(),
							$relation
						);
					}
				endforeach; endif;

				$title = $L->get( 'Posts loop index' );
				if ( $site->homepage() ) {
					$title = $L->get( 'Static front page' );
				}
				printf(
					'<label class="check-label-wrap" for="page-home" title="%s"><input type="checkbox" name="main_nav_pages[]" id="page-home" value="home" %s> %s</label>',
					$title,
					( is_array( $this->main_nav_pages() ) && in_array( 'home', $this->main_nav_pages() ) ? 'checked' : '' ),
					$L->get( 'Home' )
				); ?>
			</div>
			<?php if ( $count_p > 0 || $count_c > 0 ) : ?>
			<small class="form-text text-muted"><?php $L->p( 'Hover parent pages (p) and child pages (c) to view the page relationship.' ); ?></small>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop"><?php $L->p( 'Posts Loop Link' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_loop" name="main_nav_loop">

				<option value="before" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'before' ? 'selected' : '' ); ?>><?php $L->p( 'Before Pages' ); ?></option>

				<option value="after" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'after' ? 'selected' : '' ); ?>><?php $L->p( 'After Pages' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_loop' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'No Link' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a link to the posts loop, blog or news.' ); ?></small>
		</div>
	</div>

	<div id="main_nav_loop_label_wrap" class="form-field form-group row" style="display: <?php echo ( $this->getValue( 'main_nav_loop' ) != 'none' ? 'flex' : 'none' ); ?>;">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_loop_label"><?php $L->p( 'Loop Link Label' ); ?></label>
		<div class="col-sm-10">
			<input type="text" id="main_nav_loop_label" name="main_nav_loop_label" value="<?php echo $this->getValue( 'main_nav_loop_label' ); ?>" placeholder="<?php echo $this->dbFields['main_nav_loop_label']; ?>" />
			<small class="form-text text-muted"><?php $L->p( 'The label for the loop link in the main navigation.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_labels"><?php $L->p( 'Menu Labels' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_labels" name="main_nav_labels">

				<option value="slug" <?php echo ( $this->getValue( 'main_nav_labels' ) === 'slug' ? 'selected' : '' ); ?>><?php $L->p( 'Friendly URL' ); ?></option>

				<option value="title" <?php echo ( $this->getValue( 'main_nav_labels' ) === 'title' ? 'selected' : '' ); ?>><?php $L->p( 'Page Title' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The text to be displayed in the page links.<br />The Friendly URL, also referred to as the page slug, will display capitalized with dashes and underscores removed.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_children"><?php $L->p( 'Child Pages' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_children" name="main_nav_children">

				<option value="secondary" <?php echo ( $this->getValue( 'main_nav_children' ) === 'secondary' ? 'selected' : '' ); ?>><?php $L->p( 'Sub Menu of Parents' ); ?></option>

				<option value="primary" <?php echo ( $this->getValue( 'main_nav_children' ) === 'primary' ? 'selected' : '' ); ?>><?php $L->p( 'Top Level with Parents' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'How to treat child pages in the menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_pos"><?php $L->p( 'Navigation Position' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_pos" name="main_nav_pos">

				<option value="right" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'right' ? 'selected' : '' ); ?>><?php $L->p( 'Right of Site Branding' ); ?></option>

				<option value="left" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'left' ? 'selected' : '' ); ?>><?php $L->p( 'Left of Site Branding' ); ?></option>

				<option value="above" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'above' ? 'selected' : '' ); ?>><?php $L->p( 'Above Site Branding' ); ?></option>

				<option value="below" <?php echo ( $this->getValue( 'main_nav_pos' ) === 'below' ? 'selected' : '' ); ?>><?php $L->p( 'Below Site Branding' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Right and left options will be reversed for right-to-left languages.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="main_nav_icon"><?php $L->p( 'Menu Icon' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="main_nav_icon" name="main_nav_icon">

				<option value="bars" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'bars' ? 'selected' : '' ); ?>><?php $L->p( 'Bars' ); ?></option>

				<option value="dots" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'dots' ? 'selected' : '' ); ?>><?php $L->p( 'Dots' ); ?></option>

				<option value="none" <?php echo ( $this->getValue( 'main_nav_icon' ) === 'none' ? 'selected' : '' ); ?>><?php $L->p( 'None (Text)' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'The icon to toggle the mobile menu.' ); ?></small>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_search"><?php $L->p( 'Search Button' ); ?></label>
		<div class="col-sm-10">
			<?php

			// If the Search plugin is installed and activated.
			if ( getPlugin( 'Search_Forms' ) ) : ?>
			<select class="form-select" id="header_search" name="header_search">
				<option value="true" <?php echo ( $this->getValue( 'header_search' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_search' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display a search icon in the navigation to toggle the header search bar.' ); ?></small>
			<?php

			// If the Search plugin is installed and not activated.
			elseif ( class_exists( 'Search_Forms' ) ) : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please activate the Search Forms plugin:' ),
					DOMAIN_ADMIN . 'install-plugin/Search_Forms',
					DOMAIN_ADMIN . 'install-plugin/Search_Forms'
				); ?>
			<?php

			// If the Search plugin is not installed in bl-plugins.
			else : ?>
				<?php printf(
					'<p class="form-text">%s<br /><a href="%s">%s</a></p>',
					$L->get( 'Please download, install, and activate the Search Forms plugin:' ),
					'https://github.com/Bludiot/searchforms',
					$L->get( 'GitHub Repository' )
				); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="header_social"><?php $L->p( 'Social Links' ); ?></label>
		<div class="col-sm-10">
			<select class="form-select" id="header_social" name="header_social">
				<option value="true" <?php echo ( $this->getValue( 'header_social' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Show' ); ?></option>
				<option value="false" <?php echo ( $this->getValue( 'header_social' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Hide' ); ?></option>
			</select>
			<small class="form-text text-muted"><?php $L->p( 'Display links to social media sites. See Settings > General > Social Networks in the admin menu to enter links.' ); ?></small>
		</div>
	</div>
</fieldset>
