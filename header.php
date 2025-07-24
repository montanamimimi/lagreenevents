<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon.ico" sizes="any">
        <link rel="icon" type="image/png" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="apple-touch-icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/apple-touch-icon.png">
        <meta name="theme-color" content="#ffffff">

        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?> >

    <header class="site-header">
        <div class="site-header__container">
            <div class="site-header__logo">
                <a href="<?php echo site_url();?>">
                    <img src="<?php echo get_theme_file_uri() . '/assets/logo.svg'; ?>" alt="LaGreen Events">
                </a>
            </div>
            <nav class="site-header__nav">        
                <ul>
                    <li><a class="site-header__link" data-label="About&nbsp;us" href="<?php echo site_url();?>">About&nbsp;us</a></li>
                    <li class="site-header__dropdown-link"><a class="site-header__link" data-label="Events" href="<?php echo site_url();?>/events">Events</a>
                        <div class="site-header__dropdown-block">
                            <?php 
                            
                            $items = lagreen_get_what_we_doo();

                            foreach ($items as $item) {                                                        
                                echo '<a href="' . get_permalink($item->ID) . '">' . get_the_title($item->ID) . '</a>';
                            }
                            
                            ?>
                     
                        </div>
                    </li>                    
                    <li><a class="site-header__link" data-label="Portfolio" href="#">Portfolio</a></li>
                    <li><a class="site-header__link" data-label="Services" href="<?php echo site_url();?>/services">Services</a></li>
                    <li><a class="site-header__link" data-label="Testimonials" href="#">Testimonials</a></li>
                    <li><a class="site-header__link" data-label="Blog" href="<?php echo site_url();?>/blog">Blog</a></li>
                    <li><a class="site-header__link" data-label="Contacts" href="<?php echo site_url();?>/contacts">Contacts</a></li>
                </ul>
            </nav>

            <div class="site-header__contacts">
                <div class="site-header__language">
                    
                <?php 
                
                if (get_field('language_switcher', 'options')) {
                    get_template_part('template-parts/language'); 
                }                

                ?>
                </div>
                <a 
                    href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>" 
                    class="icon icon--round icon--middle icon--white icon--whatsapp" 
                    target="_blank"
                    style="background-image:url(<?php echo get_theme_file_uri() . '/assets/icons/whatsapp.svg'; ?>)"
                    >
                 
                </a>
                <a 
                    href="https://t.me/+" 
                    class="icon icon--round icon--middle icon--white icon--telegram" 
                    target="_blank"
                    style="background-image:url(<?php echo get_theme_file_uri() . '/assets/icons/telegram.svg'; ?>)"
                    >
                </a>
                <a class="btn btn--middle btn--green site-header__phone" href="tel:+7">+66&nbsp;953&nbsp;575&nbsp;063</a>                
                <div class="site-header__burger">
                    <div id="hamburger" class="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </div>                    
                </div>
            </div>

        </div>
        <div class="site-header__mobile site-header__mobile--active">
            <nav class="mobile-nav">
                <ul>
                    <li><a class="mobile-nav__link" data-label="About&nbsp;us" href="<?php echo site_url();?>">About&nbsp;us</a></li>
                    <li><a class="mobile-nav__link" data-label="Events" href="<?php echo site_url();?>/events">Events</a></li>                    
                    <li><a class="mobile-nav__link" data-label="Portfolio" href="#">Portfolio</a></li>
                    <li><a class="mobile-nav__link" data-label="Services" href="<?php echo site_url();?>/services">Services</a></li>
                    <li><a class="mobile-nav__link" data-label="Testimonials" href="#">Testimonials</a></li>
                    <li><a class="mobile-nav__link" data-label="Blog" href="<?php echo site_url();?>/blog">Blog</a></li>
                    <li><a class="mobile-nav__link" data-label="Contacts" href="<?php echo site_url();?>/contacts">Contacts</a></li>
                </ul>                
            </nav>
        </div>
    </header>
    <main>