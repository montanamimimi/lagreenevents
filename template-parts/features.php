<section class="features">
    <div class="container features__container">
        <div class="features__title">
            <h1><?php echo $args['title']; ?></h1>
        </div>
        <div class="features__items">
            <div class="features__item">
                <div class="features__icon">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature1.svg'; ?>" alt="Experiences">
                </div>
                <div class="fearutes__text">
                    <div class="features__name">Experiences</div>
                    <div class="features__desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </div>
                </div>

            </div>
            <div class="features__item">
                <div class="features__icon">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature2.svg'; ?>" alt="REPUTATION">
                </div>
                <div class="fearutes__text">
                    <div class="features__name">REPUTATION</div>
                    <div class="features__desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </div>                    
                </div>

            </div>                                                                              
            <div class="features__item">
                <div class="features__icon">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature3.svg'; ?>" alt="EXCLUSIVITY">
                </div>
                <div class="fearutes__text">
                    <div class="features__name">EXCLUSIVITY</div>
                    <div class="features__desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </div>                    
                </div>

            </div>
            <div class="features__item">
                <div class="features__icon">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature4.svg'; ?>" alt="THE DEVIL IS IN THE DETAILS">
                </div>
                <div class="fearutes__text">
                    <div class="features__name">THE DEVIL IS IN THE DETAILS</div>
                    <div class="features__desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </div>                    
                </div>

            </div>        
            
            <?php if ($args['size'] != 'small') { ?>
                <div class="features__item">
                    <div class="features__icon">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature5.svg'; ?>" alt="DISCOUNTS and BONUSES">
                    </div>
                    <div class="fearutes__text">
                        <div class="features__name">DISCOUNTS and BONUSES</div>
                        <div class="features__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>                        
                    </div>

                </div>
                <div class="features__item">
                    <div class="features__icon">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature6.svg'; ?>" alt="TRENDS AND WOW">
                    </div>
                    <div class="fearutes__text">
                        <div class="features__name">TRENDS AND WOW</div>
                        <div class="features__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>                        
                    </div>

                </div>
                <div class="features__item">
                    <div class="features__icon">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature7.svg'; ?>" alt="honesty">
                    </div>
                    <div class="fearutes__text">
                        <div class="features__name">honesty</div>
                        <div class="features__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>                        
                    </div>

                </div>
                <div class="features__item">
                    <div class="features__icon">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/feature8.svg'; ?>" alt="CUSTOMER No. 1">
                    </div>
                    <div class="fearutes__text">
                        <div class="features__name">CUSTOMER No. 1</div>
                        <div class="features__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                        </div>                        
                    </div>

                </div>   
            <?php } ?>

                                             
        </div>
        <?php if ($args['size'] == 'large') { ?>
        <div class="features__button">
            <div class="btn btn--gigantic btn--white">DOWNLOAD THE PRESENTATION</div>
        </div>
        <?php } ?>
    </div>
</section>