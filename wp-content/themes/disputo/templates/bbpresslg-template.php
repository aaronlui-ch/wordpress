<?php if (class_exists( 'bbPress' )) { ?>
<form role="search" method="get" id="bbp-header-search-form" action="<?php bbp_search_url(); ?>">
	<div class="input-group">
		<input type="hidden" name="action" value="bbp-search-request" />
		<input tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" class="form-control" placeholder="<?php esc_attr_e('Enter a keyword...', 'disputo'); ?>" />
        <div class="input-group-append"> 
            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
        </div>
	</div>
</form>
<?php } else { ?>
<?php $disputo_search_exclude_pages = get_theme_mod( 'disputo_search_exclude_pages' ); ?>
<form role="search" method="get" id="disputo-header-search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="input-group">
    <input type="text" class="form-control" placeholder="<?php esc_attr_e('Enter a keyword...', 'disputo'); ?>" name="s" />
        <div class="input-group-append"> 
            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
            <?php if ($disputo_search_exclude_pages) { ?>
                <input type="hidden" name="post_type" value="post" /> 
            <?php } ?>
        </div>
    </div>
</form>
<?php } ?>