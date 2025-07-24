<?php get_header(); ?>
<?php get_template_part('template-parts/hero'); ?>
<?php get_template_part('template-parts/article'); ?>
<?php get_template_part('template-parts/features', false, array(
    'title' => 'Why wedding with us?',
    'size' => 'small'
)); ?>
<?php get_template_part('template-parts/whatwedo'); ?>
<?php get_template_part('template-parts/banner'); ?>
<?php get_footer(); ?>