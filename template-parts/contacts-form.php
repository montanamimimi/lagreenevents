<?php 

$image1 = get_field('article_image_1');
$url1 = wp_get_attachment_image_url( $image1, 'cardv' );
$image2 = get_field('article_image_2');
$url2 = wp_get_attachment_image_url( $image2, 'cardv' );

?>
<section class="contacts-form">
    <div class="container contacts-form__container">
        <div class="contacts-form__title">
            <h2>Write to us if you want to&nbsp;organize&nbsp;an&nbsp;event</h2>
        </div>
        <div class="contacts-form__content">
            <div class="contacts-form__polaroid">
                <div class="polaroid polaroid--300" style="top:20px;left:40px;transform:rotate(-7deg);">                         
                    <img src="<?php echo $url1; ?>" alt="La Green Events polaroid">
                </div>
                <div class="polaroid polaroid--300" style="top:20px;left:100px;transform:rotate(5deg);">                         
                    <img src="<?php echo $url2; ?>" alt="La Green Events polaroid">
                </div>                
            </div>            
            <form class="contacts-form__form" id="contacts-form">
                <div class="contacts-form__fields">
                    <div class="contacts-form__contants">
                        <div class="contacts-form__name">
                            <input type="text" name="name" placeholder="Name">
                        </div>  
                        <div class="contacts-form__phone">
                            <input type="phone" name="phone" placeholder="Phone*">
                        </div>         
                        <div class="contacts-form__email">
                            <input type="email" name="email" placeholder="Email">
                        </div>                                         
                    </div>                      
                    <div class="contacts-form__question">
                        <textarea name="message" placeholder="Tell us briefly about your task"></textarea>
                    </div>  
                </div>
                <div class="contacts-form__buttons">
                    <div class="contacts-form__agree">
                        <sup>*</sup>By submitting the form, you consent to the processing of personal data.
                    </div>
                    <div class="contacts-form__result"></div>          
                    <button class="contacts-form__button btn btn--white btn--gigantic" type="submit">submit a request<div class="spinner"></div></button>             
                </div>                
            </form>     
            </div>
        </div>
    </div>
</section>