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
                    <a href="#"><li>About&nbsp;us</li></a>
                    <a href="#"><li>Events</li></a>
                    <a href="#"><li>Portfolio</li></a>
                    <a href="#"><li>Services</li></a>
                    <a href="#"><li>Testimonials</li></a>
                    <a href="<?php echo site_url();?>/blog"><li>Blog</li></a>
                    <a href="#"><li>Contacts</li></a>
                </ul>
            </nav>
            <div class="site-header__contacts">
                <div class="site-header__language"><?php get_template_part('template-parts/language'); ?></div>
                <a href="https://api.whatsapp.com/send?phone=" class="icon icon--round icon--middle icon--white icon--whatsapp" target="_blank">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/whatsapp.svg'; ?>" alt="Call WhatsApp">
                </a>
                <a href="https://t.me/+" class="icon icon--round icon--middle icon--white icon--telegram" target="_blank">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/telegram.svg'; ?>" alt="Chat Telegram">
                </a>
                <a class="btn btn--middle btn--green" href="tel:+7">+66&nbsp;953&nbsp;575&nbsp;063</a>                
                <div class="site-header__burger">
                    <svg width="59" height="43" viewBox="0 0 59 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line y1="1.5" x2="59" y2="1.5" stroke="#445439" stroke-width="3"/>
                    <line y1="21.5" x2="59" y2="21.5" stroke="#445439" stroke-width="3"/>
                    <line y1="41.5" x2="59" y2="41.5" stroke="#445439" stroke-width="3"/>
                    </svg>
                </div>
            </div>

        </div>
    </header>
    <main>