<?php                     
    $imageId = get_field('banner_gift');                 
    $url = wp_get_attachment_image_url( $imageId, 'square' );
    $alt_text = get_post_meta($imageId, '_wp_attachment_image_alt', true);
?>

<div class="banner__gift">

    <div class="polaroid polaroid--300" style="left:20px;top:20px;transform:rotate(-7deg);">                         
        <img src="<?php echo $url; ?>" alt="<?php echo $alt_text . ' background'; ?>">
    </div>         
    <div class="polaroid polaroid--300">                         
        <img src="<?php echo $url; ?>" alt="<?php echo $alt_text; ?>">
    </div>       
    <div class="gift">
        <img src="<?php echo get_theme_file_uri() . '/assets/images/gift.png'; ?>" alt="Make a gift">
    </div>
    <div style="width:300px;height:300px"></div>

</div>

