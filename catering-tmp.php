<?php
/*
Template Name: Catering
*/
?>

<?php get_header(); ?>


<?php 

get_template_part('template-parts/hero'); 
get_template_part('template-parts/article');
$wcu = get_field('why_choose_us');
if (is_array($wcu) && (count($wcu) > 0)) {
    get_template_part('template-parts/features', false, array(
        'title' => 'Why choose us',            
        'items' => $wcu,
        'class' => 'features--white',
    )); 
}
 
get_template_part('template-parts/banner', 'large'); 
get_template_part('template-parts/article', 'simple', array(
    'image' => '1',
));
get_template_part('template-parts/destinations', false, array(
    'items' => lagreen_get_destinations('catering')
)); 
$items = get_field('catering_mini_articles');
?>

<section class="catering">
    <div class="container">
        <div class="catering__mini-articles">
            <?php 
                foreach ($items as $item) { 
                    $url = wp_get_attachment_image_url( $item['image'], 'content' );                    
                    ?>
                    <div class="catering__article">
                        <div class="catering__text">
                            <?php echo $item['text']; ?>
                            <a 
                                href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>" 
                                class="btn btn--middle btn--green"><?php echo $item['button']; ?></a>
                        </div>
                        <div class="catering__image"
                            style="background-image:url('<?php echo $url; ?>')"
                        ></div>
                    </div>
                <?php }
            ?>
        </div>
    </div>
</section>


<?php  get_footer(); ?>