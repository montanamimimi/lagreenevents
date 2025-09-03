<?php
/*
Template Name: Events
*/
?>

<?php get_header(); ?>

<?php 

get_template_part('template-parts/hero', 'small', array(
    'title' => 'Events',
));

get_template_part('template-parts/whatwedo', false, array(
    'items' => lagreen_get_what_we_doo()
)); 

$image = get_field('article_image_3');
$url = wp_get_attachment_image_url( $image, 'content');

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
                        target="_blank" 
                        class="btn btn--large btn--green">
                        <?php echo __('Get prices', 'lg-theme'); ?>
                    </a>
                </div>

            </div>
            <div class="services-page__article-item" style="background-image:url('<?php echo $url; ?>')">
               
            </div>
        </div>
    </div>
</article>

<?php get_template_part('template-parts/contacts', 'form', array(
    'image1' => get_field('article_image_1'),
    'image2' => get_field('article_image_2'),
)); ?>

<?php get_footer(); ?>