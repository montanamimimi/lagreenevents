<?php 

$img = "";
$style = "";
$desc = "";

if ($args['image']) {
    $img = wp_get_attachment_image_url( $args['image'], 'card' );
} 

if ($args['desc']) {
    $desc = $args['desc'];
    
} 

?>

<div class="whatwedo__item">
    <div class="whatwedo__item-image" style="background-image:url('<?php echo $img; ?>')">
        <div class="whatwedo__item-description">
            <?php echo $desc; ?>
        </div>        
    </div>
    <div class="whatwedo__item-label whatwedo__item-label--web">
        <?php echo $args['label']; ?>
    </div>
    <div class="whatwedo__item-label whatwedo__item-label--mob">
        <?php echo $args['short_label'] ? $args['short_label'] :  $args['label']; ?>
    </div>    
</div>