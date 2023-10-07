<?php
/**
 * Settings form template
 *
 * @package    Configure 8 Settings
 * @subpackage Views
 * @since      1.0.0
 */

// Page description from JSON metadata.
echo $plugin->description();

?>
<div class="tab-content" data-toggle="tabslet" data-animation="true">

	<ul class="nav nav-tabs">
		<li class="nav-item active"><a class="nav-link" href="#general">General</a></li>
		<li class="nav-item"><a class="nav-link" href="#header">Header</a></li>
		<li class="nav-item"><a class="nav-link" href="#media">Media</a></li>
		<li class="nav-item"><a class="nav-link" href="#loop">Loop</a></li>
		<li class="nav-item"><a class="nav-link" href="#sidebar">Sidebar</a></li>
		<li class="nav-item"><a class="nav-link" href="#footer">Footer</a></li>
		<li class="nav-item"><a class="nav-link" href="#styles">Styles</a></li>
	</ul>

	<div id="general" class="tab-pane active">
		<?php include( $this->phpPath() . '/views/fields-general.php' ); ?>
	</div>
	<div id="header" class="tab-pane">
		<h3>Header Options</h3>
	</div>
	<div id="media" class="tab-pane">
		<h3>Media Options</h3>
	</div>
	<div id="loop" class="tab-pane">
		<h3>Loop Options</h3>
	</div>
	<div id="sidebar" class="tab-pane">
		<h3>Sidebar Options</h3>
	</div>
	<div id="footer" class="tab-pane">
		<h3>Footer Options</h3>
	</div>
	<div id="styles" class="tab-pane">
		<?php include( $this->phpPath() . '/views/fields-appearance.php' ); ?>
	</div>
</div>
