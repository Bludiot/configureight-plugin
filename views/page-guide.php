<?php
/**
 * Configure 8 Guide page
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @category   Guide page
 * @since      1.0.0
 */

// Settings page URL.
$settings_page = DOMAIN_ADMIN . 'configure-plugin/' . $this->className();

// Color schemes page URL.
$colors_page = DOMAIN_ADMIN . 'plugin/' . $this->className() . '?page=colors';

?>

<?php echo Bootstrap :: pageTitle( [ 'element' => 'h1', 'title' => $L->g( 'Theme Guide' ), 'icon' => 'book' ] ); ?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$colors_page}'>color scheme reference</a> page. Go to the <a href='{$settings_page}'>theme options</a> page." ); ?></p>
</div>

<div class="tab-content" data-toggle="tabslet" data-deeplinking="true" data-animation="true">

	<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="intro" aria-selected="false" href="#intro"><?php $L->p( 'Intro' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="templates" aria-selected="false" href="#templates"><?php $L->p( 'Templates' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="nav" aria-selected="false" href="#nav"><?php $L->p( 'Menu' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="content" aria-selected="false" href="#content"><?php $L->p( 'Content' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="style" aria-selected="false" href="#style"><?php $L->p( 'Style' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="admin" aria-selected="false" href="#admin"><?php $L->p( 'Admin' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="plugins" aria-selected="false" href="#plugins"><?php $L->p( 'Plugins' ); ?></a>
		</li>
	</ul>

	<div id="intro" class="tab-pane" role="tabpanel" aria-labelledby="intro">
		<?php include( $this->phpPath() . '/views/info-intro.php' ); ?>
	</div>

	<div id="templates" class="tab-pane" role="tabpanel" aria-labelledby="templates">
		<?php include( $this->phpPath() . '/views/info-templates.php' ); ?>
	</div>

	<div id="nav" class="tab-pane" role="tabpanel" aria-labelledby="nav">
		<?php include( $this->phpPath() . '/views/info-nav-menu.php' ); ?>
	</div>

	<div id="content" class="tab-pane" role="tabpanel" aria-labelledby="content">
		<?php include( $this->phpPath() . '/views/info-content.php' ); ?>
	</div>

	<div id="style" class="tab-pane" role="tabpanel" aria-labelledby="style">
		<?php include( $this->phpPath() . '/views/info-style.php' ); ?>
	</div>

	<div id="admin" class="tab-pane" role="tabpanel" aria-labelledby="admin">

		<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Admin Themes' ) ] ); ?>
	</div>

	<div id="plugins" class="tab-pane" role="tabpanel" aria-labelledby="plugins">

		<?php echo Bootstrap :: formTitle( [ 'element' => 'h3', 'title' => $L->g( 'Companion Plugins' ) ] ); ?>
	</div>
</div>
