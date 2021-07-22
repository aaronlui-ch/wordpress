<?php get_header(); ?>
<?php
$disputo_no_boxed = get_theme_mod('disputo_no_boxed'); 
$disputo_archive_page_layout = esc_attr(get_theme_mod('disputo_archive_page_layout', 'twocolumnssidebar'));
$disputo_category_id = get_query_var('cat');
$disputo_cat_name = get_category($disputo_category_id)->name;
$disputo_cat_desc = get_category($disputo_category_id)->description;
?>
<div id="header-wrapper">
    <header>
        <?php get_template_part( 'templates/header', 'template'); ?>
    </header>
    <?php get_template_part( 'templates/cover', 'template'); ?>
    <div class="disputo-page-title <?php if($disputo_no_boxed) { echo 'noboxed-title'; } ?>">
        <div class="container">
        <h1><?php echo esc_attr($disputo_cat_name); ?></h1>
        <?php if (!empty($disputo_cat_desc)) { ?>
        <p><?php echo stripslashes(esc_attr($disputo_cat_desc)); ?></p>
        <?php } ?>
        </div>
    </div>
</div>
<main class="disputo-main-container">
    <div class="container">
    <div id="disputo-main-inner" class="<?php if (empty($disputo_cat_name)) { ?>nomargin<?php } ?> <?php if($disputo_no_boxed) { echo 'nomargin noboxed'; } ?>">
        <?php if ($disputo_archive_page_layout == 'twocolumns') { ?>
            <div class="disputo-masonry-grid">
                <div class="disputo-two-columns" data-columns>
                    <?php while(have_posts()) : the_post(); ?>
                    <?php get_template_part( 'templates/masonry', 'template'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
            <div class="disputo-pager">
                <?php disputo_pagination(); ?>
            </div> 
            <div class="clearfix"></div>    
            <?php endif; ?>
            <?php } else if ($disputo_archive_page_layout == 'threecolumns') { ?>
            <div class="disputo-masonry-grid">
                <div class="disputo-three-columns" data-columns>
                    <?php while(have_posts()) : the_post(); ?>
                    <?php get_template_part( 'templates/masonry', 'template'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                <div class="disputo-pager">
                    <?php disputo_pagination(); ?>
                </div> 
                <div class="clearfix"></div>    
            <?php endif; ?>
            <?php } else if ($disputo_archive_page_layout == 'fourcolumns') { ?>
            <div class="disputo-masonry-grid">
                <div class="disputo-four-columns" data-columns>
            <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part( 'templates/xsmasonry', 'template'); ?>
            <?php endwhile; ?>
                </div>
            </div>
            <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                <div class="disputo-pager">
                    <?php disputo_pagination(); ?>
                </div> 
                <div class="clearfix"></div>    
            <?php endif; ?>
            <?php } else if ($disputo_archive_page_layout == 'onecolumn') { ?> 
            <div class="disputo-page-left <?php if ( !is_active_sidebar( 'disputo_sidebar' ) ) { ?>disputo-page-full<?php } ?>">       
                <div class="disputo-masonry-grid">
                    <div class="disputo-one-column" data-columns>
                <?php while(have_posts()) : the_post(); ?>
                <?php get_template_part( 'templates/lgmasonry', 'template'); ?>
                <?php endwhile; ?>
                    </div>
                </div>
                <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                    <div class="disputo-pager">
                        <?php disputo_pagination(); ?>
                    </div> 
                    <div class="clearfix"></div>    
                <?php endif; ?> 
            </div>
            <?php if ( is_active_sidebar( 'disputo_sidebar' ) ) { ?>
            <aside class="disputo-page-right">
                <?php dynamic_sidebar( 'disputo_sidebar' ); ?>
            </aside>
            <?php } ?>
            <div class="clearfix"></div>
            <?php } else { ?>  
            <div class="disputo-page-left <?php if ( !is_active_sidebar( 'disputo_sidebar' ) ) { ?>disputo-page-full<?php } ?>">        
                <div class="disputo-masonry-grid">
                    <div class="disputo-two-columns" data-columns>
                <?php while(have_posts()) : the_post(); ?>
                <?php get_template_part( 'templates/masonry', 'template'); ?>
                <?php endwhile; ?>
                    </div>
                </div>
                <?php if ( (get_next_posts_link()) || (get_previous_posts_link())) : ?>
                    <div class="disputo-pager">
                        <?php disputo_pagination(); ?>
                    </div> 
                    <div class="clearfix"></div>    
                <?php endif; ?> 
            </div>
            <?php if ( is_active_sidebar( 'disputo_sidebar' ) ) { ?>
            <aside class="disputo-page-right">
                <?php dynamic_sidebar( 'disputo_sidebar' ); ?>
            </aside>
            <?php } ?>
            <div class="clearfix"></div> 
            <?php } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>