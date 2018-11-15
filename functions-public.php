<?php

function wsuwp_toolbox_get_plugin_url() {

	$url = plugin_dir_url( __FILE__ );

	return $url;

} // end wsuwp_toolbox_register_module

function wsuwp_toolbox_get_plugin_version() {

	$version = WSUWP\Plugin_Modules\WSUWP_Plugin_Modules::$version;

	return $version;

} // end wsuwp_toolbox_register_module


function wsuwp_toolbox_register_module( $id, $module_class ) {

	if ( ! empty( $id ) ) {

		global $wsuwp_modules;

		if ( ! is_array( $wsuwp_modules ) ) {

			$wsuwp_modules = array();

		} // End if

		$parent_class = '\WSUWP\Plugin_Modules\Module';

		if ( class_exists( $module_class ) && is_subclass_of( $module_class, $parent_class ) ) {

			$wsuwp_modules[ $id ] = $module_class;

		} // End if

		return true;

	} else {

		return false;

	} // End if

} // end wsuwp_toolbox_register_module


function wsuwp_toolbox_is_active_module( $id, $default = false ) {

	$key = get_wsuwp_toolbox_module_key( $id );

	$is_active = get_option( $key );

	if ( 'active' === $is_active ) {

		return true;

	} elseif ( 'inactive' === $is_active ) {

		return false;

	} else {

		return $default;

	} // End if

} // End wsuwp_toolbox_is_active_module


function get_wsuwp_toolbox_registered_modules() {

	global $wsuwp_modules;

	if ( ! is_array( $wsuwp_modules ) ) {

		$wsuwp_modules = array();

	} // End if

	return $wsuwp_modules;

} // end wsuwp_toolbox_register_module


function get_wsuwp_toolbox_module_key( $id ) {

	return 'wsuwp_toolbox_module_' . $id . '_status';

} // end get_wsuwp_toolbox_module_key


function get_wsuwp_toolbox_module( $id ) {

	$module = false;

	$parent_class = '\WSUWP\Plugin_Modules\Module';

	$registered_modules = get_wsuwp_toolbox_registered_modules();

	if ( array_key_exists( $id, $registered_modules ) ) {

		$module_class = $registered_modules[ $id ];

		if ( class_exists( $module_class ) && is_subclass_of( $module_class, $parent_class ) ) {

			$module = new $module_class();

		} // End if
	} // End if

	return $module;

} // end get_wsuwp_toolbox_module_key
