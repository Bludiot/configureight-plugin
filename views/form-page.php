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

// Add class class to 'js' to `<body>` if JavaScript is enabled.
echo "<script>var bodyClass = document.body;bodyClass.classList ? bodyClass.classList.add('js') : bodyClass.className += ' js';</script>\n";

?>
<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="general" aria-selected="false" href="#general"><?php $L->p( 'General' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="header" aria-selected="false" href="#header"><?php $L->p( 'Header' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="media" aria-selected="false" href="#media"><?php $L->p( 'Media' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="loop" aria-selected="false" href="#loop"><?php $L->p( 'Loop' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="sidebar" aria-selected="false" href="#sidebar"><?php $L->p( 'Sidebar' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="footer" aria-selected="false" href="#footer"><?php $L->p( 'Footer' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="styles" aria-selected="false" href="#styles"><?php $L->p( 'Styles' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="info" aria-selected="false" href="#info"><?php $L->p( 'Info' ); ?></a>
		</li>
	</ul>

	<div id="general" class="tab-pane" role="tabpanel" aria-labelledby="general">
		<?php include( $this->phpPath() . '/views/fields-general.php' ); ?>
	</div>
	<div id="header" class="tab-pane" role="tabpanel" aria-labelledby="header">
		<?php include( $this->phpPath() . '/views/fields-header.php' ); ?>
	</div>
	<div id="media" class="tab-pane" role="tabpanel" aria-labelledby="media">
		<?php include( $this->phpPath() . '/views/fields-media.php' ); ?>
	</div>
	<div id="loop" class="tab-pane" role="tabpanel" aria-labelledby="loop">
		<?php include( $this->phpPath() . '/views/fields-loop.php' ); ?>
	</div>
	<div id="sidebar" class="tab-pane" role="tabpanel" aria-labelledby="sidebar">
		<?php include( $this->phpPath() . '/views/fields-sidebar.php' ); ?>
	</div>
	<div id="footer" class="tab-pane" role="tabpanel" aria-labelledby="footer">
		<?php include( $this->phpPath() . '/views/fields-footer.php' ); ?>
	</div>
	<div id="styles" class="tab-pane" role="tabpanel" aria-labelledby="styles">
		<?php include( $this->phpPath() . '/views/fields-appearance.php' ); ?>
	</div>
	<div id="info" class="tab-pane" role="tabpanel" aria-labelledby="info">
		<?php include( $this->phpPath() . '/views/info.php' ); ?>
	</div>
</div>
<div class="hide-if-js no-js-message">
	<h3><?php $L->p( 'Action Required!' ); ?></h3>
	<p><?php $L->p( 'Please enable JavaScript to display the options form.' ); ?></p>
</div>
