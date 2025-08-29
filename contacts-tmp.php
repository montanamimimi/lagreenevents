<?php
/*
Template Name: Contacts
*/
?>

<?php get_header(); ?>
<?php
get_template_part('template-parts/contacts', 'form', array(
    'image1' => get_field('article_image_1'),
    'image2' => get_field('article_image_2'),
));
?>

<section class="contacts">
    <div class="container contacts__container">
        <div class="contacts__title">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="contacts__content">
            <div class="contacts__content-text">
                <p><strong><?php echo get_field('hero_header'); ?></h1></strong></p>
                <p><?php echo get_field('hero_description'); ?></p>
            </div>
            <div class="contacts__content-data">
                <p><?php echo __('LaGreen Events Boutique', 'lg-theme'); ?></p>
                <p>Email:&nbsp;<a href="mailto:<?php echo get_field('email_in_contacts', 'options'); ?>">
                    <?php echo get_field('email_in_contacts', 'options'); ?>
                </a><br><?php echo __('Phone', 'lg-theme'); ?>: <?php echo lagreen_space_phone(get_field('phone_number', 'options')); ?> </p>
            </div>
            <div class="contacts__content-icons">
                <?php get_template_part('template-parts/social'); ?>              
            </div>
        </div>
    </div>
</section>

<section class="contacts-logos">
    <div class="contacts-logos__container">
        <div class="contacts-logos__items">
            <a href="https://layanverde.com" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo1.png'; ?>" alt="Layan Verde">            
            </a>
            <a href="https://layangreenpark.com/" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo2.png'; ?>" alt="Layan Green Park">                       
            </a>
            <a href="https://lagreenhotel.com/" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo3.png'; ?>" alt="LaGreen Hotel">                    
            </a>
            <a href="https://villacarte.com/" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo4.png'; ?>" alt="Villa Carte">        
            </a>
            <a href="https://sabaiprotocol.com/" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo5.png'; ?>" alt="Sabai Ecoverse">        
            </a>
            <a href="https://lavistavillas.com/" target="_blank" class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo6.png'; ?>" alt="La Vista Villas">        
            </a>
        </div>
    </div>
</section>

<section class="contacts-map" style="margin-bottom:-3px;">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.7080661492096!2d98.29358365017376!3d8.029006205923357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30503997d2597041%3A0xb8253f11d4961ea0!2sLa%20Green%20Hotel%20and%20Residence!5e0!3m2!1sen!2sth!4v1753082943061!5m2!1sen!2sth" 
        width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<?php get_footer(); ?>