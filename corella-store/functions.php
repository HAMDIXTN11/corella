<?php
/**
 * Corella Store theme functions
 */

if (!defined('ABSPATH')) { exit; }

// Constants
if (!defined('CORELLA_VERSION')) { define('CORELLA_VERSION', '1.0.0'); }
if (!defined('CORELLA_TEXT')) { define('CORELLA_TEXT', 'corella-store'); }

// Theme setup
add_action('after_setup_theme', function () {
	load_theme_textdomain(CORELLA_TEXT, get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
	add_theme_support('custom-logo', [
		'height' => 48,
		'width' => 48,
		'flex-width' => true,
		'flex-height' => true,
	]);

	register_nav_menus([
		'primary' => __('Primary Menu', CORELLA_TEXT),
		'footer' => __('Footer Menu', CORELLA_TEXT),
	]);
});

// Content width
$GLOBALS['content_width'] = 1200;

// Performance: remove emojis
add_action('init', function(){
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');
});

// Resource hints for fonts
add_filter('wp_resource_hints', function($hints, $relation_type){
	if ('preconnect' === $relation_type) {
		$hints[] = 'https://fonts.gstatic.com';
	}
	return $hints;
}, 10, 2);

// Enqueue assets
add_action('wp_enqueue_scripts', function () {
	$theme_uri = get_template_directory_uri();

	// Google Fonts (Manrope)
	wp_enqueue_style('corella-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap', [], null);

	// Main stylesheet
	wp_enqueue_style('corella-style', $theme_uri . '/style.css', [], CORELLA_VERSION);

	// RTL support
	if (is_rtl()) {
		wp_enqueue_style('corella-rtl', $theme_uri . '/assets/css/rtl.css', ['corella-style'], CORELLA_VERSION);
	}

	// Theme script
	wp_enqueue_script('corella-main', $theme_uri . '/assets/js/main.js', [], CORELLA_VERSION, true);

	// Localize for WhatsApp and i18n
	$phone = apply_filters('corella_whatsapp_phone', '+21600000000');
	wp_localize_script('corella-main', 'CORELLA', [
		'whatsappPhone' => $phone,
		'i18n' => [
			'shopNow' => __('Shop Now', CORELLA_TEXT),
			'menu' => __('Menu', CORELLA_TEXT),
			'orderWhatsApp' => __('Order via WhatsApp', CORELLA_TEXT),
		]
	]);
});

// WooCommerce image sizes and tweaks
add_action('after_setup_theme', function () {
	add_theme_support('woocommerce', [
		'thumbnail_image_width' => 600,
		'single_image_width' => 1100,
		'product_grid' => [
			'default_rows' => 3,
			'min_rows' => 1,
			'max_rows' => 6,
			'default_columns' => 4,
			'min_columns' => 2,
			'max_columns' => 4,
		],
	]);
});

// Register sidebar
add_action('widgets_init', function () {
	register_sidebar([
		'name' => __('Footer Column 1', CORELLA_TEXT),
		'id' => 'footer-1',
		'before_widget' => '<section class="widget">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>',
	]);
	register_sidebar([
		'name' => __('Footer Column 2', CORELLA_TEXT),
		'id' => 'footer-2',
		'before_widget' => '<section class="widget">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget__title">',
		'after_title' => '</h3>',
	]);
});

// WhatsApp floating button
add_action('wp_footer', function () {
	$phone = apply_filters('corella_whatsapp_phone', '+21600000000');
	$number = preg_replace('/\D+/', '', $phone);
	$url = esc_url('https://wa.me/' . $number);
	echo '<a class="whatsapp-fab" href="' . $url . '" target="_blank" rel="noopener" aria-label="WhatsApp">';
	echo '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M20.52 3.48A11.9 11.9 0 0 0 12.05 0C5.55 0 .27 5.28.27 11.78c0 2.08.55 4.12 1.6 5.91L0 24l6.5-1.7a11.77 11.77 0 0 0 5.54 1.41h.01c6.5 0 11.79-5.28 11.79-11.78 0-3.15-1.23-6.1-3.32-8.45zm-8.47 18.6h-.01a9.8 9.8 0 0 1-4.99-1.37l-.36-.21-3.86 1.01 1.03-3.76-.23-.38a9.83 9.83 0 0 1-1.5-5.21c0-5.43 4.42-9.85 9.86-9.85 2.63 0 5.1 1.02 6.96 2.87a9.81 9.81 0 0 1 2.88 6.98c0 5.44-4.43 9.85-9.88 9.85zm5.41-7.36c-.3-.16-1.77-.87-2.04-.97-.27-.1-.47-.15-.68.15-.2.3-.78.97-.95 1.17-.17.2-.35.22-.65.06-.3-.16-1.26-.46-2.4-1.46-.88-.78-1.47-1.75-1.64-2.05-.17-.3-.02-.47.13-.62.14-.14.3-.35.46-.53.15-.18.2-.3.3-.5.1-.2.05-.37-.02-.53-.07-.16-.68-1.64-.93-2.25-.25-.6-.5-.52-.68-.53-.17-.01-.37-.01-.57-.01-.2 0-.53.08-.81.37-.27.3-1.05 1.03-1.05 2.5 0 1.47 1.08 2.89 1.23 3.09.15.2 2.12 3.23 5.14 4.53.72.31 1.28.49 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.18-1.42-.07-.12-.27-.2-.57-.36z"/></svg>';
	echo '</a>';
});

// Helper to generate WhatsApp link with message
function corella_build_whatsapp_link($phone, $message){
	$number = preg_replace('/\D+/', '', $phone);
	return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
}

// Add WhatsApp CTA on single product
add_action('woocommerce_after_add_to_cart_button', function(){
	$phone = apply_filters('corella_whatsapp_phone', '+21600000000');
	global $product;
	if (!$product) { return; }
	$message = sprintf(__('Hello, I would like to order: %s (%s)', CORELLA_TEXT), $product->get_name(), get_permalink($product->get_id()));
	$link = corella_build_whatsapp_link($phone, $message);
	echo '<a class="button btn btn--dark" style="margin-left:8px" target="_blank" rel="noopener" href="' . esc_url($link) . '">' . esc_html__('Order via WhatsApp', CORELLA_TEXT) . '</a>';
});

// Add WhatsApp CTA on product loops
add_action('woocommerce_after_shop_loop_item', function(){
	$phone = apply_filters('corella_whatsapp_phone', '+21600000000');
	global $product;
	if (!$product) { return; }
	$message = sprintf(__('Hello, I would like to order: %s (%s)', CORELLA_TEXT), $product->get_name(), get_permalink($product->get_id()));
	$link = corella_build_whatsapp_link($phone, $message);
	echo '<a class="button btn btn--light" style="margin-top:8px" target="_blank" rel="noopener" href="' . esc_url($link) . '">' . esc_html__('Order via WhatsApp', CORELLA_TEXT) . '</a>';
}, 20);

// Include customizer
require_once get_template_directory() . '/inc/customizer.php';