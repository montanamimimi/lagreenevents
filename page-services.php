<?php get_header(); ?>

<?php 

get_template_part('template-parts/hero', 'small', array(
    'title' => 'Services',
));

?>

<section class="services-page">
    <div class="container services-page__container">
        <div class="services-page__title">
            <h1><?php echo get_field('hero_header'); ?></h1>
        </div> 
        <div class="services-page__content">
            <?php echo get_field('hero_description'); ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <?php

        get_template_part('template-parts/services', 'items', array(
            'items' => lagreen_get_services(-1)
        )); 

        ?>   
    </div>
</section>

<?php     get_template_part('template-parts/banner');  ?>


<?php get_footer(); ?>