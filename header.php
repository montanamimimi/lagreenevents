<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon.ico" sizes="any">
        <link rel="icon" type="image/png" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="apple-touch-icon" href="<?php echo get_theme_file_uri(); ?>/assets/favicon/apple-touch-icon.png">
        <meta name="theme-color" content="#ffffff">
        <title>LaGreen Events - <?php echo get_the_title(); ?> - <?php echo __('Event Agency in Phuket', 'lg-theme'); ?></title>
        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?> >

    <header class="site-header">
        <div class="site-header__container">
            <div class="site-header__logo">
                <a href="<?php echo (get_locale() == "ru_RU") ? site_url() . "/ru" : site_url(); ?>">
                    <img src="<?php echo get_theme_file_uri() . '/assets/logo.svg'; ?>" alt="LaGreen Events">
                </a>
            </div>

            <nav class="site-header__nav">
            <?php 
                wp_nav_menu(array(
                    'theme_location' => 'headerMenuLocation',
                ))                        
            ?>
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
                    href="<?php echo get_field('telegram_link', 'options'); ?>" 
                    class="icon icon--round icon--middle icon--white icon--telegram" 
                    target="_blank"
                    style="background-image:url(<?php echo get_theme_file_uri() . '/assets/icons/telegram.svg'; ?>)"
                    >
                </a>
                <a class="btn btn--middle btn--green site-header__phone" href="tel:+<?php echo get_field('phone_number', 'options'); ?>">
                    <?php echo lagreen_space_phone(get_field('phone_number', 'options')); ?>
                </a>                
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

                <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'headerMenuLocation',
                    ))                        
                ?>    
                <?php 
                
                if (get_field('language_switcher', 'options')) {
                    get_template_part('template-parts/language-mob'); 
                }                

                ?>                               
            </nav>
         
        </div>
    </header>
    <main>