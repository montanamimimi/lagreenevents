<?php

namespace LagreenTheme;

class Setup {
    public static function init() {              
        show_admin_bar(false);
		add_action( 'init',  [ __CLASS__, 'addSupport' ]  );
        add_action( 'init', [ __CLASS__, 'postTypes' ] );
		add_action( 'init', [ __CLASS__, 'settingsPage' ] );    
        add_action( 'after_setup_theme', [ __CLASS__, 'imageControl' ]);         
    }

	public static function addSupport() {
		add_post_type_support( 'page', 'excerpt' );
		add_theme_support( 'post-thumbnails' );
	}   

    public static function postTypes() {
		register_taxonomy(
			'request_status',
			'requests',
			[
				'labels' => [
					'name'          => 'Statuses',
					'singular_name' => 'Status',
				],
				'hierarchical'      => false,  
				'show_ui'           => true,
				'show_admin_column' => true,   
				'rewrite'           => false,   
				'public'            => false,  
			]
		);
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
			'public' => false,
			'publicly_queryable' => false,
			'show_in_rest' => false,
			'show_ui' => true,  
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
			'publicly_queryable' => false,
			'show_in_rest' => false,
			'show_ui' => true,  			
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
			'public' => false,
			'publicly_queryable' => false,
			'show_in_rest' => false,
			'show_ui' => true, 
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
			'publicly_queryable' => false,
			'show_in_rest' => false,
			'show_ui' => true,  
			'labels' => array(
				'name' => 'Fortune Wheel',
				'add_new_item' => 'Add new wheel',
				'edit_item' => 'Edit wheel',
				'all_items' => 'All wheels',
				'singular_name' => 'Fortune Wheel'
			),
			'menu_icon' => 'dashicons-games'
		));		
		register_post_type( 'request', array(    
			'supports' => array('title'),		
			'has_archive' => false,
			'public' => false,
			'publicly_queryable' => false,
			'show_in_rest' => false,
			'show_ui' => true,  
			'taxonomies' => array('request_status'),
			'labels' => array(
				'name' => 'Requests',
				'add_new_item' => 'Add new request',
				'edit_item' => 'Edit request',
				'all_items' => 'All requests',
				'singular_name' => 'Requests'
			),
			'menu_icon' => 'dashicons-email-alt'
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