<?php get_header(); ?>
<?php 
$disputo_bbpress_forum_sidebar = get_theme_mod('disputo_bbpress_forum_sidebar');
$disputo_bbpress_topic_sidebar = get_theme_mod('disputo_bbpress_topic_sidebar', 1);
$disputo_bbpress_search_sidebar = get_theme_mod('disputo_bbpress_search_sidebar', 1);
$disputo_bbpress_search = get_theme_mod('disputo_bbpress_search');
$disputo_bbpress_signature = get_theme_mod('disputo_bbpress_signature');
$disputo_bbpress_header_signature = get_theme_mod('disputo_bbpress_header_signature');
$disputo_no_boxed = get_theme_mod('disputo_no_boxed'); 
?>

<div id="header-wrapper">
    <header>
        <?php get_template_part( 'templates/header', 'template'); ?>
    </header>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'templates/bbpresscover', 'template'); ?>
    <?php if (get_the_title()) { ?>
        <div class="disputo-page-title <?php if($disputo_no_boxed) { echo 'noboxed-title'; } ?>">
        <div class="container">
            <?php the_title('<h1>','</h1>'); ?>
            <?php if (bbp_is_single_forum()) { ?>
            <p><?php bbp_forum_content( get_the_id() ); ?></p> 
            <?php } ?>
            <?php if (bbp_is_single_user() && ($disputo_bbpress_signature) && ($disputo_bbpress_header_signature))  { ?>
            <?php $disputo_signature = get_user_meta( bbp_get_displayed_user_field( 'ID' ), 'disputo_cmb2_forum_signature', true ); ?>
            <?php if ($disputo_signature) { ?>
            <p class="disputo-page-subtitle"><?php echo wp_kses_post($disputo_signature); ?></p> 
            <?php } ?>
            <?php } ?>
            <?php if ( ($disputo_bbpress_search && !bbp_is_single_user()) || (bbp_allow_search() && bbp_is_search()) ) { ?>
            <div id="disputo-header-search">
            <?php get_template_part( 'templates/bbpresslg', 'template'); ?>
            </div>
            <?php } ?> 
        </div>
    </div>
    <?php } ?>
</div>
<main class="disputo-main-container">
    <div class="container">
    <div id="disputo-main-inner" class="<?php if($disputo_no_boxed) { echo 'nomargin noboxed'; } ?>">    
        <?php if ((bbp_is_single_forum() || bbp_is_forum_archive()) && ($disputo_bbpress_forum_sidebar) && (is_active_sidebar( 'disputo_bbpress_forum_sidebar' ))) { ?>
        <div class="disputo-page-left"> 
        <?php } ?>
        <?php if ((bbp_is_single_topic() || bbp_is_topic_archive()) && ($disputo_bbpress_topic_sidebar) && (is_active_sidebar( 'disputo_bbpress_topic_sidebar' ))) { ?>
        <div class="disputo-page-left"> 
        <?php } ?>
        <?php if ((bbp_is_search()) && ($disputo_bbpress_search_sidebar) && (is_active_sidebar( 'disputo_bbpress_search_sidebar' ))) { ?>
        <div class="disputo-page-left"> 
        <?php } ?>    
        <?php the_content(); ?>  
        <?php if ((bbp_is_single_forum() || bbp_is_forum_archive()) && ($disputo_bbpress_forum_sidebar) && (is_active_sidebar( 'disputo_bbpress_forum_sidebar' ))) { ?>
        </div>
            <aside class="disputo-page-right">
                <?php dynamic_sidebar( 'disputo_bbpress_forum_sidebar' ); ?>
            </aside>
        <?php } ?> 
        <?php if ((bbp_is_single_topic() || bbp_is_topic_archive()) && ($disputo_bbpress_topic_sidebar) && (is_active_sidebar( 'disputo_bbpress_topic_sidebar' ))) { ?>
        </div>
            <aside class="disputo-page-right">
                <?php dynamic_sidebar( 'disputo_bbpress_topic_sidebar' ); ?>
            </aside>
        <?php } ?> 
        <?php if ((bbp_is_search()) && ($disputo_bbpress_search_sidebar) && (is_active_sidebar( 'disputo_bbpress_search_sidebar' ))) { ?>
        </div>
            <aside class="disputo-page-right">
                <?php dynamic_sidebar( 'disputo_bbpress_search_sidebar' ); ?>
            </aside>
        <?php } ?>     
    </div>
    </div>
</main>
<?php endwhile; ?> 
<?php get_footer(); ?>