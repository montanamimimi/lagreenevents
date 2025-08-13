<?php
/*
Template Name: Privacy
*/
?>

<?php get_header(); ?>

<article class="privacy" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container privacy__container">

        <div class="privacy__title">
            <h1><?php the_title(); ?></h1>
        </div>
        
        <div class="privacy__content">
            <?php the_content(); ?>
        </div>
    </div>
</article>


<?php get_footer(); ?>