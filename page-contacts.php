<?php get_header(); ?>
<?php
get_template_part('template-parts/contacts', 'form');
?>

<section class="contacts">
    <div class="container contacts__container">
        <div class="contacts__title">
            <h1>Contacts</h1>
        </div>
        <div class="contacts__content">
            <div class="contacts__content-text">
                <p><strong><?php echo get_field('hero_header'); ?></h1></strong></p>
                <p><?php echo get_field('hero_description'); ?></p>
            </div>
            <div class="contacts__content-data">
                <p>LaGreen Events Boutique</p>
                <p>Email:&nbsp;<a href="mailto:nikita.v@lagreenevents.com">nikita.v@lagreenevents.com</a><br>Phone: +66 953 575 063 </p>
            </div>
            <div class="contacts__content-icons">
                <a class="icon icon--green icon--round icon--middle">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/whatsapp-pink.svg'; ?>" alt="Call WhatsApp">
                </a>
                <a class="icon icon--green icon--round icon--middle icon--telegram">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/telegram-pink.svg'; ?>" alt="Chat telegram">
                </a>
                <a class="icon icon--green icon--round icon--middle">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/insta-pink.svg'; ?>" alt="Like Insta">
                </a>
                <a class="icon icon--green icon--round icon--middle icon--facebook">
                    <img src="<?php echo get_theme_file_uri() . '/assets/icons/facebook-pink.svg'; ?>" alt="Like Insta">
                </a>                
            </div>
        </div>
    </div>
</section>

<section class="contacts-logos">
    <div id="scrollContainer" class="contacts-logos__container">
        <div id="scrollInner" class="contacts-logos__items">
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo1.svg'; ?>" alt="Layan Verde">            
            </div>
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo2.svg'; ?>" alt="Layan Green Park">                       
            </div>
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo3.svg'; ?>" alt="LaGreen">                    
            </div>
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo4.svg'; ?>" alt="Villa Carte">        
            </div>
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo5.svg'; ?>" alt="Sabai Ecoverse">        
            </div>
            <div class="contacts-logos__item">
                <img src="<?php echo get_theme_file_uri() . '/assets/icons/contacts_logo6.svg'; ?>" alt="La Vista Villas">        
            </div>
        </div>
    </div>
</section>

<section class="contacts-map" style="margin-bottom:-3px;">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.7080661492096!2d98.29358365017376!3d8.029006205923357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30503997d2597041%3A0xb8253f11d4961ea0!2sLa%20Green%20Hotel%20and%20Residence!5e0!3m2!1sen!2sth!4v1753082943061!5m2!1sen!2sth" 
        width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

<?php get_footer(); ?>