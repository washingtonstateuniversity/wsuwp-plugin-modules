<?php
/*
Plugin Name: WSUWP Toolbox
Version: 0.0.4
Description: Plugin for allowing site creators to turn features on and off.
Author: washingtonstateuniversity, Danial Bleile
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
