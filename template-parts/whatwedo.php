<section class="whatwedo">
    <div class="container whatwedo__container">
        <div class="whatwedo__title">
            <h2>What we do</h2>
        </div>
        <div class="whatwedo__items">
            <?php 

            if (isset($args['items'])) {
              
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
                        'short_label' => $item['short_label'],
                        'desc' => $item['description']
                    ));
                } 
            }                    


            
            ?>

        </div>
    </div>
</section>	