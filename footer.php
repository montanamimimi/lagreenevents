</main>
<footer class="footer">
    <div class="footer__container">
        <div class="footer__contacts">
            <div class="footer__title">Contacts</div>
            <div class="footer__email"><a href="mailto:nikita.v@lagreenevents.com">nikita.v@lagreenevents.com</a></div>
            <div class="footer__phone">+66 953 575 063</div>
            <div class="footer__address">Office address:<br>Area, Street, 1</div>
        </div>
        <div class="footer__menu">
            <div class="footer__title">Menu</div>
            <nav class="footer__nav">
                <a href="<?php echo site_url();?>" class="footer__nav-item">About us</a>
                <a href="<?php echo site_url();?>/events" class="footer__nav-item">Events</a>
                <a href="" class="footer__nav-item">Portfolio</a>
                <a href="<?php echo site_url();?>/services" class="footer__nav-item">Services</a>
                <a href="" class="footer__nav-item">Catering</a>
                <a href="" class="footer__nav-item">Testimonials</a>
                <a href="<?php echo site_url();?>/blog" class="footer__nav-item">Blog</a>
                <a href="<?php echo site_url();?>/contacts" class="footer__nav-item">Contacts</a>
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
                    <a class="icon icon--green icon--round icon--middle footer__social--item">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/whatsapp-pink.svg'; ?>" alt="Call WhatsApp">
                    </a>
                    <a class="icon icon--green icon--round icon--middle footer__social--item icon--telegram">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/telegram-pink.svg'; ?>" alt="Chat telegram">
                    </a>
                    <a class="icon icon--green icon--round icon--middle footer__social--item">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/insta-pink.svg'; ?>" alt="Like Insta">
                    </a>
                    <a class="icon icon--green icon--round icon--middle icon--facebook footer__social--item">
                        <img src="<?php echo get_theme_file_uri() . '/assets/icons/facebook-pink.svg'; ?>" alt="Like Insta">
                    </a>
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
<?php wp_footer(); ?>
</body>
</html>
