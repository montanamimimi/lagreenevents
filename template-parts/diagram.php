<section class="diagram" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container diagram__container">
        <div class="diagram__title">
            <h2><?php echo get_field('diagram_title'); ?></h2>
        </div>
        <div class="diagram__data">
            <?php $items = get_field('diagram_items'); ?>
            <div id="diagramData" data-items='<?php echo json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'></div>
        </div>
        <div class="diagram__temp-img">
            <img src="<?php echo get_field('diagram_temp_img'); ?>" alt="How much?">
        </div>
        <div class="diagram__temp-img-mob">
            <img src="<?php echo get_field('diagram_temp_img_mob'); ?>" alt="How much?">
        </div>        
        <div class="diagram__canvas">
            <!-- <canvas id="canvas"></canvas> -->


        </div>        
    </div>
</section>
