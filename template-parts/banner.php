<?php 

$banner_image = get_field('banner_image');
$image_url = wp_get_attachment_image_url( $banner_image, 'hero' );

?>
<section class="banner" style="background-image:url('<?php echo $image_url; ?>')">
    <div class="container banner__container">
        <div class="banner__title">
            <h1>Leave a request right now and get a photographer for your event as a gift!</h1>
        </div>
        <div class="banner__button">
            <div class="btn btn--gigantic btn--white">
                submit a request
            </div>
        </div>
    </div>
</section>