<?php 

$image1 = get_field('catering_left_image');
$url1 = wp_get_attachment_image_url( $image1, 'cardv' );
$image2 = get_field('catering_right_image');
$url2 = wp_get_attachment_image_url( $image2, 'cardv' );

?>
<article class="article" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container">
        <div class="article__container">        
            <div class="article__left">
                <div class="article__image">
                    <img src="<?php echo $url2; ?>" alt="La Green Events">
                </div>
                <div class="article__slogan">
                    <?php echo get_field('catering_left_text'); ?>
                </div>                                    
            </div>
            <div class="article__right">
                <div class="article__content">
                    <ul>
                    <?php 
                    
                    $items = get_field('catering_repeater') ? get_field('catering_repeater') : []; 

                    foreach ($items as $item) {
                        echo '<li>' . $item['text'] . '</li>';
                    }
                    
                    ?>
                    </ul>
                </div>
                <div class="article__image">
                    <img src="<?php echo $url1; ?>" alt="La Green Events">
                </div>
            </div>        

        </div>            
      
    </div>
    
</article>
