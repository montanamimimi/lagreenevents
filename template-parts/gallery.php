<?php 
$images = get_field('gallery');
$counter = count($images);



foreach ($images as $key => $image) {
    echo '<div class="gallery-data" data-key="' . $key . '" data-url="' . $image['sizes']['gallery'] . '"></div>';

    if ($key == 0) {
        $url1 = $image['sizes']['gallery'];
    }

    if ($key == 1) {
        $url2 = $image['sizes']['gallery'];
    }

    if ($key == 2) {
        $url3 = $image['sizes']['gallery'];
    }
}

?>



<section id="gallery" class="gallery" data-counter="<?php echo $counter; ?>">
    <div class="container gallery__mobile-arrow">
        <h1>Photogallery</h1>
        <div class="gallery__arrow gallery__arrow--right"></div>
    </div>
    <div class="gallery__container">
        <div class="gallery__images">
            
            <div data-id="0" class="gallery__image gallery__image--small" style="background-image:url('<?php echo $url1; ?>')"></div>
            
            <div class="gallery__arrow gallery__arrow--left"></div>

            <div data-id="1" class="gallery__image" style="background-image:url('<?php echo $url2; ?>')"><div class="gallery__overlay"></div></div>
            
            <div class="gallery__arrow gallery__arrow--right"></div>

            <div data-id="2" class="gallery__image gallery__image--small" style="background-image:url('<?php echo $url3; ?>')"></div>
            
        </div>
    </div>
    <div class="gallery__dots">

        <?php    

        foreach ($images as $key => $image) {

            $active = "";

            if ($key == 1) {
                $active = " gallery__dot--active";
            }
            echo '<div class="gallery__dot' . $active . '" data-id="' . $key . '"></div>';
        }

        ?>
    
    </div>
</section>