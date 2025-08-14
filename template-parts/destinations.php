<article class="destinations" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container destinations__container">
        <div class="destinations__title">
            <h2><?php echo __('Destinations', 'lg-theme'); ?></h2>
        </div>
        <div class="destinations__items">

        
        <?php foreach ($args['items'] as $key => $item) {
            if ($key < 3) {
                
                if ($key == 2) {                    
                    $imgUrl = get_the_post_thumbnail_url( $item->ID, 'square' );
                    $img = '<div class="polaroid" style="top:50px;right:-240px;transform:rotate(-7deg);">                         
                            <img src="' . $imgUrl . '" alt="La Green Events polaroid">
                            </div>';
                } else {
                    $imgUrl = get_the_post_thumbnail_url( $item->ID, 'content' );
                    $img = '<img src="' . $imgUrl . '" alt="' . $item->post_title .'">';
                }

                ?>
                <div class="destinations__item">
                    <div class="destinations__content">
                        <div class="destinations__name">
                            <?php echo $item->post_title; ?> 
                        </div>
                        <div class="destinations__text">
                            <?php echo $item->post_content; ?> 
                        </div>
                    </div>

                    <div class="destinations__image">
                        <?php echo $img;  ?>
                    </div>
                </div>
                
                <?php
            }
        } ?>
        </div>       
        <div class="destinations__button">
            <a 
                href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>"
                target="_blank"
                class="btn btn--large btn--green"><?php echo __('see more', 'lg-theme'); ?></a>
        </div> 
    </div>
</article>