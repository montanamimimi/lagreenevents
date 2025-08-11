</main>
<footer class="footer">
    <div class="footer__container">
        <div class="footer__contacts">
            <div class="footer__title"><?php echo __('Contacts', 'lg-theme'); ?></div>
            <div class="footer__email"><a href="mailto:<?php echo get_field('email_in_contacts', 'options'); ?>"><?php echo get_field('email_in_contacts', 'options'); ?></a></div>
            <div class="footer__phone"><?php echo lagreen_space_phone(get_field('phone_number', 'options')); ?></div>
            <div class="footer__address"><?php echo __('Office address', 'lg-theme'); ?>:<br><?php echo get_field('contact_address', 'options'); ?></div>
        </div>
        <div class="footer__menu">
            <div class="footer__title"><?php echo __('Menu', 'lg-theme'); ?></div>
            <nav class="footer__nav">
                <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'footerMenuLocation',
                    ))                        
                ?>  
            </nav>
        </div>
        <div class="footer__feedback">
            <div class="footer__feedback--item">
                <div class="footer__form">
                    <div class="footer__title">Ask any question to our specialis</div>
                    <form class="contact-form" id="contact-form">
                        <div class="contact-form__name">
                            <input type="text" name="name" placeholder="Name">
                        </div>                        
                        <div class="contact-form__submit">
                            <input type="phone" name="phone" placeholder="Phone"><button class="contact-form__button" type="submit"><div class="spinner"></div></button>
                        </div>                        
                    </form>       
                    <div class="form-result" id="form-result"></div>             
                </div>
                
                <div class="footer__social">
                    <?php get_template_part('template-parts/social'); ?>
                </div>
            </div>
            <div class="footer__feedback--item footer__links">
                <div class="footer__links--item">LaGreen&nbsp;Events&nbsp;©&nbsp;2025&nbsp;–&nbsp;All&nbsp;rights&nbsp;reserved</div>
                <div class="footer__links--item">Privacy&nbsp;Policy</div>
                <div class="footer__links--item">Processing&nbsp;of&nbsp;personal&nbsp;data</div>
            </div>
        </div>

    </div>    
</footer>
<?php// get_template_part('template-parts/wheel'); ?>
<?php wp_footer(); ?>
</body>
</html>
