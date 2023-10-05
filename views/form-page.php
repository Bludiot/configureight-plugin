<?php
/**
 * Settings form template
 */

// Page description from JSON metadata.
echo $plugin->description();

?>
<div class="tabs" data-toggle="tabslet" data-animation="true">

	<ul class="tabs-list">
		<li class="tab active"><a href="#general">General</a></li>
		<li class="tab"><a href="#header">Header</a></li>
		<li class="tab"><a href="#media">Media</a></li>
		<li class="tab"><a href="#loop">Loop</a></li>
		<li class="tab"><a href="#sidebar">Sidebar</a></li>
		<li class="tab"><a href="#footer">Footer</a></li>
		<li class="tab"><a href="#styles">Styles</a></li>
	</ul>

	<div id="general" class="tab-content">

		<h3>General Options</h3>

		<label class="form-label" for="page_loader"><?php $L->p('Page Loader'); ?></label>
		<select class="form-select" id="page_loader" name="page_loader">
			<option value="false" <?php ( $this->getValue( 'page_loader' ) === false ? 'selected' : '' ); ?>><?php $L->p( 'Disabled' ); ?></option>
			<option value="true" <?php ( $this->getValue( 'page_loader' ) === true ? 'selected' : '' ); ?>><?php $L->p( 'Enabled' ); ?></option>
		</select>
	</div>
	<div id="header" class="tab-content">
		<h3>Header Options</h3>
	</div>
	<div id="media" class="tab-content">
		<h3>Media Options</h3>
	</div>
	<div id="loop" class="tab-content">
		<h3>Loop Options</h3>
	</div>
	<div id="sidebar" class="tab-content">
		<h3>Sidebar Options</h3>
	</div>
	<div id="footer" class="tab-content">
		<h3>Footer Options</h3>
	</div>
	<div id="styles" class="tab-content">
		<h3>Theme Styles</h3>
	</div>
</div>
