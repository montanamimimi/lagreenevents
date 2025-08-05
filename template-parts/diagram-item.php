<?php
    $item = $args['item'];
?>
<div class="diagram__item" data-id="<?php echo $args['key']; ?>">
    <div class="diagram__header">
        <div class="diagram__number">
            <?php echo $args['key'] + 1; ?>
        </div>
        <div class="diagram__texts">
            <div class="diagram__name">
                <?php echo $item['name']; ?>
            </div>
            <div class="diagram__percent">
                <?php echo $item['percent_from'];?>-<?php echo $item['percent_to'];?>%
            </div>
        </div>
    </div>
    <div class="diagram__description">
        <?php echo $item['diagram_list']; ?>
    </div>
    <div class="diagram__description--placeholder">
        <?php echo $item['diagram_list']; ?>
    </div>    

</div>  