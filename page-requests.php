<?php 

if (isset($_GET['status'])) {
    $filterstatus = sanitize_text_field($_GET['status']);
} else {
    $filterstatus = false;
}

$query = lagreen_get_requests($filterstatus);

$posts = $query['posts'];

$statuses = get_terms([
    'taxonomy'   => 'request_status',
    'hide_empty' => false,  
]);

?>

<?php get_header(); ?>
<article class="requests" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container requests__container">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <div class="statuses__list">
            <?php  foreach ($statuses as $status) { ?>
                <a 
                    href="<?php echo site_url() . '/requests?status=' . $status->slug; ?>" 
                    class="
                        statuses__item requests__status 
                        requests__status--<?php  echo $status->slug; ?>
                        <?php 
                        
                        if ($filterstatus && $filterstatus != $status->slug)  {
                            echo 'requests__status--inactive';
                        }
                        
                        ?>
                        ">
                    <?php  echo $status->slug; ?>
                </a>
                
            <?php }

                if ($filterstatus) {
                    echo '<a href="'. site_url() . '/requests" >Clear filter</a>';
                }
            
            ?> 
            
        </div>
        <div class="requests__list">
            <?php foreach ($posts as $post) { 

                $terms = wp_get_post_terms($post->ID, 'request_status');

                if (isset($terms[0])) {
                    $term = $terms[0]->slug;
                } else {
                    $term = "";
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
                        $len = "";

                        if ($text) {
                            $len = mb_strlen($text);
                        } 
                        
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
                        $len = "";

                        if ($text) {
                            $len = mb_strlen($text);
                        } 
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
        <div class="pagination <?php echo get_query_var('paged') ? "" : 'pagination--firstpage';  ?>">
            <?php 
            echo paginate_links([
                'total'   => $query['pages'],
                'current' => $paged,
            ]);
            ?>
        </div>

    </div>
</article>

<?php get_footer(); ?>