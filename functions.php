<?php 

require_once( get_template_directory() . "/inc/helpers.php" );

class LaGreenEvents {
    public static $version = '1.0.0';

    public static function init() {
        show_admin_bar(false);		
		add_action( 'init',  [ __CLASS__, 'addSupport' ]  );
        add_action( 'init', [ __CLASS__, 'postTypes' ] );
		add_action( 'init', [ __CLASS__, 'settingsPage' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'assets' ] );
  		add_action( 'after_setup_theme', [ __CLASS__, 'imageControl' ]);
		add_action('wp_ajax_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
		add_action('wp_ajax_nopriv_send_custom_email', [ __CLASS__, 'sendEmails' ]); 
    }

	public static function sendEmails() {

		$name = sanitize_text_field($_POST['name'] ?? '');
		$email = sanitize_email($_POST['email'] ?? '');
		$message = sanitize_textarea_field($_POST['message'] ?? '');
		$phone = sanitize_text_field($_POST['phone'] ?? '');
		
		$to = get_field('email_for_feedback_forms', 'options');
		$subject = "Message from LaGreen Events form";
		$body = lagreen_compose_email_text($name, $email, $phone, $message);
		
		if ($email) {
			$headers = ['Reply-To: ' . $email];
		} else {
			$headers = ['Reply-To: ' . $to];
		}

		if (wp_mail($to, $subject, $body, $headers)) {
			echo '✅ Message sent!';
		} else {
			echo '❌ Failed to send.';
		}

		// echo '✅ Message sent!';

		wp_die(); // required to stop execution

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

		wp_localize_script(
			'lagreen__scripts', 'ajax_object', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'root_url' => get_site_url()
		]);		

    }

    public static function postTypes() {
		register_post_type( 'event', array(    
			'supports' => array('title', 'thumbnail', 'editor'),		
			'has_archive' => false,
			'public' => true,
			'show_in_rest' => true,
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

			// acf_add_options_sub_page(array(
			// 	'page_title'    => 'Theme Mainpage Settings',
			// 	'menu_title'    => 'Mainpage',
			// 	'parent_slug'   => 'theme-settings',
			// ));
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
