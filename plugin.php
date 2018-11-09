<?php
/*
Plugin Name: WSUWP Plugin Modules
Version: 0.0.1
Description: A skeleton project to use when starting a new WSU WordPress plugin. Replace this description.
Author: washingtonstateuniversity, [Other Plugin Authors]
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/wsuwp-plugin-modules

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {

	return;

} else {

	include_once __DIR__ . '/wsuwp-plugin-modules.php';

	$wsuwp_plugin_modules = WSUWP\Plugin_Modules\WSUWP_Plugin_Modules::get_instance();

} // End if
