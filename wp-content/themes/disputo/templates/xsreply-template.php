<div <?php post_class(); ?>>
    <div class="card-masonry card-small">
    <div class="card">
        <div class="card-body">
            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        </div>
    </div> 
    <div class="card-footer">
        <div>
        <a class="disputo-post-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?> <?php the_author(); ?></a>
        </div>
        <div class="clearfix"></div>
    </div>    
</div>
</div>