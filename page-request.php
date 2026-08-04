<?php 

$postId = false;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $type = get_post_type($id);
    
    if ($type == 'request') {
        $postId = $id;
    }
} 

if (!$postId) {
    wp_redirect(home_url() . '/requests');
}


?>

<?php get_header(); ?>
<article class="requests" style="background-image:url('<?php echo get_theme_file_uri() . '/assets/background.png';  ?>')">
    <div class="container requests__container">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <div class="requests__list">
            <?php 
            
            $terms = wp_get_post_terms($postId, 'request_status');

            $utm_source = get_field('utm_source', $postId);
            $utm_campaign_id = get_field('utm_campaign_id', $postId);
            $utm_adgroup_id = get_field('utm_adgroup_id', $postId);
            $utm_term = get_field('utm_term', $postId);
            $gclid = get_field('gclid', $postId);
            $src_label = get_field('src_label', $postId);      
            $google = false;
            
            if ($utm_source || $utm_campaign_id || $utm_adgroup_id || $utm_term || $gclid )  {
                $google = true;
            }

            if (isset($terms[0])) {
                $term = $terms[0]->slug;
            }
            
             ?>
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                <input type="hidden" name="action" value="editrequest">
                <input type="hidden" name="id" value="<?php echo $postId; ?>">
                <div class="requests__item requests__item--single">
                                    
                    <div class="requests__date">
                        <?php echo get_the_date('d.m.Y', $postId); ?>
                    </div>

                    <div class="requests__status-list">
                        <div class="requests__status requests__status-item requests__status--<?php  echo $term; ?>">
                            <?php  echo $term; ?>
                        </div>       
                        <div class="requests__status-item">Change status:</div>
                        <?php 
                        
                        $statuses = get_terms([
                            'taxonomy'   => 'request_status',
                            'hide_empty' => false,  
                        ]);

                        foreach ($statuses as $status) { ?>
                            <div class="requests__status-item">
                                <label for="<?php echo $status->slug; ?>"><?php echo $status->name; ?></label>
                                <input type="radio" id="<?php echo $status->slug; ?>" name="status" value="<?php echo $status->slug; ?>">
                            </div>
                        <?php } ?>                        
                    </div>

                    <div class="requests__input">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo get_field('name', $postId); ?>">                        
                    </div>
                    <div class="requests__input">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo get_field('email', $postId); ?>">                        
                    </div>
                    <div class="requests__input">
                        <label for="phone">Phone</label>
                        <input type="phone" id="phone" name="phone" value="<?php echo get_field('phone', $postId); ?>">                                       
                    </div>                              

                    <div class="requests__input">
                        <label for="message">Message</label>
                        <textarea name="message" id="message"><?php echo get_field('message', $postId); ?></textarea>
                    </div>
                    <div class="requests__input">
                        <label for="comment">Notes</label>
                        <textarea name="comment" id="comment"><?php echo get_field('comment', $postId); ?></textarea>
                    </div>
                    <div class="requests__input">
                        <?php echo get_field('event_date', $postId) ? 'Event date - ' . get_field('event_date', $postId) : ''; ?>                                       
                    </div>   
                    <div class="requests__input">src_label : <?php echo $src_label; ?></div>  
                    <?php  if ($google) { ?>
                    <div><strong>Google tag data</strong></div>
                    <div>utm_source : <?php echo $utm_source; ?></div>
                    <div>utm_campaign_id : <?php echo $utm_campaign_id; ?></div>
                    <div>utm_adgroup_id : <?php echo $utm_adgroup_id; ?></div>
                    <div>utm_term : <?php echo $utm_term; ?></div>
                    <div>gclid : <?php echo $gclid; ?></div>
                      

                    <?php }  ?>

                    <div class="requests__buttons">
                        <button type="submit" class="requests__save" name="save" value="1">Save</button>
                        <button type="submit" class="requests__save" name="save" value="2">Save & Close</button>
                        <a href="<?php echo site_url() . '/requests'; ?>" class="requests__close">Close</a>
                    </div>


                   
                </div>   
            </form>          
        </div>
    </div>
</article>

<?php get_footer(); ?>