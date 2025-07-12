<?php 

$hero_image = get_field('hero_image');
$image_url = wp_get_attachment_image_url( $hero_image, 'hero' );

?>

<section class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container hero__container">
        <div class="hero__header"><?php echo get_field('hero_header'); ?></div>
        <div class="hero__description">Expert organization of luxury events in Phuket</div>
        <div class="hero__button">
            <a class="btn btn--gigantic btn--white"></a>
        </div>
        <div class="hero__numbers">
            NUMS
        </div>
    </div>
</section>