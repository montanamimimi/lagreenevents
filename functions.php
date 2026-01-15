<?php 

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require_once( get_template_directory() . "/inc/helpers.php" );

LagreenTheme\Scripts::init();
LagreenTheme\Setup::init();

class LaGreenEvents {
    public static $version = '1.0.19';

    public static function init() {        	    

		add_action( 'after_setup_theme', [ __CLASS__, 'addMenus' ]);
		add_action( 'wp_ajax_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
		add_action( 'wp_ajax_nopriv_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
		add_action( 'wp_ajax_save_wheel_result', [ __CLASS__, 'saveWheel' ]); 
		add_action( 'wp_ajax_nopriv_save_wheel_result', [ __CLASS__, 'saveWheel' ]); 
		add_action( 'admin_post_editrequest', [__CLASS__, 'editRequest']);        		
		add_filter( 'body_class', [ __CLASS__, 'bodyLanguage' ]);
		add_filter( 'upload_mimes', [ __CLASS__, 'allowFileTypes' ]);
		add_filter( 'nav_menu_link_attributes', [ __CLASS__, 'addMenuAttributes' ], 10, 3 );
		add_filter( 'nav_menu_css_class', [ __CLASS__, 'addMenuClassFilter' ], 10, 2 );
    }

	public static function editRequest() {
		$request_id = (int) $_POST['id'];

		$post = get_post( $request_id );		

		if ($post->post_type == "request") {
			$name = sanitize_text_field($_POST['name'] ?? '');
			$email = sanitize_email($_POST['email'] ?? '');
			$message = sanitize_textarea_field($_POST['message'] ?? '');
			$phone = sanitize_text_field($_POST['phone'] ?? '');
			$comment = sanitize_textarea_field($_POST['comment'] ?? '');	
			$status = sanitize_text_field($_POST['status'] ?? '');	
			$option = (int) $_POST['save'];

			update_field('phone', $phone, $request_id);
			update_field('email', $email, $request_id);
			update_field('message', $message , $request_id);
			update_field('name', $name, $request_id);
			update_field('comment', $comment, $request_id);

			if ($status) {
				wp_set_object_terms(
					$request_id,
					$status,              
					'request_status',   
					false  
				);
			}
		}

		if ($option == "1") {
			wp_redirect(home_url('/request?id=' . $request_id));
		} else {
			wp_redirect(home_url('/requests'));
		}
	    
        exit;
		
	}

	public static function addMenuClassFilter($classes, $item) {
		if (strpos($item->url, '#') !== false) {
			$classes = array_diff($classes, ['current_page_item', 'current-menu-item']);
		}
		return $classes;
	}
	public static function addMenuAttributes($atts, $item, $args) {

		$atts['data-tracking'] = $item->title;		
    	$atts['data-id'] = $item->ID;

    	return $atts;
	}	

	public static function addMenus() {
		register_nav_menu('headerMenuLocation', 'Header Menu Location');
		register_nav_menu('footerMenuLocation', 'Footer Menu Location');
	}

	public static function allowFileTypes($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	public static function bodyLanguage($classes) {
		$locale = get_locale();
		$lang = substr($locale, 0, 2);
		$classes[] = 'lang-' . $lang;
		return $classes;
	}


	public static function sendEmails() {

		$name = sanitize_text_field($_POST['name'] ?? '');
		$email = sanitize_email($_POST['email'] ?? '');
		$message = sanitize_textarea_field($_POST['message'] ?? '');
		$phone = sanitize_text_field($_POST['phone'] ?? '');
		$answers = sanitize_text_field($_POST['answers'] ?? '');		
		$to = sanitize_email($_POST['feedback_email'] ?? '');		
		
		$subject = "Message from LaGreen Events form";
		$body = lagreen_compose_email_text($name, $email, $phone, $message, $answers);
		
		if ($email) {
			$headers = ['Reply-To: ' . $email];
		} else {
			$headers = ['Reply-To: ' . $to];
		}

		$success = '✅ ' . __('Message sent', 'lg-theme') . '!';
		$fail = '❌ ' . __('Failed to send', 'lg-theme') . '.';

		if ($answers)  {
			$success = __('THANK YOU', 'lg-theme') . '!<br>' . __('Our team will contact you shortly and show all possible options, venues, prices and all the details', 'lg-theme') . '.';			
		}
		
		$string = "New request";

		if ($name) {
			$string .= ' from ' . $name;
		} else if ($email) {
			$string .= ' from ' . $email;
		} else if ($phone) {
			$string .= ' from ' . $phone;
		}
		
		$request_id = wp_insert_post([
			'post_type'   => 'request',
			'post_title'  => $string,
			'post_status' => 'publish',
		]);

		if ($answers) {
			$message = $answers;
		}

		if ($request_id) {
			update_field('phone', $phone, $request_id);
			update_field('email', $email, $request_id);
			update_field('message', $message , $request_id);
			update_field('name', $name, $request_id);
		}

		wp_set_object_terms(
			$request_id,
			'new',              
			'request_status',   
			false  
		);

		if (wp_mail($to, $subject, $body, $headers)) {
			echo $success;
		} else {
			echo $fail;
		}

		wp_die(); 

	}

	public static function saveWheel() {

		$phone = sanitize_text_field($_POST['phone'] ?? '');
		$prize = sanitize_text_field($_POST['prize'] ?? '');	
		$promo = sanitize_text_field($_POST['promo'] ?? '');	
		$to = sanitize_email($_POST['feedback_email'] ?? '');		
		
		$subject = "Somebody spinned the wheel!";
		
		$headers = ['Reply-To: ' . $to];		

		$string = lagreen_randstring();
		$body = lagreen_compose_wheel_email_text($prize, $phone, $promo, $string);
		
		$wheel_id = wp_insert_post([
			'post_type'   => 'wheel',
			'post_title'  => $string,
			'post_status' => 'publish',
		]);

		if ($wheel_id) {
			update_field('phone', $phone, $wheel_id);
			update_field('prize', $prize, $wheel_id);
			update_field('code', $string, $wheel_id);
			update_field('promo', $promo, $wheel_id);
		}
		
		// Don't remember how it works but we need this line

		echo $string;
		
		wp_mail($to, $subject, $body, $headers);

		wp_die(); 

	}	

}

LaGreenEvents::init();
