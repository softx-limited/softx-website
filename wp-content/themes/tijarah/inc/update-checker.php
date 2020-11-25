<?php

$api_url = 'https://themebing.com/purchase-code-verify/update-checker.php';

/***********************Parent Theme**************/
if(function_exists('wp_get_theme')){
    $theme_data = wp_get_theme(get_option('template'));
    $theme_version = $theme_data->Version;  
} else {
    $theme_data = wp_get_theme( get_template_directory() . '/style.css');
    $theme_version = $theme_data['Version'];
}    
$theme_base = get_option('template');
/**************************************************/

//Uncomment below to find the theme slug that will need to be setup on the api server
//var_dump($theme_base);

add_filter('pre_set_site_transient_update_themes', 'tijarah_check_for_update');

function tijarah_check_for_update( $checked_data ) {
	global $wp_version, $theme_version, $theme_base, $api_url;

	$request = array(
		'slug' => $theme_base,
		'version' => $theme_version 
	);

	$tijarah_activate_license = !empty( get_option('tijarah_activate_license_option') ) ? get_option('tijarah_activate_license_option') : '';

	// Start checking for an update
	$send_for_check = array(
		'body' => array(
			'action' => 'theme_update', 
			'request' => serialize($request),
			'license' => $tijarah_activate_license
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
	);

	$raw_response = wp_remote_post($api_url, $send_for_check);
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)){
		$response = unserialize($raw_response['body']);
	}
	
	// Feed the update data into WP updater
	if (!empty($response)) {
		$checked_data->response[$theme_base] = $response;
	}

	return $checked_data;
}

// Take over the Theme info screen on WP multisite
add_filter('themes_api', 'tijarah_api_call', 10, 3);

function tijarah_api_call($def, $action, $args) {
	global $theme_base, $api_url, $theme_version, $api_url;
	
	if ($args->slug != $theme_base){
		return false;
	}
	
	// Get the current version
	$args->version = $theme_version;

	$request = wp_remote_post($api_url, $args);

	if (is_wp_error($request)) {
		$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', 'tijarah'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false){
			$res = new WP_Error('themes_api_failed', __('An unknown error occurred', 'tijarah'), $request['body']);
		}
	}
	
	return $res;
}

if (is_admin()) {
	$current = get_transient('update_themes');
}