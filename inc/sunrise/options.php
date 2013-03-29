<?php

	/** Plugin options */
	$options = array(
		array(
			'name' => __( 'About', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'type' => 'about'
		),
		array(
			'type' => 'closetab',
			'actions' => false
		),
		array(
			'name' => __( 'Standard fields', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'name' => __( 'Text input', $this->textdomain ),
			'desc' => __( 'Text input description', $this->textdomain ),
			'std' => 'Default value',
			'id' => 'text',
			'type' => 'text'
		),
		array(
			'name' => __( 'Textarea', $this->textdomain ),
			'desc' => __( 'Textarea description', $this->textdomain ),
			'std' => 'Default value',
			'id' => 'textarea',
			'type' => 'textarea',
			'rows' => 7
		),
		array(
			'name' => __( 'Checkbox', $this->textdomain ),
			'desc' => __( 'Checkbox description', $this->textdomain ),
			'std' => 'on',
			'id' => 'checkbox',
			'type' => 'checkbox',
			'label' => __( 'Checkbox label', $this->textdomain )
		),
		array(
			'name' => __( 'Radio buttons', $this->textdomain ),
			'desc' => __( 'Radio buttons description', $this->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $this->textdomain ),
				'option2' => __( 'Option 2', $this->textdomain ),
				'option3' => __( 'Option 3', $this->textdomain )
			),
			'std' => 'option1',
			'id' => 'radio',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Select', $this->textdomain ),
			'desc' => __( 'Select description', $this->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $this->textdomain ),
				'option2' => __( 'Option 2', $this->textdomain ),
				'option3' => __( 'Option 3', $this->textdomain )
			),
			'std' => 'option1',
			'id' => 'select',
			'type' => 'select'
		),
		array(
			'type' => 'closetab'
		),
		array(
			'name' => __( 'Additional fields', $this->textdomain ),
			'type' => 'opentab'
		),
		array(
			'name' => __( 'Title field', $this->textdomain ),
			'type' => 'title'
		),
		array(
			'html' => '<p>Vestibulum nec quam nisl. Nulla facilisi. Etiam placerat tempor rutrum. Fusce pellentesque tellus adipiscing nulla eleifend pretium. In lacinia lectus et sapien elementum eget sollicitudin ante suscipit. Nunc eu arcu nec risus bibendum mattis. Suspendisse nisi magna, <a href="#">pretium in aliquam viverra</a>, cursus tincidunt quam. Ut nec risus elit, vel pellentesque felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p><p>Fusce venenatis condimentum est, eget gravida erat interdum tristique. In hac habitasse platea dictumst. In hac habitasse platea dictumst. Vestibulum fringilla egestas erat, sit amet ullamcorper nisi placerat vel.</p>',
			'type' => 'html'
		),
		array(
			'name' => __( 'Checkbox group', $this->textdomain ),
			'desc' => __( 'Checkbox group description', $this->textdomain ),
			'options' => array(
				'option1' => __( 'Option 1', $this->textdomain ),
				'option2' => __( 'Option 2', $this->textdomain ),
				'option3' => __( 'Option 3', $this->textdomain )
			),
			'std' => array(
				'option1' => '',
				'option2' => 'on',
				'option3' => 'on',
			),
			'id' => 'checkbox-group',
			'type' => 'checkbox-group'
		),
		array(
			'name' => __( 'Number', $this->textdomain ),
			'desc' => __( 'Number field description', $this->textdomain ),
			'std' => 100,
			'min' => 0,
			'max' => 1000,
			'units' => __( 'pixels', $this->textdomain ),
			'id' => 'number',
			'type' => 'number'
		),
		array(
			'name' => __( 'Size', $this->textdomain ),
			'desc' => __( 'Size field description', $this->textdomain ),
			'std' => array( 14, 'px' ),
			'min' => 1,
			'max' => 72,
			'units' => array( 'px', 'em', '%', 'pt' ),
			'id' => 'size',
			'type' => 'size'
		),
		array(
			'name' => __( 'Upload', $this->textdomain ),
			'desc' => __( 'Upload field description', $this->textdomain ),
			'std' => '',
			'id' => 'upload',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Color picker', $this->textdomain ),
			'desc' => __( 'Color picker description', $this->textdomain ),
			'std' => '#00bb00',
			'id' => 'color',
			'type' => 'color'
		),
		array(
			'name' => __( 'Code editor', $this->textdomain ),
			'desc' => __( 'Code editor description', $this->textdomain ),
			'std' => '',
			'rows' => 7,
			'id' => 'code',
			'type' => 'code'
		),
		array(
			'type' => 'closetab'
		),
	);
?>