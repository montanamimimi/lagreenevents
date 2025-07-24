<?php $items = get_field('what_we_doo'); ?>

<section class="whatwedo">
    <div class="container whatwedo__container">
        <div class="whatwedo__title">
            <h1>What we do</h1>
        </div>
        <div class="whatwedo__items">
            <?php 

            if ($args['items']) {
                foreach ($args['items'] as $item) {                     
                    get_template_part('template-parts/whatwedo', 'link', array(
                        'id' => $item->ID,
                    ));
                } 
            } else {                
                $items = get_field('what_we_doo');
                foreach ($items as $item) { 
                    get_template_part('template-parts/whatwedo', 'card', array(
                        'image' => $item['image'],
                        'label' => $item['label'],
                        'desc' => $item['description']
                    ));
                } 
            }                    


            
            ?>

        </div>
    </div>
</section>