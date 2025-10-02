<?php $posts = lagreen_get_testimonials(); ?>

<section class="testimonials" id="testimonials">
    <div class="container testimonials__mobile-arrow">
        <h2><?php echo __('Testimonials', 'lg-theme'); ?></h2>
    <div class="testimonials__arrow testimonials__arrow--right"></div>
    </div>
    <div class="testimonials__container">
        <div class="testimonials__items">        
            
            <div class="testimonials__arrow testimonials__arrow--left testimonials__arrow--inactive"></div>

            <div class="testimonials__wrapper">            

                <div class="testimonial-container" id="testimonialSlider">

                    <?php 
                    
                    foreach ($posts as $post) { 
                    $img = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
                    ?>
                        
                        <div class="testimonial">
                            <div class="testimonial__header">
                                <div class="testimonial__image">
                                    <img src="<?php echo $img; ?>" alt="<?php echo $post->post_title . ' testimonials'; ?>">
                                </div>
                                <div class="testimonial__name">
                                    <?php echo $post->post_title; ?>
                                </div>
                            </div>
                            <div class="testimonial__content">
                                <?php echo $post->post_content; ?>
                            </div>
                        </div>

                    <?php } ?>
                    
                </div>
            </div>
            
            <div class="testimonials__arrow testimonials__arrow--right"></div>
            
        </div>     
    </div>
    <div class="container testimonials__dots">
        <?php 
        foreach ($posts as $key => $post) { 
                $class = "";
                if ($key == 0) {
                    $class = "testimonials__dot--active";
                }

                echo '<div class="testimonials__dot ' . $class . '" data-id="' . $key . '"></div>';
            
            } ?>
    </div>    
</section>