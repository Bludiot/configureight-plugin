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

// Add class class to 'js' to `<body>` if JavaScript is enabled.
echo "<script>var bodyClass = document.body;bodyClass.classList ? bodyClass.classList.add('js') : bodyClass.className += ' js';</script>\n";

?>

<?php echo Bootstrap :: pageTitle( [ 'title' => $L->g( 'Theme Guide' ), 'icon' => 'book' ] ); ?>

<div class="alert alert-primary alert-search-forms" role="alert">
	<p class="m-0"><?php $L->p( "Go to the <a href='{$settings_page}'>theme options</a> page." ); ?></p>
</div>

<button id="preamble-dismiss" class="button hide-if-no-js" style="float: right;"><?php $L->p( 'Dismiss' ); ?></button>

<div id="preamble">

	<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'About the Configure 8 Suite' ) ] ); ?>

	<p><?php $L->p( 'The Configure 8 began as a simple starter theme under a different name, a boilerplate for developing themes for Bludit CMS. I still considered it to be a starter theme however it now has many presentation options, available via its companion plugin, and a companion admin theme is also available for a cohesive website experience.' ); ?></p>

	<p><?php $L->p( 'The theme can be used as it is for a simple yet attractive blog, or a small brochure site. And if you want to develop a unique theme for your needs then the Configure 8 suite gives you a good head start.' ); ?></p>

	<p class="cite">Greg Sweet, Controlled Chaos Design/Bludiot</p>
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
			<a class="nav-link" role="tab" aria-controls="schemes" aria-selected="false" href="#schemes"><?php $L->p( 'Schemes' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="admin" aria-selected="false" href="#admin"><?php $L->p( 'Admin' ); ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" role="tab" aria-controls="support" aria-selected="false" href="#support"><?php $L->p( 'Support' ); ?></a>
		</li>
	</ul>

	<div id="intro" class="tab-pane" role="tabpanel" aria-labelledby="intro">
		<?php include( $this->phpPath() . '/views/info-intro.php' ); ?>
	</div>

	<div id="templates" class="tab-pane" role="tabpanel" aria-labelledby="templates">
		<?php include( $this->phpPath() . '/views/info-templates.php' ); ?>
	</div>

	<div id="schemes" class="tab-pane" role="tabpanel" aria-labelledby="schemes">

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Design Schemes' ) ] ); ?>
	</div>

	<div id="admin" class="tab-pane" role="tabpanel" aria-labelledby="admin">

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Admin Themes' ) ] ); ?>
	</div>

	<div id="support" class="tab-pane" role="tabpanel" aria-labelledby="support">

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Product Support' ) ] ); ?>

		<p><?php $L->p( 'Please register errors, conflicts, or other problems with the Configure 8 suite of products under the Issues tab in the relevant GitHub repository.' ); ?></p>

		<p><strong class="semi-bold"><?php $L->p( 'Theme:' ); ?></strong> <a href="https://github.com/Bludiot/configureight" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight</a></p>

		<p><strong class="semi-bold"><?php $L->p( 'Plugin:' ); ?></strong> <a href="https://github.com/Bludiot/configureight-plugin" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight-plugin</a></p>

		<p><strong class="semi-bold"><?php $L->p( 'Admin:' ); ?></strong> <a href="https://github.com/Bludiot/configureight-admin" target="_blank" rel="noopener noreferrer">https://github.com/Bludiot/configureight-admin</a></p>

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Support Bludiot' ) ] ); ?>

		<p><?php $L->p( 'Let me know if you need me to develop a custom version of Configure 8 for you.' ); ?></p>

		<p class="cite">Greg Sweet, Controlled Chaos Design/Bludiot</p>
	</div>
</div>

<script>
// Dismiss the intro content.
const preamble = document.querySelector( '#preamble' );
const dismiss  = document.querySelector( '#preamble-dismiss' );

if ( localStorage.getItem( 'preambleDismiss' ) ) {
	preamble.style.display = 'none';
	dismiss.style.display  = 'none';
}

if ( dismiss ) {
	dismiss.addEventListener( 'click', event => {
		event.preventDefault();
		dismiss.classList.add( 'hidden' );
		preamble.classList.add( 'hidden' );
		localStorage.setItem( 'preambleDismiss', true );
	} )
}
</script>
