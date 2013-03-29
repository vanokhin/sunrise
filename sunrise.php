<?php

	/*
	  Plugin Name: Plugin name
	  Plugin URI: http://example.com/
	  Version: 1.3.0
	  Author: Author Name
	  Author URI: http://example.com/
	  Description: Plugin description
	  Text Domain: plugin-name
	  Domain Path: /languages
	  License: GPL3
	 */

	// Include Sunrise Plugin Framework class
	require_once 'classes/sunrise.class.php';

	// Create plugin instance
	$sunrise = new Sunrise_Plugin_Framework;

	$sunrise->add_settings_page( array(
		'parent' => 'options-general.php',
		'page_title' => $sunrise->name,
		'menu_title' => $sunrise->name,
		'capability' => 'manage_options',
		'settings_link' => true
	) );

	// Include plugin actions
	require_once 'inc/plugin-actions.php';

	// Make plugin meta translatable
	__( 'Author Name', $sunrise->textdomain );
	__( 'Vladimir Anokhin', $sunrise->textdomain );
	__( 'Plugin description', $sunrise->textdomain );
?>