<?php 

$slug = $args['category'];


if (get_locale() == "ru_RU") {
    $slug .= '_ru';
}
$term = get_term_by('slug', $slug, 'category');
$items = lagreen_get_destinations($args['category']);

$title = __('Destinations', 'lg-theme');

if ($term) {

    $useThisName = get_field('use_this_in_header', 'category_' . $term->term_id);

    if ($useThisName) {
        $title = $term->name;
    }

}

?>

<article class="destinations" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container destinations__container">
        <div class="destinations__title">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="destinations__items">

        
        <?php foreach ($items as $key => $item) {
            if ($key < 3) {
                
                if ($key == 2) {                    
                    $imgUrl = get_the_post_thumbnail_url( $item->ID, 'square' );                    
                    $alt_text = get_post_meta(get_post_thumbnail_id($item->ID), '_wp_attachment_image_alt', true);
                    $img = '<div class="polaroid" style="top:50px;right:-240px;transform:rotate(-7deg);">                         
                            <img src="' . $imgUrl . '" alt="' . $alt_text . '">
                            </div>';
                } else {
                    $imgUrl = get_the_post_thumbnail_url( $item->ID, 'content' );
                    $alt_text = get_post_meta(get_post_thumbnail_id($item->ID), '_wp_attachment_image_alt', true);
                    $img = '<img src="' . $imgUrl . '" alt="' . $alt_text .'">';
                }

                ?>
                <div class="destinations__item">
                    <div class="destinations__content">
                        <div class="destinations__name">
                            <?php echo $item->post_title; ?> 
                        </div>
                        <div class="destinations__text">
                            <?php echo $item->post_content; ?> 
                        </div>
                    </div>

                    <div class="destinations__image">
                        <?php echo $img;  ?>
                    </div>
                </div>
                
                <?php
            }
        } ?>
        </div>       
        <div class="destinations__button">
            <a 
                href="https://api.whatsapp.com/send?phone=<?php echo get_field('whatsapp_phone', 'options'); ?>"
                target="_blank"
                class="btn btn--large btn--green"><?php echo __('see more', 'lg-theme'); ?></a>
        </div> 
    </div>
</article>