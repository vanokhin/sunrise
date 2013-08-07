<?php

	/*
	  Plugin Name: Plugin name
	  Plugin URI: http://example.com/
	  Version: 2.0.0
	  Author: Author Name
	  Author URI: http://example.com/
	  Description: Plugin description
	  Text Domain: example-plugin-textdomain
	  Domain Path: /lang
	  License: GPL
	 */

	// Include Sunrise Plugin Framework class
	require_once 'classes/sunrise.class.php';

	// Create plugin instance
	$plugin_example = new Sunrise_Plugin_Framework_2( __FILE__ );

	// Include options set
	include_once 'inc/options.php';

	// Create options page
	$plugin_example->add_options_page( array(), $plugin_example_options );

	// Make plugin meta translatable
	__( 'Plugin Name', $plugin_example->textdomain );
	__( 'Author Name', $plugin_example->textdomain );
	__( 'Plugin description', $plugin_example->textdomain );
?>