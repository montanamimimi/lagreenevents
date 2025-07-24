<?php 

$posts = lagreen_get_last_blog_posts($args['id']);

?>
<section class="blog-preview">
    <div class="container blog-preview__container">
        <div class="blog-preview__title">
            <h1><?php echo $args['title']; ?></h1>
        </div>
        <div class="blog-preview__items">

            <?php 

                foreach ($posts as $key => $post) {                   
                    $image_url = get_the_post_thumbnail_url( $post->ID, 'square' );                   
                    $url = get_permalink($post->ID); 
                    ?>

                    <a href="<?php echo $url; ?>" class="blog-preview__item blog-preview__item--<?php echo $key; ?>">
                       
                        <div class="polaroid__placeholder"></div>
                        <div class="polaroid">                         
                            <img src="<?php echo $image_url; ?>" alt="<?php echo $post->post_title; ?>">
                        </div>                         
                        <div class="blog-preview__name">
                            <?php echo $post->post_title; ?>
                        </div>
                        <div class="blog-preview__button">
                            <div class="btn btn--middle btn--white">read post</div>
                        </div>
                    </a>
                    <?php } ?>

        </div>
    </div>
</section>