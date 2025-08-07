<?php get_header(); ?>

<?php 

get_template_part('template-parts/hero', 'small', array(
    'title' => 'Services',
));

$image = get_field('article_image_3');
$url = wp_get_attachment_image_url( $image, 'content');

?>

<section class="services-page">
    <div class="container services-page__container">
        <div class="services-page__title">
            <h2><?php echo get_field('hero_header'); ?></h2>
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

<?php   

get_template_part('template-parts/banner');  

$wcu = get_field('why_choose_us');

if (is_array($wcu) && (count($wcu) > 0)) {
    get_template_part('template-parts/features', false, array(
        'title' => 'Why choose us',      
        'items' => $wcu
    )); 
}

?>

<article class="services-article">
    <div class="container">
        <div class="services-page__article">
            <div class="services-page__article-item">
                <?php echo get_the_content(); ?>
                <h3><?php echo get_field('article_slogan'); ?></h3>
                <div class="btn">
                    <a 
                        href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>"  
                        class="btn btn--large btn--green">
                        Get prices
                    </a>
                </div>

            </div>
            <div class="services-page__article-item" style="background-image:url('<?php echo $url; ?>')">
               
            </div>
        </div>
    </div>
</article>

<?php get_template_part('template-parts/contacts', 'form'); ?>


<?php get_footer(); ?>