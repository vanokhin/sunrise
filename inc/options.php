<?php
	$plugin_example_options = array(
		array( 'name' => __( 'About', $plugin_example->textdomain ), 'type' => 'opentab' ),
		array( 'type' => 'about' ),
		array( 'type' => 'closetab', 'actions' => false ),
		array(
			'name' => __( 'Standard fields', $plugin_example->textdomain ),
			'type' => 'opentab'
		),
		array(
			'name' => __( 'Text input', $plugin_example->textdomain ),
			'desc' => __( 'Text input description', $plugin_example->textdomain ),
			'std' => 'Default value',
			'id' => 'text',
			'type' => 'text'
		),
		array(
			'name' => __( 'Textarea', $plugin_example->textdomain ),
			'desc' => __( 'Textarea description', $plugin_example->textdomain ),
			'std' => 'Default value',
			'id' => 'textarea',
			'type' => 'textarea',
			'rows' => 7
		),
		array(
			'name' => __( 'Checkbox', $plugin_example->textdomain ),
			'desc' => __( 'Checkbox description', $plugin_example->textdomain ),
			'std' => 'on',
			'id' => 'checkbox',
			'type' => 'checkbox',
			'label' => __( 'Checkbox label', $plugin_example->textdomain )
		),
		array(
			'name' => __( 'Radio buttons', $plugin_example->textdomain ),
			'desc' => __( 'Radio buttons description', $plugin_example->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $plugin_example->textdomain ),
				'option2' => __( 'Option 2', $plugin_example->textdomain ),
				'option3' => __( 'Option 3', $plugin_example->textdomain )
			),
			'std' => 'option1',
			'id' => 'radio',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Select', $plugin_example->textdomain ),
			'desc' => __( 'Select description', $plugin_example->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $plugin_example->textdomain ),
				'option2' => __( 'Option 2', $plugin_example->textdomain ),
				'option3' => __( 'Option 3', $plugin_example->textdomain )
			),
			'std' => 'option1',
			'id' => 'select',
			'type' => 'select'
		),
		array( 'type' => 'closetab' ),
		array(
			'name' => __( 'Additional fields', $plugin_example->textdomain ),
			'type' => 'opentab'
		),
		array(
			'name' => __( 'Title field', $plugin_example->textdomain ),
			'type' => 'title'
		),
		array(
			'html' => '<p>Vestibulum nec quam nisl. Nulla facilisi. Etiam placerat tempor rutrum. Fusce pellentesque tellus adipiscing nulla eleifend pretium. In lacinia lectus et sapien elementum eget sollicitudin ante suscipit. Nunc eu arcu nec risus bibendum mattis. Suspendisse nisi magna, <a href="#">pretium in aliquam viverra</a>, cursus tincidunt quam. Ut nec risus elit, vel pellentesque felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p><p>Fusce venenatis condimentum est, eget gravida erat interdum tristique. In hac habitasse platea dictumst. In hac habitasse platea dictumst. Vestibulum fringilla egestas erat, sit amet ullamcorper nisi placerat vel.</p>',
			'type' => 'html'
		),
		array(
			'name' => __( 'Checkbox group', $plugin_example->textdomain ),
			'desc' => __( 'Checkbox group description', $plugin_example->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $plugin_example->textdomain ),
				'option2' => __( 'Option 2', $plugin_example->textdomain ),
				'option3' => __( 'Option 3', $plugin_example->textdomain )
			),
			'std' => array( 'option1' => '', 'option2' => 'on', 'option3' => 'on', ),
			'id' => 'checkbox-group',
			'type' => 'checkbox-group'
		),
		array(
			'name' => __( 'Number', $plugin_example->textdomain ),
			'desc' => __( 'Number field description', $plugin_example->textdomain ),
			'std' => 100,
			'min' => 0,
			'max' => 1000,
			'units' => __( 'pixels', $plugin_example->textdomain ),
			'id' => 'number',
			'type' => 'number'
		),
		array(
			'name' => __( 'Size', $plugin_example->textdomain ),
			'desc' => __( 'Size field description', $plugin_example->textdomain ),
			'std' => array( 14, 'px' ),
			'min' => 1,
			'max' => 72,
			'units' => array( 'px', 'em', '%', 'pt' ),
			'id' => 'size',
			'type' => 'size'
		),
		array(
			'name' => __( 'Upload', $plugin_example->textdomain ),
			'desc' => __( 'Upload field description', $plugin_example->textdomain ),
			'std' => '',
			'id' => 'upload',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Color picker', $plugin_example->textdomain ),
			'desc' => __( 'Color picker description', $plugin_example->textdomain ),
			'std' => '#00bb00',
			'id' => 'color',
			'type' => 'color'
		),
		array(
			'name' => __( 'Code editor', $plugin_example->textdomain ),
			'desc' => __( 'Code editor description', $plugin_example->textdomain ),
			'std' => '',
			'rows' => 7,
			'id' => 'code',
			'type' => 'code'
		),
		array( 'type' => 'closetab' )
	);