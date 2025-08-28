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

function lagreen_get_destinations($category = false, $perpage = -1) {

    $args = array(
        'post_type'      => 'destination',        
        'posts_per_page' => $perpage,    
    );

    if ($category) {
        $args['category_name'] = $category;         
    }

    $posts = get_posts($args);

    return $posts;
    
}

function lagreen_compose_email_text($name, $email, $phone, $message, $answers) {
    
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

    if ($answers) {
        $text .= "Questioning form: $answers\n";        
    }    
   
    return $text;
}

function lagreen_compose_wheel_email_text($prize, $phone, $promo, $string) {
    
    $text = "Spinned! Wow!\n";
    $text .= "User phone: $phone\n";
    $text .= "Prize: $prize\n";
    $text .= "Promocode: $promo\n";    
    $text .= "Code: $string\n";  
   
    return $text;
}

function lagreen_space_phone($number) {
    $number = preg_replace('/\D/', '', $number);
   
    $chunks = [];
    while (strlen($number) > 3) {
        $chunks[] = substr($number, -3);
        $number = substr($number, 0, -3);
    }
    $chunks[] = $number;
    
    $implode = implode('&nbsp;', array_reverse($chunks));    
    $newNumber = "+" . $implode;

    return $newNumber;
}

function lagreen_randstring() {

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randstring = '';
	for ($i = 0; $i < 8; $i++) {
		$randstring .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $randstring;
}