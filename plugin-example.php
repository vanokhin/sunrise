<?php
/*
  Plugin Name: Example Plugin (Sunrise)
  Plugin URI: http://gndev.info/sunrise/
  Version: 6.0.0
  Description: Options Page Framework
  Author: Vladimir Anokhin
  Author URI: http://gndev.info/
  Text Domain: plugin-example
  Domain Path: /languages
  License: MIT
 */

require_once 'sunrise.php';

/**
 * Initialize example plugin
 */
function plugin_example_init() {

	// Make plugin available for translation, change /languages/ to your .mo-files folder name
	load_plugin_textdomain( 'plugin-example', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	// Initialize Sunrise
	$admin = new Sunrise6( array(
			'file'       => __FILE__,
			'slug'       => 'plugin-example',
			'prefix'     => 'plugin_example_',
			'textdomain' => 'plugin-example',
			'css'        => '',
			'js'         => ''
		) );

	// Prepare array with options
	$options = array(

		// Open tab: Regular fields
		array(
			'type' => 'opentab',
			'name' => __( 'Regular fields', 'plugin-example' )
		),

		// Text field
		array(
			'id'      => 'text_field_id',
			'type'    => 'text',
			'default' => 'Default value',
			'name'    => __( 'Text field', 'plugin-example' ),
			'desc'    => __( 'Text field description', 'plugin-example' )
		),

		// Textarea
		array(
			'id'      => 'textarea_id',
			'type'    => 'textarea',
			'default' => 'Default value',
			'rows'    => 10,
			'name'    => __( 'Textarea', 'plugin-example' ),
			'desc'    => __( 'Textarea description', 'plugin-example' )
		),

		// Checkbox
		array(
			'id'      => 'checkbox_id',
			'type'    => 'checkbox',
			'default' => 'on',
			'name'    => __( 'Checkbox', 'plugin-example' ),
			'desc'    => __( 'Checkbox description', 'plugin-example' ),
			'label'   => __( 'Enabled', 'plugin-example' )
		),

		// Select (dropdown list)
		array(
			'id'      => 'select_id',
			'type'    => 'select',
			'default' => 'option-1',
			'name'    => __( 'Select', 'plugin-example' ),
			'desc'    => __( 'Select description', 'plugin-example' ),
			'options' => array(
				array(
					'value' => 'option-1',
					'label'  => __( 'Option 1', 'plugin-example' )
				),
				array(
					'value' => 'option-2',
					'label'  => __( 'Option 2', 'plugin-example' )
				),
				array(
					'value' => 'option-3',
					'label'  => __( 'Option 3', 'plugin-example' )
				)
			)
		),

		// Multi-select (dropdown list with multiple choices)
		array(
			'id'      => 'multi_select_id',
			'type'    => 'select',
			'default' => array( 'option-1', 'option-2' ),
			'name'    => __( 'Multi-select', 'plugin-example' ),
			'desc'    => __( 'Multi-select description', 'plugin-example' ),
			'options' => array(
				array(
					'value' => 'option-1',
					'label'  => __( 'Option 1', 'plugin-example' )
				),
				array(
					'value' => 'option-2',
					'label'  => __( 'Option 2', 'plugin-example' )
				),
				array(
					'value' => 'option-3',
					'label'  => __( 'Option 3', 'plugin-example' )
				)
			),
			'multiple' => true,
			'size' => 4
		),

		// Radio buttons
		array(
			'id'      => 'radio_id',
			'type'    => 'radio',
			'default' => 'option-1',
			'name'    => __( 'Radio', 'plugin-example' ),
			'desc'    => __( 'Radio description', 'plugin-example' ),
			'options' => array(
				array(
					'value' => 'option-1',
					'label'  => __( 'Option 1', 'plugin-example' )
				),
				array(
					'value' => 'option-2',
					'label'  => __( 'Option 2', 'plugin-example' )
				),
				array(
					'value' => 'option-3',
					'label'  => __( 'Option 3', 'plugin-example' )
				)
			)
		),

		// Number picker
		array(
			'id'      => 'number_field_id',
			'type'    => 'number',
			'default' => 10,
			'name'    => __( 'Number', 'plugin-example' ),
			'desc'    => __( 'Number field description', 'plugin-example' ),
			'min'     => 0,
			'max'     => 20,
			'step'    => 1
		),

		// Close tab: Regular fields
		array(
			'type' => 'closetab'
		),

		// Open tab: Extra fields
		array(
			'type' => 'opentab',
			'name' => __( 'Extra fields', 'plugin-example' )
		),

		// Media (text field with Media library button)
		array(
			'id'      => 'media_field_id',
			'type'    => 'media',
			'default' => '',
			'name'    => __( 'Media', 'plugin-example' ),
			'desc'    => __( 'Media field description', 'plugin-example' )
		),

		// Color picker
		array(
			'id'      => 'color_field_id',
			'type'    => 'color',
			'default' => '#0099ff',
			'name'    => __( 'Color', 'plugin-example' ),
			'desc'    => __( 'Color field description', 'plugin-example' )
		),

		// Size picker
		array(
			'id'      => 'size_field_id',
			'type'    => 'size',
			'default' => array( 0 => '20', 1 => 'px' ),
			'name'    => __( 'Size', 'plugin-example' ),
			'desc'    => __( 'Size field description', 'plugin-example' ),
			'units'   => array( 'px', 'em', '%' ),
			'min'     => 0,
			'max'     => 200,
			'step'    => 10
		),

		// Checkbox group
		array(
			'id'      => 'checkbox_group_id',
			'type'    => 'checkbox_group',
			'default' => array(
				'checkbox-1' => 'on',
				'checkbox-2' => 'on'
			),
			'name'    => __( 'Checkbox group', 'plugin-example' ),
			'desc'    => __( 'Checkbox group description', 'plugin-example' ),
			'options' => array(
				array(
					'id'    => 'checkbox-1',
					'label' => __( 'Checkbox 1', 'plugin-example' )
				),
				array(
					'id'    => 'checkbox-2',
					'label' => __( 'Checkbox 2', 'plugin-example' )
				),
				array(
					'id'    => 'checkbox-3',
					'label' => __( 'Checkbox 3', 'plugin-example' )
				)
			),
			'multiple' => true,
			'size' => 4
		),

		// Custom HTML content
		array(
			'type'    => 'html',
			'content' => '<h3>HTML field type</h3><p>Paragraph tag</p>'
		),

		// Custom title
		array(
			'type' => 'title',
			'name' => __( 'Title field', 'plugin-example' )
		),

		// Image radio
		array(
			'id'      => 'image_radio_id',
			'type'    => 'image_radio',
			'default' => 'option-1',
			'name'    => __( 'Image radio', 'plugin-example' ),
			'desc'    => __( 'Image radio description', 'plugin-example' ),
			'options' => array(
				array(
					'value' => 'option-1',
					'label' => __( 'Option 1', 'plugin-example' ),
					'image' => 'http://lorempixel.com/120/90/food/1/'
				),
				array(
					'value' => 'option-2',
					'label' => __( 'Option 2', 'plugin-example' ),
					'image' => 'http://lorempixel.com/120/90/food/2/'
				),
				array(
					'value' => 'option-3',
					'label' => __( 'Option 3', 'plugin-example' ),
					'image' => 'http://lorempixel.com/120/90/food/3/'
				)
			)
		),

		// Close tab: Extra fields
		array(
			'type' => 'closetab'
		)
	);

	// Add top-level menu (like Dashboard -> Comments)
	$admin->add_menu( array(
			'page_title'  => __( 'Example Plugin Settings', 'plugin-example' ), // Settings page <title>
			'menu_title'  => __( 'Example Plugin', 'plugin-example' ), // Menu title, will be shown in left dashboard menu
			'capability'  => 'manage_options', // Minimal user capability to access this page
			'slug'        => 'plugin-example-settings', // Unique page slug
			'icon_url'    => admin_url( 'images/wp-logo.png' ), // Add here your custom icon url
			'position'    => '91.1', // Menu position from 80 to <infinity>, you can use decimals
			'options'     => $options // Array with options available on this page
		) );

	// Add sub-menu (like Dashboard -> Settings -> Permalinks)
	$admin->add_submenu( array(
			'page_title'  => __( 'Example Plugin Settings', 'plugin-example' ), // Settings page <title>
			'menu_title'  => __( 'Page 2', 'plugin-example' ), // Menu title, will be shown in left dashboard menu
			'slug'        => 'plugin-example-settings-2', // Unique page slug, you can use here the slug of parent page, which you've already created
			'parent_slug' => 'plugin-example-settings', // Slug of the parent page (see above)
			'options'     => $options // Array with options available on this page
		) );

	// Add another sub-menu (like Dashboard -> Settings -> Permalinks)
	$admin->add_submenu( array(
			'page_title'  => __( 'Example Plugin Settings', 'plugin-example' ), // Settings page <title>
			'menu_title'  => __( 'Page 3', 'plugin-example' ), // Menu title, will be shown in left dashboard menu
			'slug'        => 'plugin-example-settings-3', // Unique page slug, you can use here the slug of parent page, which you've already created
			'parent_slug' => 'plugin-example-settings', // Slug of the parent page (see above)
			'options'     => $options // Array with options available on this page
		) );
}

// Hook to plugins_loaded
add_action( 'plugins_loaded', 'plugin_example_init' );
