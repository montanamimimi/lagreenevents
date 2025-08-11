<?php 

$items = get_field('fortune_wheel', 'options'); 

?>
<div id="wheelModal" class="wheel wheel--active">
    <div class="modal">
        <div class="close">
            <div class="close__item">           
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                    <path d="M20.9019 22.9634L1.02495 3.08644C0.455404 2.5169 0.4553 1.60574 1.02471 1.03633C1.59412 0.466917 2.51667 0.455632 3.08621 1.02517L22.9632 20.9022C23.5327 21.4717 23.5442 22.3943 22.9634 22.9751C22.394 23.5445 21.4715 23.533 20.9019 22.9634Z" fill="#445439"/>
                    <path d="M3.53507 22.9634L23.4121 3.08644C23.9816 2.5169 23.9817 1.60574 23.4123 1.03633C22.8429 0.466917 21.9203 0.455632 21.3508 1.02517L1.47381 20.9022C0.904266 21.4717 0.892769 22.3943 1.47357 22.9751C2.04298 23.5445 2.96553 23.533 3.53507 22.9634Z" fill="#445439"/>
                </svg>
            </div>
        </div>
        <div class="content">
            <div class="wheel__fortune">
                <canvas id="wheel"></canvas>
            </div>
            <div class="wheel__text">
                <h1><?php echo __('Win up to 20% discount', 'lg-theme'); ?></h1>
                <p>Try your luck to win the prize. Enter your WhatsApp number and spin the wheel!</p>
                <div class="wheel__form">
                    <form id="wheelForm">
                        <input class="input input--large" type="text" name="phone" placeholder="Your number">
                        <input class="input input--large" type="text" name="promo" placeholder="Promo Code (optional)">
                        <button type="submit" class="btn btn--green btn--gigantic">
                            <?php echo __('Try your luck', 'lg-theme'); ?>!
                        </button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
    <div id="wheelData" class="wheel__data" data-items='<?php echo json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>

    </div>
</div>
