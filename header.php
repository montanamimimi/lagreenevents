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
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L2PTJ0YFEW"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-L2PTJ0YFEW');
    </script>
    
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
            <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
            <div class="site-header__requests">
                <a href="<?php echo site_url() . '/requests'; ?>">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.2005 6.40039H4.80049C4.58832 6.40039 4.38483 6.48468 4.2348 6.63471C4.08477 6.78473 4.00049 6.98822 4.00049 7.20039V24.8004C4.00049 25.0126 4.08477 25.216 4.2348 25.3661C4.38483 25.5161 4.58832 25.6004 4.80049 25.6004H27.2005C27.4127 25.6004 27.6161 25.5161 27.7662 25.3661C27.9162 25.216 28.0005 25.0126 28.0005 24.8004V7.20039C28.0005 6.98822 27.9162 6.78473 27.7662 6.63471C27.6161 6.48468 27.4127 6.40039 27.2005 6.40039ZM5.60049 24.0004V8.00039H26.4005V24.0004H5.60049Z" fill="#445439"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7183 7.80839L16.4463 17.4084C16.3012 17.5321 16.1167 17.5999 15.926 17.5996C15.7354 17.5994 15.551 17.531 15.4063 17.4068L4.27673 7.80679C4.15284 7.70018 4.06457 7.55818 4.02381 7.3999C3.98305 7.24162 3.99175 7.07465 4.04874 6.92146C4.10573 6.76827 4.20827 6.63621 4.34257 6.54305C4.47687 6.44989 4.63649 6.40011 4.79993 6.40039H27.1999C27.3633 6.40071 27.5227 6.45105 27.6567 6.54466C27.7906 6.63826 27.8927 6.77064 27.9491 6.92398C28.0056 7.07733 28.0137 7.24428 27.9725 7.40239C27.9312 7.56051 27.8425 7.70219 27.7183 7.80839ZM25.0271 8.00039H6.95193L15.9311 15.746L25.0271 8.00039Z" fill="#445439"/>
                    </svg>
                    <?php
                    
                    $newRequests = lagreen_count_new_requests();

                    if ($newRequests) {
                        echo '<div class="site-header__new-requests">' . $newRequests  . '</div>';
                    }
                    
                    ?>
                    
                </a>
            </div>                
            <?php } ?>

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