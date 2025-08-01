<?php get_header(); ?>


<?php 

get_template_part('template-parts/hero'); 
get_template_part('template-parts/article');
get_template_part('template-parts/features', false, array(
    'title' => 'Why wedding with us?',
    'size' => 'small'
)); 
get_template_part('template-parts/whatwedo'); 
get_template_part('template-parts/banner'); 



if (get_field('diagram_title')) {
    get_template_part('template-parts/diagram'); 
}

get_template_part('template-parts/calculator'); 

?>


<?php  get_footer(); ?>