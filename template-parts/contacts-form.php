<?php 

$image1 = $args['image1'];
$image2 = $args['image2'];
$id = '';
$title = __('Write to us if you want to organize an event', 'lg-theme');
$button = __('submit a request', 'lg-theme');

$url1 = wp_get_attachment_image_url( $image1, 'square' );
$url2 = wp_get_attachment_image_url( $image2, 'square' );

$alt_text1 = get_post_meta($image1, '_wp_attachment_image_alt', true);
$alt_text2 = get_post_meta($image2, '_wp_attachment_image_alt', true);

if (isset($args['id'])) {
    $id = 'id="' . $args['id'] . '"';
}

if (isset($args['title'])) {
    $title = $args['title'];
}

if (isset($args['button'])) {
    $button = $args['button'];
}

?>
<section <?php echo $id; ?> class="contacts-form">
    <div class="container contacts-form__container">
        <div class="contacts-form__title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="contacts-form__content">
            <div class="contacts-form__polaroid">
                <div class="polaroid polaroid--300" style="top:20px;left:40px;transform:rotate(-7deg);">                         
                    <img src="<?php echo $url1; ?>" alt="<?php echo $alt_text1; ?>">
                </div>
                <div class="polaroid polaroid--300" style="top:20px;left:100px;transform:rotate(5deg);">                         
                    <img src="<?php echo $url2; ?>" alt="<?php echo $alt_text2; ?>">
                </div>                
            </div>            
            <form class="contacts-form__form" id="contacts-form">
                <div class="contacts-form__fields">
                    <div class="contacts-form__contants">
                        <div class="contacts-form__name">
                            <input type="text" name="name" placeholder="<?php echo __('Name', 'lg-theme'); ?>">
                        </div>  
                        <div class="contacts-form__phone">
                            <input type="phone" name="phone" placeholder="<?php echo __('Phone', 'lg-theme'); ?>*">
                        </div>         
                        <div class="contacts-form__email">
                            <input type="email" name="email" placeholder="Email">
                        </div>                                         
                    </div>                      
                    <div class="contacts-form__question">
                        <textarea name="message" placeholder="<?php echo __('Tell us briefly about your task', 'lg-theme'); ?>"></textarea>
                    </div>  
                </div>
                <div class="contacts-form__buttons">
                    <div class="contacts-form__agree">
                        <sup>*</sup><?php echo __('By submitting the form, you consent to the processing of personal data', 'lg-theme'); ?>.
                    </div>
                    <div class="contacts-form__result"></div>          
                    <button class="contacts-form__button btn btn--white btn--gigantic" type="submit">
                        <?php echo $button; ?>
                    <div class="spinner"></div></button>             
                </div>                
            </form>     
            </div>
        </div>
    </div>
</section>