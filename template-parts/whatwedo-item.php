<?php 

$img = "";
$style = "";
$desc = "";

if ($args['image']) {
    $img = wp_get_attachment_image_url( $args['image'], 'card' );
} 

if ($args['desc']) {
    $desc = $args['desc'];

    if ($img) {
        $style = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),";
    }
    
} 

?>

<div class="whatwedo__item">
    <div class="whatwedo__item-image" style="background-image:<?php echo $style; ?>url('<?php echo $img; ?>')">
        <?php echo $desc; ?>
    </div>
    <div class="whatwedo__item-label">
        <?php echo $args['label']; ?>
    </div>
</div>