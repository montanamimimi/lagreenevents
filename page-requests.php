<?php $posts = lagreen_get_requests(-1); ?>

<?php get_header(); ?>
<article class="requests" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container requests__container">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <div class="requests__list">
            <?php foreach ($posts as $post) { 

                $terms = wp_get_post_terms($post->ID, 'request_status');

                if (isset($terms[0])) {
                    $term = $terms[0]->slug;
                }

                ?>
                <div class="requests__item">
                    <div class="requests__status requests__status--<?php  echo $term; ?>">
                        <?php  echo $term; ?>
                    </div>       

                    <div class="requests__contacts">
                        <div class="requests__date">
                            <?php echo get_the_date('d.m.Y', $post->ID); ?>
                        </div>
                        <div class="requests__name">
                            Name: <?php echo get_field('name', $post->ID); ?>
                        </div>
                        <div class="requests__email">
                            Email: <?php echo get_field('email', $post->ID); ?>
                        </div>
                        <div class="requests__phone">
                            Phone: <?php echo get_field('phone', $post->ID); ?>
                        </div>
                    </div>

                    <div class="requests__message">
                        Message: <?php 
                        
                        $text = get_field('message', $post->ID);
                        $len = mb_strlen($text);
                        if ($len > 100) {
                            $short = mb_substr($text, 0, 100);
                            echo $short . '...';
                        } else {
                            echo $text;
                        }

                        ?>
                    </div>
                    <div class="requests__comment">
                        Notes: 
                        <?php
                        
                        $text = get_field('comment', $post->ID);
                        $len = mb_strlen($text);
                        if ($len > 100) {
                            $short = mb_substr($text, 0, 100);
                            echo $short . '...';
                        } else {
                            echo $text;
                        }
                        ?>
                    </div>
                    <a href="<?php echo site_url() . '/request?id=' . $post->ID; ?>" class="requests__edit">
                        Open / Edit
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</article>

<?php get_footer(); ?>