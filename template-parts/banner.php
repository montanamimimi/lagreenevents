<?php 

$banner_image = get_field('banner_image');
$image_url = wp_get_attachment_image_url( $banner_image, 'hero' );

?>
<section class="banner" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container banner__container">
        <div class="banner__content <?php echo get_field('banner_gift') ? '' : ' banner__content--centered'; ?>">
            <div class="banner__title">
                <h2><?php echo get_field('banner_header'); ?></h2>
            </div>

            <?php
            
            if (get_field('banner_text')) {
                echo '<div class="banner__text"><p>' . get_field('banner_text') . '</p></div>';
            }
            
            ?>
            
            <div class="banner__button">
                <a 
                href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>"  
                target="_blank"                
                class="btn btn--gigantic btn--white">
                    <?php echo get_field('banner_button'); ?>
                </a>
            </div>
        </div>
        <?php             
            if (get_field('banner_gift')) {
                get_template_part('template-parts/banner', 'gift');
            }
        ?>        
    </div>
</section>


