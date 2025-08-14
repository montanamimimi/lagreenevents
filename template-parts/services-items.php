<div class="services__items">
    <?php foreach ($args['items'] as $key => $item ) { 
       
        $img = get_the_post_thumbnail_url( $item->ID, 'square' );
        ?>

        <div class="services__item" style="background-image:<?php echo $style; ?>url('<?php echo $img; ?>')">

            <div class="services__shadow">
                <div class="services__header">
                    <?php echo $item->post_title; ?>
                </div>
                <div class="services__wrapper">            
                    <div class="services__text">
                        <?php echo $item->post_content; ?>
                    </div>
                    <div class="services__button">
                        <a 
                            href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>"  
                            target="_blank"
                            class="btn btn--middle btn--green"><?php echo __('Order Now', 'lg-theme'); ?></a>
                    </div>
                </div>                
            </div>

        </div>

    <?php } ?>
</div>
