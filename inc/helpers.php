<?php 

function lagreen_get_last_blog_posts($id = false) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,        
    );

    if ($id) {
        $args['exclude'] = array($id);
    }

    $posts = get_posts($args);

    return $posts;
    
}

function lagreen_get_what_we_doo() {
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => -1,   
        'meta_key' => 'order',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',     
    );

    $posts = get_posts($args);

    return $posts;
    
}

function lagreen_get_services($perpage) {
    $args = array(
        'post_type'      => 'service',
        'posts_per_page' => $perpage,    
    );

    $posts = get_posts($args);

    return $posts;
    
}

function lagreen_get_testimonials($perpage = -1) {
    $args = array(
        'post_type'      => 'testimonial',
        'posts_per_page' => $perpage,    
    );

    $posts = get_posts($args);

    return $posts;
    
}

function lagreen_compose_email_text($name, $email, $phone, $message) {
    
    $text = "This message was sent from LaGreen Enevts contact form\n";

    if ($name) {
        $text .= "User name: $name\n";        
    }

    if ($email) {
        $text .= "User email: $email\n";        
    }

    if ($phone) {
        $text .= "User phone: $phone\n";        
    }

    if ($message) {
        $text .= "Message: $message\n";        
    }
   
    return $text;
}