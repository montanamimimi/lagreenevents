<?php get_header(); ?>
<section class="blog" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container blog__container">
        <div class="blog__title">
            <h1>Blog LaGreen Events</h1>
        </div>
        <div class="blog__items">
            <?php if ( have_posts() ) { ?>
            <?php while ( have_posts() ) : the_post(); 
                $image_url = get_the_post_thumbnail_url( get_the_ID(), 'card' );
                $url = get_permalink();
            ?>
                <a href="<?php echo $url; ?>" class="blog__item">
                    <div class="blog__item-image" style="background-image:url('<?php echo $image_url; ?>')">
                        
                    </div>
                    <div class="blog__item-date">
                        <?php echo get_the_date( 'd.m.Y' ); ?>
                    </div>
                    <div class="blog__item-title">
                        <?php the_title(); ?>
                    </div>
                    <div class="blog__item-button">
                        <div class="btn btn--large btn--white">read post</div>
                    </div>
                </a>
            <?php endwhile; ?>
            <?php } ?>
        </div>
        <div class="blog__pagination">
            <?php
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
            ]);
            ?>
        </div>
    </div>



</section>
<?php get_footer(); ?>