<section class="services">
    <div class="container services__container">
        <div class="services__title">
            <h1>Services</h1>
        </div>
        <?php get_template_part('template-parts/services', 'items', array(
            'items' => lagreen_get_services(8)
        ));  ?>
        <div class="services__seemore">
            <a href="<?php echo site_url();?>/services" class="btn btn--white btn--large">See more</a>
        </div>
    </div>
</section>