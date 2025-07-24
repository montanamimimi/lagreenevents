<?php 

$id = $args['id'];
$style = "";
$desc = get_field('event_card_text', $id);

$img = get_the_post_thumbnail_url( $id, 'card' );

if ($desc && $img) {
    $style = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),";  
} 

?>

<a href="<?php echo get_permalink($id); ?>" class="whatwedo__item">
    <div class="whatwedo__item-image" style="background-image:<?php echo $style; ?>url('<?php echo $img; ?>')">
        <?php echo $desc; ?>
    </div>
    <div class="whatwedo__item-label">
        <?php echo get_the_title($id); ?>
    </div>
</a>