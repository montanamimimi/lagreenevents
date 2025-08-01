<?php                     
    $imageId = get_field('banner_gift');                 
    $url = wp_get_attachment_image_url( $imageId, 'square' );
?>

<div class="banner__gift">

    <div class="polaroid polaroid--300" style="left:20px;top:20px;transform:rotate(-7deg);">                         
        <img src="<?php echo $url; ?>" alt="Gift">
    </div>         
    <div class="polaroid polaroid--300">                         
        <img src="<?php echo $url; ?>" alt="Gift">
    </div>       
    <div class="gift">
        <img src="<?php echo get_theme_file_uri() . '/assets/images/gift.png'; ?>" alt="Gift">
    </div>
    <div style="width:300px;height:300px"></div>

</div>

