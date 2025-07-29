<?php
$image = get_field('calculator_background', 'options');
$image_url = wp_get_attachment_image_url( $image, 'hero' );
?>
<section class="calculator" 
    style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container calculator__container">
        <div class="calculator__title">
            <h1>Calculate the cost of your event</h1>
        </div>        
        <div class="calculator__modal">
            FORM 
        </div>
    </div>
    
</section>