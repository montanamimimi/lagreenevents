<?php get_header(); ?>

<?php 
    get_template_part('template-parts/hero');
    get_template_part('template-parts/article'); 
    get_template_part('template-parts/features', false, array(
        'title' => 'Why choose us',
        'size' => 'large'
    )); 
    get_template_part('template-parts/whatwedo', false, array(
        'items' => lagreen_get_what_we_doo()
    )); 
    get_template_part('template-parts/banner'); 
    get_template_part('template-parts/destinations'); 
    get_template_part('template-parts/services'); 
    get_template_part('template-parts/gallery'); 
    get_template_part('template-parts/testimonials'); 
    get_template_part('template-parts/calculator'); 
    get_template_part('template-parts/blog', 'preview', array(
        'title' => 'Blog',
        'id' => false,
    )); 
?>

<?php get_footer(); ?>