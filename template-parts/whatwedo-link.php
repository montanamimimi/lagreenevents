<?php 

$id = $args['id'];
$style = "";
$desc = get_field('event_card_text', $id);

$img = get_the_post_thumbnail_url( $id, 'card' );

?>

<a href="<?php echo get_permalink($id); ?>" class="whatwedo__item">
    <div class="whatwedo__item-image" style="background-image:url('<?php echo $img; ?>')">
        <div class="whatwedo__item-description">
            <?php echo $desc; ?>
        </div>
    </div>
    <div class="whatwedo__item-label whatwedo__item-label--web">
        <?php echo get_the_title($id); ?>
    </div>
    <div class="whatwedo__item-label whatwedo__item-label--mob">
        <?php echo get_field('short_title', $id) ? get_field('short_title', $id) :  get_the_title($id); ?>
    </div>
</a>