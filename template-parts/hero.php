<?php 

$hero_image = get_field('hero_image');
$image_url = wp_get_attachment_image_url( $hero_image, 'hero' );
global $wp;
$current_url = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
?>

<section class="hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container hero__container">
        <div class="hero__header"><h1><?php echo get_field('hero_header'); ?></h1></div>
        <div class="hero__description"><?php echo get_field('hero_description'); ?></div>
        <div class="hero__button">
            <a href="<?php echo $current_url; ?>/#cost" class="btn btn--gigantic btn--white">Find out the cost of event</a>
        </div>
        <div class="hero__numbers">
            <?php get_template_part('template-parts/hero', 'numbers'); ?>
        </div>
    </div>
</section>