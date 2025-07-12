<?php 

require_once( get_template_directory() . "/inc/helpers.php" );

class LaGreenEvents {
    public static $version = '1.0.0';

    public static function init() {
        show_admin_bar(false);		
		add_action( 'init',  [ __CLASS__, 'addExcerpt' ]  );
        add_action( 'init', [ __CLASS__, 'postTypes' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'assets' ] );
  //      add_action( 'after_setup_theme', [ __CLASS__, 'menus' ] );
  		add_action( 'after_setup_theme', [ __CLASS__, 'imageControl' ]);
    }

	public static function addExcerpt() {
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
			false
		);

    }

    public static function postTypes() {
        error_log('TEST');
    }

	public static function imageControl() {

		// Standard sizes - thumbnail (150x150), medium (300x300), large (1024x1024)

		add_image_size( 'hero', 1920, 960, true );
		add_image_size( 'content', 800, 0, false ); // auto height
		add_image_size( 'card', 400, 468, true );
		add_image_size( 'square', 500, 500, true );
		add_image_size( 'gallery', 1260, 0, false );
		add_image_size( 'mobile-thumb', 300, 200, true );
	}
}

LaGreenEvents::init();
