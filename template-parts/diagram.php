<?php 

$items = get_field('diagram_items'); 
$counter = count($items);
$i = 0;
$center = round($counter /2);

?>


<section class="diagram" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container">
        <div class="diagram__title">
            <h2><?php echo get_field('diagram_title'); ?></h2>
        </div>
        <div class="diagram__data">
            
            <div id="diagramData" data-items='<?php echo json_encode($items, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'></div>
        </div>
    </div>
    <div class="diagram__container">
        <div class="diagram__canvas">
            <div class="diagram__items diagram__items--web">
                <?php                
                    foreach ($items as $key => $item) {
                        if ($key < $center) { 

                            get_template_part('template-parts/diagram', 'item', array(
                                'key' => $key,
                                'item' => $item
                            ));                                 
                        }
                    }
                
                ?>
         
            </div>
            <div class="canvas__wrapper">
                <div class="diagram__absolute">
                    <div class="diagram__center">
                        <?php echo get_field('diagram_center_text'); ?>
                    </div>
                </div>
                <canvas id="canvas"></canvas>
            </div>            
            
            <div class="diagram__items diagram__items--web">
                <?php                
                    foreach ($items as $key => $item) {
                        if ($key >= $center) { 
                            
                            get_template_part('template-parts/diagram', 'item', array(
                                'key' => $key,
                                'item' => $item
                            )); 
                        }
                    }
                
                ?>
         </div>
        </div>   
        <div class="diagram__mob">
            <div class="diagram__items diagram__items--mob">
                <?php                
                    foreach ($items as $key => $item) {
                        if ($key < $center) { 

                            get_template_part('template-parts/diagram', 'item', array(
                                'key' => $key,
                                'item' => $item
                            ));                                 
                        }
                    }
                
                ?>
            </div>
            <div class="diagram__items diagram__items--mob">
                <?php                
                    foreach ($items as $key => $item) {
                        if ($key >= $center) { 
                            
                            get_template_part('template-parts/diagram', 'item', array(
                                'key' => $key,
                                'item' => $item
                            )); 
                        }
                    }
                
                ?>
            </div>            
        </div>    
    </div>
</section>
