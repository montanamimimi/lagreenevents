<?php get_header(); ?>

<?php 

get_template_part('template-parts/hero', 'small', array(
    'title' => 'Events',
));

get_template_part('template-parts/whatwedo', false, array(
    'items' => lagreen_get_what_we_doo()
)); 


?>

<?php get_footer(); ?>