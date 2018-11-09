<?php

function wsuwp_mods_get_plugin_url() {

	$url = plugin_dir_url( __FILE__ );

	return $url;

} // end wsuwp_mods_register_module

function wsuwp_mods_get_plugin_version() {

	$version = WSUWP\Plugin_Modules\WSUWP_Plugin_Modules::$version;

	return $version;

} // end wsuwp_mods_register_module


function wsuwp_mods_register_module( $id, $register_args ) {

	if ( ! empty( $id ) ) {

		global $wsuwp_modules;

		if ( ! is_array( $wsuwp_modules ) ) {

			$wsuwp_modules = array();

		} // End if

		$default_reg_args = array(
			'version'      => wsuwp_mods_get_plugin_version(),
			'title'        => 'Please set a title',
			'description'  => '',
			'priority'     => 10,
			'capability'   => 'Super Admin',
		);

		$args = wp_parse_args( $register_args, $default_reg_args );

		$wsuwp_modules[ $id ] = $args;

		return true;

	} else {

		return false;

	} // End if

} // end wsuwp_mods_register_module


function wsuwp_mods_is_active_module( $slug ) {

	return true;

} // End wsuwp_mods_is_active_module
