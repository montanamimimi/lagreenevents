<?php 

namespace LagreenTheme;

class Scripts {

    public static function init() {      
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_assets']);
    }

    public static function enqueue_assets() {

        $themePath = get_template_directory_uri();
		$version = wp_get_theme()->get('Version');

		wp_enqueue_style(
			'lagreen__fonts',
			"{$themePath}/fonts/fonts.css",
			[],
			$version
		);
        
        wp_enqueue_style(
			'lagreen__styles',
			"{$themePath}/build/index.css",
			['lagreen__fonts'],
			$version
		);
		wp_enqueue_script(
			'lagreen__scripts',
			"{$themePath}/build/index.js",
			[],
			$version,
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
}
