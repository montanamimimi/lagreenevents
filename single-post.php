<?php get_header(); ?>
<article class="blog-single" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container blog-single__container">
        <div class="blog__item-date">
            <?php echo get_the_date( 'd.m.Y' ); ?>
        </div>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>
</article>
<?php get_template_part('template-parts/ask'); ?>
<?php get_template_part('template-parts/blog', 'preview', array(
    'title' => 'Other news',
    'id' => get_the_ID(),
)); ?>
<?php get_footer(); ?>