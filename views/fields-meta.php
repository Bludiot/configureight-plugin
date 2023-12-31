<?php
/**
 * Metadata fields
 *
 * @package    Configure 8 Options
 * @subpackage Views
 * @since      1.0.0
 */

// Access namespaced functions.
use function CFE_Plugin\{
	is_rtl,
	can_search
};

?>
<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Title Tag' ) ] ); ?>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Title Tag' ); ?></legend>

	<div class="form-field form-group row">
		<label class="form-label col-sm-2 col-form-label" for="title_sep"><?php $L->p( 'Title Separator' ); ?></label>
		<div class="col-sm-10">
			<div class="field-has-buttons">
				<select class="form-select" id="title_sep" name="title_sep">

					<option value="|" <?php echo ( $this->getValue( 'title_sep' ) === '|' ? 'selected' : '' ); ?>><?php $L->p( 'Pipe' ); ?> ( | )</option>

					<option value="—" <?php echo ( $this->getValue( 'title_sep' ) === '—' ? 'selected' : '' ); ?>><?php $L->p( 'Dash' ); ?> ( — )</option>

					<option value="&gt;" <?php echo ( $this->getValue( 'title_sep' ) === '&gt;' ? 'selected' : '' ); ?>><?php $L->p( 'Angle' ); ?> ( &gt; )</option>

					<option value="≫" <?php echo ( $this->getValue( 'title_sep' ) === '≫' ? 'selected' : '' ); ?>><?php $L->p( 'Double' ); ?> ( &#8811; )</option>

					<option value="→" <?php echo ( $this->getValue( 'title_sep' ) === '→' ? 'selected' : '' ); ?>><?php $L->p( 'Arrow' ); ?> ( <?php echo ( is_rtl() ? '←' : '→' ); ?> )</option>

					<option value="custom" <?php echo ( $this->getValue( 'title_sep' ) === 'custom' ? 'selected' : '' ); ?>><?php $L->p( 'Custom' ); ?></option>
				</select>
				<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#title_sep').val('<?php echo $this->dbFields['title_sep']; ?>');$( '#custom_sep' ).val('');$( '#custom_sep_wrap' ).fadeOut( 250 );"><?php $L->p( 'Default' ); ?></span>
			</div>
			<small class="form-text text-muted"><?php $L->p( 'Directional characters are adjusted for language direction.' ); ?></small>
		</div>
	</div>

	<div id="custom_sep_wrap" style="display: <?php echo ( $this->getValue( 'title_sep' ) === 'custom' ? 'block' : 'none' ); ?>;">
		<div class="form-field form-group row">
			<label class="form-label col-sm-2 col-form-label" for="custom_sep"><?php $L->p( 'Custom Separator' ); ?></label>
			<div class="col-sm-10">
				<input type="text" id="custom_sep" name="custom_sep" value="<?php echo $this->getValue( 'custom_sep' ); ?>" placeholder="<?php echo $this->dbFields['custom_sep']; ?>" />
				<small class="form-text text-muted"><?php $L->p( 'Paste or type in the custom separator character.' ); ?></small>
			</div>
		</div>
	</div>

	<div class="tab-content hide-if-no-js" data-toggle="tabslet" data-deeplinking="false" data-animation="true">

		<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Custom Titles' ) ] ); ?>

		<p><?php $L->p( 'Custom title tag formats will override the title tag function for each case listed. If the field is left empty then the built-in title for that case is used.' ); ?></p>

		<p><?php $L->p( 'Available placeholders are listed below each field for copy & paste.' ); ?></p>

		<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link" role="tab" aria-controls="ltr" aria-selected="false" href="#ltr"><?php $L->p( 'LTR Titles' ); ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" role="tab" aria-controls="rtl" aria-selected="false" href="#rtl"><?php $L->p( 'RTL Titles' ); ?></a>
			</li>
		</ul>

		<div id="ltr">

			<p><?php $L->p( 'Title formats for left-to-right languages.' ); ?></p>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="default_ttag"><?php $L->p( 'LTR Default Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="default_ttag" name="default_ttag" value="<?php echo $this->getValue( 'default_ttag' ); ?>" placeholder="{{site-title}} {{separator}} {{site-slogan}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#default_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="loop_ttag"><?php $L->p( 'LTR Loop Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="loop_ttag" name="loop_ttag" value="<?php echo $this->getValue( 'loop_ttag' ); ?>" placeholder="{{loop-type}} {{page-number}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#loop_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{loop-type}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="post_ttag"><?php $L->p( 'LTR Post Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="post_ttag" name="post_ttag" value="<?php echo $this->getValue( 'post_ttag' ); ?>" placeholder="{{page-title}} {{separator}} {{published}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#post_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{page-title}}</code>
						<code class="select">{{page-description}}</code>
						<code class="select">{{published}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="page_ttag"><?php $L->p( 'LTR Page Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="page_ttag" name="page_ttag" value="<?php echo $this->getValue( 'page_ttag' ); ?>" placeholder="{{page-title}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#page_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{page-title}}</code>
						<code class="select">{{page-description}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="cat_ttag"><?php $L->p( 'LTR Category Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="cat_ttag" name="cat_ttag" value="<?php echo $this->getValue( 'cat_ttag' ); ?>" placeholder="{{category-name}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#cat_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{category-name}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="tag_ttag"><?php $L->p( 'LTR Tag Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="tag_ttag" name="tag_ttag" value="<?php echo $this->getValue( 'tag_ttag' ); ?>" placeholder="{{tag-name}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#tag_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{tag-name}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<?php if ( can_search() ) : ?>
			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="search_ttag"><?php $L->p( 'LTR Search Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="search_ttag" name="search_ttag" value="<?php echo $this->getValue( 'search_ttag' ); ?>" placeholder="<?php $L->p( 'Searching' ); ?> {{search-terms}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#search_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{search-terms}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>
			<?php endif; ?>

			<?php if ( ! $site->pageNotFound() ) : ?>
			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="error_ttag"><?php $L->p( 'LTR 404 Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="error_ttag" name="error_ttag" value="<?php echo $this->getValue( 'error_ttag' ); ?>" placeholder="<?php $L->p( 'URL Not Found' ); ?> {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#error_ttag').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
					</small>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<div id="rtl">

			<p><?php $L->p( 'Title formats for right-to-left languages.' ); ?></p>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="default_ttag_rtl"><?php $L->p( 'RTL Default Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="default_ttag_rtl" name="default_ttag_rtl" value="<?php echo $this->getValue( 'default_ttag_rtl' ); ?>" placeholder="{{site-slogan}} {{separator}} {{site-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#default_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="loop_ttag_rtl"><?php $L->p( 'RTL Loop Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="loop_ttag_rtl" name="loop_ttag_rtl" value="<?php echo $this->getValue( 'loop_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{page-number}} {{loop-type}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#loop_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{loop-type}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="post_ttag_rtl"><?php $L->p( 'RTL Post Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="post_ttag_rtl" name="post_ttag_rtl" value="<?php echo $this->getValue( 'post_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{published}} {{separator}} {{page-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#post_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{page-title}}</code>
						<code class="select">{{page-description}}</code>
						<code class="select">{{published}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="page_ttag_rtl"><?php $L->p( 'RTL Page Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="page_ttag_rtl" name="page_ttag_rtl" value="<?php echo $this->getValue( 'page_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{page-title}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#page_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{page-title}}</code>
						<code class="select">{{page-description}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="cat_ttag_rtl"><?php $L->p( 'RTL Category Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="cat_ttag_rtl" name="cat_ttag_rtl" value="<?php echo $this->getValue( 'cat_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{category-name}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#cat_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{category-name}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="tag_ttag_rtl"><?php $L->p( 'RTL Tag Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="tag_ttag_rtl" name="tag_ttag_rtl" value="<?php echo $this->getValue( 'tag_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{tag-name}}" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#tag_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{tag-name}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>

			<?php if ( can_search() ) : ?>
			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="search_ttag_rtl"><?php $L->p( 'RTL Search Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="search_ttag_rtl" name="search_ttag_rtl" value="<?php echo $this->getValue( 'search_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} {{search-terms}} <?php $L->p( 'Searching' ); ?>" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#search_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
						<code class="select">{{search-terms}}</code>
						<code class="select">{{page-number}}</code>
					</small>
				</div>
			</div>
			<?php endif; ?>

			<div class="form-field form-group row">
				<label class="form-label col-sm-2 col-form-label" for="error_ttag_rtl"><?php $L->p( 'RTL 404 Title' ); ?></label>
				<div class="col-sm-10">
					<div class="field-has-buttons">
						<input type="text" id="error_ttag_rtl" name="error_ttag_rtl" value="<?php echo $this->getValue( 'error_ttag_rtl' ); ?>" placeholder="{{site-title}} {{separator}} <?php $L->p( 'URL Not Found' ); ?>" />
						<span class="btn btn-secondary btn-md form-range-button hide-if-no-js" onClick="$('#error_ttag_rtl').val('');"><?php $L->p( 'Clear' ); ?></span>
					</div>
					<small class="form-text">
						<span class="text-muted"><?php $L->p( 'Placeholders:' ); ?> </span>
						<code class="select">{{separator}}</code>
						<code class="select">{{site-title}}</code>
						<code class="select">{{site-slogan}}</code>
						<code class="select">{{site-description}}</code>
					</small>
				</div>
			</div>
		</div>
	</div>
</fieldset>

<?php echo Bootstrap :: formTitle( [ 'title' => $L->g( 'Metadata Options' ) ] ); ?>

<fieldset>

	<legend class="screen-reader-text"><?php $L->p( 'Metadata' ); ?></legend>
</fieldset>
