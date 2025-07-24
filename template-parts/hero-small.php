<?php
$hero_image = get_field('hero_image');
$image_url = wp_get_attachment_image_url( $hero_image, 'hero' );
?>
<section class="hero-small" 
style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container">
        <h1><?php echo $args['title']; ?></h1>
    </div>
</section>