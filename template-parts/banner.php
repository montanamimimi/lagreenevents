<?php 

$banner_image = isset($args['image']) ? $args['image'] : get_field('banner_image');
$image_url = wp_get_attachment_image_url( $banner_image, 'hero' );
$page = get_page_by_path( 'contacts' ); 
if ( $page ) {    
    $translated_id = pll_get_post( $page->ID );   
    $link = get_permalink( $translated_id );
}


$header = isset($args['header']) ? $args['header'] : get_field('banner_header');
$text = isset($args['text']) ? $args['text'] : get_field('banner_text');
$button = isset($args['button']) ? $args['button'] : get_field('banner_button');

?>
<section class="banner" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container banner__container">
        <div class="banner__content <?php echo get_field('banner_gift') ? '' : ' banner__content--centered'; ?>">
            <div class="banner__title">
                <h2><?php echo $header; ?></h2>
            </div>

            <?php
            
            if ($text) {
                echo '<div class="banner__text"><p>' . $text . '</p></div>';
            }
            
            ?>
            
            <div class="banner__button">
                <a href="<?php echo $link; ?>" class="btn btn--gigantic btn--white">
                    <?php echo $button; ?>
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


