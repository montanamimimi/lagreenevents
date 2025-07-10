<?php 

require_once( get_template_directory() . "/inc/helpers.php" );

class LaGreenEvents {
    public static $version = '1.0.0';

    public static function init() {
        show_admin_bar(false);
        add_action( 'init', [ __CLASS__, 'postTypes' ] );
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'assets' ] );
  //      add_action( 'after_setup_theme', [ __CLASS__, 'menus' ] );        
    }

    public static function assets() {
        $themePath = get_template_directory_uri();
        
        wp_enqueue_style(
			'lagreen__styles',
			"{$themePath}/build/index.css",
			[],
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
}

LaGreenEvents::init();
