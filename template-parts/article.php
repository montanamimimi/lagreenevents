<article class="article" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container article__container">
        <div class="article__left">
            <div class="article__title">
                <?php the_title(); ?>
            </div>
            <div class="article__content">
                <?php the_content(); ?>
            </div>
            <div class="article__polaroid">
                IMAGES
            </div>
        </div>
        <div class="article__right">
            <div class="article__image">
                IMAGE
            </div>
            <div class="article__slogan">
                <?php echo get_field('article_slogan'); ?>
            </div>
        </div>
    </div>
</article>
