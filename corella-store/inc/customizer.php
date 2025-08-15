<?php
if (!defined('ABSPATH')) { exit; }

add_action('customize_register', function($wp_customize){
	$wp_customize->add_section('corella_section_store', [
		'title' => __('Corella Store Settings', 'corella-store'),
		'priority' => 30,
	]);

	$wp_customize->add_setting('corella_whatsapp_phone', [
		'default' => '+21600000000',
		'type' => 'theme_mod',
		'sanitize_callback' => function($value){ return preg_replace('/[^\d+]/', '', $value); },
	]);

	$wp_customize->add_control('corella_whatsapp_phone', [
		'label' => __('WhatsApp Phone (e.g. +216xxxxxxxx)', 'corella-store'),
		'section' => 'corella_section_store',
		'settings' => 'corella_whatsapp_phone',
		'type' => 'text',
	]);
});

// Filter to expose phone elsewhere
add_filter('corella_whatsapp_phone', function($default){
	$phone = get_theme_mod('corella_whatsapp_phone');
	return $phone ? $phone : $default;
});