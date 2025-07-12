<?php $items = get_field('what_we_doo'); ?>

<section class="whatwedo">
    <div class="container whatwedo__container">
        <div class="whatwedo__title">
            What we do
        </div>
        <div class="whatwedo__items">
            <?php 
            
            foreach ($items as $item) { 
                get_template_part('template-parts/whatwedo', 'item', array(
                    'image' => $item['image'],
                    'label' => $item['label'],
                    'desc' => $item['description']
                ));
            } 
            
            ?>

        </div>
    </div>
</section>