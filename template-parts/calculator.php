<?php
$image = get_field('calculator_background', 'options');
$image_url = wp_get_attachment_image_url( $image, 'hero' );

$ru = '';

if (get_locale() == "ru_RU") {
    $ru = '_ru';
}

$questions = get_field('questions' . $ru, 'options');
$counter = count($questions);
$firstQuestion = $questions[0];

?>
<section 
    id="cost"
    class="calculator" 
    style="background-image:linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)),url('<?php echo $image_url; ?>')">
    <div class="container calculator__container">
        <div class="calculator__title">
            <h2><?php echo __('Calculate the cost of your event', 'lg-theme'); ?></h2>
        </div>        
        <div id="calculator" class="calculator__content" data-inputs='<?php echo json_encode($questions, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
            <div class="calculator__header">
                <div class="calculator__question">
                    <?php echo $firstQuestion['question_text']; ?>
                </div>
                <div class="calculator__counter">
                    <span id="calcCurrent" data-total="<?php echo $counter; ?>">1</span>/<?php echo $counter; ?>&nbsp;<?php echo __('question', 'lg-theme'); ?>
                </div>
            </div>
            <div class="calculator__form">
                <div class="calculator__options">  
                    <?php foreach ($firstQuestion['answers'] as $key => $item ) { ?>
                        <div class="calculator__option">                        
                            <label for="calc<?php echo $key; ?>">
                                <input id="calc<?php echo $key; ?>" type="radio" name="calculator" value="<?php echo $key; ?>">
                                <span class="custom-radio"></span>
                                <?php echo $item['answer_text']; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <div class="calculator__contacts">
                    <input type="text" name="name" placeholder="<?php echo __('name', 'lg-theme'); ?>">
                    <input type="phone" name="phone" placeholder="<?php echo __('phone', 'lg-theme'); ?>">
                </div>
                <div class="calculator__error"></div>
            </div>

            <div class="calculator__buttons">
                <div id="calcBackBtn" class="btn btn--large btn--white btn--disabled"><?php echo __('BACK', 'lg-theme'); ?></div>
                
                <div id="calcNextBtn" class="btn btn--large btn--green calculator__next"><?php echo __('NEXT', 'lg-theme'); ?>
                <div class="spinner"></div> </div>
            </div>


        </div>
    </div>
    
</section>