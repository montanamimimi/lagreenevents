<?php 

$image1 = get_field('article_image_1');
$url1 = wp_get_attachment_image_url( $image1, 'cardv' );
$image2 = get_field('article_image_2');
$url2 = wp_get_attachment_image_url( $image2, 'square' );
$image3 = get_field('article_image_3');
$url3 = wp_get_attachment_image_url( $image3, 'cardv' );

?>
<article class="article" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container">
        <div class="article__title">
            <h2><?php the_title(); ?></h2>                
        </div>
    </div>
    <div class="container article__container">
        <div class="article__left">

            <div class="article__content">
                <?php the_content(); ?>
            </div>
            <div class="article__polaroid" style="background-image:url('<?php echo $url1; ?>')">              
                <div class="polaroid" style="top:-50px;right:-240px;transform:rotate(-7deg);">                         
                    <img src="<?php echo $url2; ?>" alt="La Green Events polaroid">
                </div>
            </div>
        </div>
        <div class="article__right">
            <div class="article__image">
                <img src="<?php echo $url3; ?>" alt="La Green Events">
            </div>
            <div class="article__slogan">
                <h2><?php echo get_field('article_slogan'); ?></h2>
            </div>
        </div>
        <div class="article__polaroid--mob">    
            <div class="article__image--mob" style="background-image:url('<?php echo $url1; ?>')">            
            </div>        
            <div class="polaroid polaroid--flexible" style="top:20px;transform:rotate(-7deg);">                         
                <img src="<?php echo $url2; ?>" alt="La Green Events polaroid">
            </div>
        </div> 
        <div class="article__numbers">
            <?php get_template_part('template-parts/article', 'numbers'); ?>
        </div>       
    </div>
</article>
