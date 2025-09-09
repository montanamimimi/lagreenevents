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
    'category' => 'catering',
)); 

get_template_part('template-parts/banner', false, array(
    'image' => get_field('catering_second_banner_image'), 
    'header' => get_field('catering_second_banner_header'),
    'text' => get_field('catering_second_banner_text'), 
    'button' => get_field('catering_second_banner_button')
)); 


$items = get_field('catering_mini_articles');
?>

<section class="catering" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
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

<?php
get_template_part('template-parts/contacts', 'form', array(
    'image1' => get_field('catering_contact_image_1'),
    'image2' => get_field('catering_contact_image_2'),
    'title' => get_field('catering_contact_title'),
    'button' => get_field('catering_contact_button_text'),
    'id' => 'cost',
));
?>

<?php  get_footer(); ?>