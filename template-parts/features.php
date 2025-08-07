<?php $items = $args['items']; ?>

<section class="features">
    <div class="container features__container">
        <div class="features__title">
            <h2><?php echo $args['title']; ?></h2>
        </div>
        <div class="features__items">

            <?php foreach ($items as $item) { ?>
                <div class="features__item">
                    <div class="features__icon">
                        <img src="<?php echo wp_get_attachment_image_url( $item['icon'], 'thumbnail' ); ?>" alt="<?php echo $item['name']; ?>">
                    </div>
                    <div class="fearutes__text">
                        <div class="features__name"><?php echo $item['name']; ?></div>
                        <div class="features__desc">
                            <?php echo $item['description']; ?>
                        </div>
                    </div>

                </div>
            <?php } ?>                                                
        </div>
        <?php if (get_field('why_choose_us_presentation_file')) { ?>
        <div class="features__button">
            <a href="<?php echo get_field('why_choose_us_presentation_file'); ?>" download target="_blank" class="btn btn--gigantic btn--white">DOWNLOAD THE PRESENTATION</a>
        </div>
        <?php } ?>
    </div>
</section>