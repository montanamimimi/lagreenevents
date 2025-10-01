<?php 

require_once( get_template_directory() . "/inc/helpers.php" );

class LaGreenEvents {
    public static $version = '1.0.17';

    public static function init() {
        show_admin_bar(false);		
		add_action( 'init',  [ __CLASS__, 'addSupport' ]  );
        add_action( 'init', [ __CLASS__, 'postTypes' ] );
		add_action( 'init', [ __CLASS__, 'settingsPage' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'assets' ] );
  		add_action( 'after_setup_theme', [ __CLASS__, 'imageControl' ]);
		add_action( 'after_setup_theme', [ __CLASS__, 'addMenus' ]);
		add_action( 'wp_ajax_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
		add_action( 'wp_ajax_nopriv_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
		add_action( 'wp_ajax_save_wheel_result', [ __CLASS__, 'saveWheel' ]); 
		add_action( 'wp_ajax_nopriv_save_wheel_result', [ __CLASS__, 'saveWheel' ]); 		
		add_filter( 'body_class', [ __CLASS__, 'bodyLanguage' ]);
		add_filter( 'upload_mimes', [ __CLASS__, 'allowFileTypes' ]);
		add_filter( 'nav_menu_link_attributes', [ __CLASS__, 'addMenuAttributes' ], 10, 3 );
		add_filter( 'nav_menu_css_class', [ __CLASS__, 'addMenuClassFilter' ], 10, 2 );
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

		echo $string;
		
		wp_mail($to, $subject, $body, $headers);

		wp_die(); 

	}	

	public static function addSupport() {
		add_post_type_support( 'page', 'excerpt' );
		add_theme_support( 'post-thumbnails' );
	}

    public static function assets() {
        $themePath = get_template_directory_uri();

		wp_enqueue_style(
			'lagreen__fonts',
			"{$themePath}/fonts/fonts.css",
			[],
			self::$version
		);
        
        wp_enqueue_style(
			'lagreen__styles',
			"{$themePath}/build/index.css",
			['lagreen__fonts'],
			self::$version
		);
		wp_enqueue_script(
			'lagreen__scripts',
			"{$themePath}/build/index.js",
			[],
			self::$version,
			true
		);

		$promo_code = get_field('wheel_promo_code', 'options');
		$promo_code = strtolower($promo_code);
        $promo_hash = hash('sha256', $promo_code);

		wp_localize_script(
			'lagreen__scripts', 'ajax_object', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'root_url' => get_site_url(),
			'feedback_email' => get_field('email_for_feedback_forms', 'options'),
			'lang' => get_locale(),
			'hash' => $promo_hash,
		]);		

    }

    public static function postTypes() {
		register_post_type( 'event', array(    
			'supports' => array('title', 'thumbnail', 'editor'),		
			'has_archive' => false,
			'public' => true,
			'show_in_rest' => true,
			'show_in_nav_menus' => true,
			'labels' => array(
				'name' => 'Events',
				'add_new_item' => 'Add new event',
				'edit_item' => 'Edit event',
				'all_items' => 'All events',
				'singular_name' => 'Event'
			),
			'menu_icon' => 'dashicons-buddicons-groups'
		));

		register_post_type( 'service', array(    
			'supports' => array('title', 'thumbnail', 'editor'),		
			'has_archive' => false,
			'public' => true,
			'show_in_rest' => true,
			'labels' => array(
				'name' => 'Services',
				'add_new_item' => 'Add new service',
				'edit_item' => 'Edit service',
				'all_items' => 'All services',
				'singular_name' => 'Service'
			),
			'menu_icon' => 'dashicons-hammer'
		));		
		register_post_type( 'testimonial', array(    
			'supports' => array('title', 'thumbnail', 'editor'),		
			'has_archive' => false,
			'public' => false,
			'show_in_rest' => false,
			'labels' => array(
				'name' => 'Testimonials',
				'add_new_item' => 'Add new testimonial',
				'edit_item' => 'Edit testimonial',
				'all_items' => 'All testimonials',
				'singular_name' => 'Testimonial'
			),
			'menu_icon' => 'dashicons-welcome-comments'
		));		
		register_post_type( 'destination', array(    
			'supports' => array('title', 'thumbnail', 'editor'),	
			'taxonomies' => array( 'category' ),	
			'has_archive' => false,
			'public' => true,
			'show_in_rest' => true,
			'labels' => array(
				'name' => 'Destinations',
				'add_new_item' => 'Add new destination',
				'edit_item' => 'Edit destination',
				'all_items' => 'All destinations',
				'singular_name' => 'Destination'
			),
			'menu_icon' => 'dashicons-location'
		));				
		register_post_type( 'wheel', array(    
			'supports' => array('title'),		
			'has_archive' => false,
			'public' => false,
			'show_in_rest' => false,
			'labels' => array(
				'name' => 'Fortune Wheel',
				'add_new_item' => 'Add new wheel',
				'edit_item' => 'Edit wheel',
				'all_items' => 'All wheels',
				'singular_name' => 'Fortune Wheel'
			),
			'menu_icon' => 'dashicons-games'
		));					
    }

	public static function settingsPage() {
		if( function_exists('acf_add_options_page')) {
			acf_add_options_page([
				'page_title' => 'Customize',
				'menu_title' => 'Customize',
				'menu_slug' => 'theme-settings',
				'capability' => 'publish_pages',
				'redirect' => false
			]);

			acf_add_options_sub_page(array(
				'page_title'    => 'Calculator fields',
				'menu_title'    => 'Calculator',
				'parent_slug'   => 'theme-settings',
			));

			acf_add_options_sub_page(array(
				'page_title'    => 'Fortune Wheel fields',
				'menu_title'    => 'Fortune Wheel',
				'parent_slug'   => 'theme-settings',
			));		

			acf_add_options_sub_page(array(
				'page_title'    => 'Figures fields',
				'menu_title'    => 'Figures',
				'parent_slug'   => 'theme-settings',
			));							
		}

	}

	public static function imageControl() {

		add_image_size( 'hero', 1920, 960, true );
		add_image_size( 'content', 800, 0, false );
		add_image_size( 'card', 400, 468, true );
		add_image_size( 'cardv', 510, 620, true );
		add_image_size( 'square', 500, 500, true );
		add_image_size( 'gallery', 1260, 0, false );
	}
}

LaGreenEvents::init();
