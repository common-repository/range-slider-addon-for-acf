<?php

class gwlrs_range_slider extends acf_field {
	
	
	//plugin construct	
	function __construct() {
	
		$this->name = 'Range';		
		$this->label = __('Range Slider', 'acf-range');
		$this->category = 'basic';		
		$this->defaults = array(
			'value'			=> false,
			'icon_class'	=> 'dashicons-arrow-right',
			'font_size'	=> 14,
			'slider_type' => 'default',
			'min' => 0,
			'max' => 100,
			'default_value_1' => 0,
			'default_value_2' => 100,
			'step' => 1,
			'title' => __('Range','acf'),
			'separate' => '-',
			'prepend' => '',
			'append'  => '',
		);
		
		$this->l10n = array(
			'error'	=> __('Higher value requrired', 'acf-range'),
		);
		
		parent::__construct();
		$this->settings = array(
		'path' => apply_filters('acf/helpers/get_path', __FILE__),
		'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
		'version' => '1.0'
		);    	
	}
	
	
	//Field Back-end menu	
	function render_field_settings( $field ) {
		
		acf_render_field_setting( $field, array(
			'label'			=> __('Title','acf-range'),
			'instructions'	=> __('eg. Show extra content before numbers','acf-range'),
			'type'			=> 'text',
			'name'			=> 'title',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Prepend','acf-range'),
			'instructions'	=> __('Appears before the number','acf-range'),
			'type'			=> 'text',
			'name'			=> 'prepend',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Append','acf-range'),
			'instructions'	=> __('Appears after the number','acf-range'),
			'type'			=> 'text',
			'name'			=> 'append',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Separate Symbol','acf-range'),
			'instructions'	=> __('Choose the separator for two values for the Slider view','acf-range'),
			'type'			=> 'text',
			'name'			=> 'separate',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value #1','acf-range'),
			'instructions'	=> __('Appears when creating a new post','acf-range'),
			'type'			=> 'number',
			'name'			=> 'default_value_1',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value #2','acf-range'),
			'instructions'	=> __('Appears when creating a new post for the Slider view','acf-range'),
			'type'			=> 'number',
			'name'			=> 'default_value_2',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Minimum value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'min',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Maximum Value','acf-range'),
			'type'			=> 'number',
			'name'			=> 'max',
		));

		acf_render_field_setting( $field, array(
			'label'			=> __('Step size','acf-range'),
			'type'			=> 'number',
			'name'			=> 'step',
		));
	}
	
	//Back-end HTML Design
	function render_field( $field ) {

		$step = $field['step'];
		if(empty($step)){$step = 1;}
		$slider_type = "range";
		$fname = $field['_name'];	
		$min = $field['min'];
		$max = $field['max'];
		$prepend = $field['prepend'];
		$append = $field['append'];
		$default_value_1 = $field['default_value_1'];
		$default_value_2 = $field['default_value_2'];

		if(!empty(get_field("$fname")['min']) || !empty(get_field("$fname")['max'])) {
			$min_cur = get_field("$fname")['min'];
			$max_cur = get_field("$fname")['max'];
		}
		else if(!empty($default_value_1) || !empty($default_value_2)) {
			$min_cur = $default_value_1;
			$max_cur = $default_value_2;
		}
		else {
			$min_cur = 0;
			$max_cur = 100;
		}

		$value = "$min_cur;$max_cur";

		$title = '';
		if(!empty($field['title']))
		{
			$title = '<span class="am_range_amount_title"> '.esc_html($field['title']).' </span>';
		}		
		$separate = '';
		if(!empty($field['separate'])){
			$separate = ' <span class="am_range_amount_sep">'.esc_html($field['separate']).'</span> ';
		}
		$min_cur = $default_value_1;
		$max_cur = $default_value_2;
		if($slider_type=='range'){
			if( isset( $value ) && $value != ''){
				$value_ar = explode(';', $value);
				if(isset($value_ar[0])){
					$min_cur = $value_ar[0];
					$min_cur;
				}
				if(isset($value_ar[1])){
					$max_cur = $value_ar[1];
					$max_cur;
				}
			}
			if($value===false){
				$value = $min_cur.';'.$max_cur;
			}
		}else{
			if( isset( $value ) && $value!=''){
				$min_cur = $max_cur = $value;
			}
			if( isset( $value ) && $value===false){
				$value = $min_cur;
			}
		}

		$html = '';
		
		$html .= '<div class="am_range_amount">';
		
		if($slider_type=='range')
		{
			$html .= '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.$separate.$prepend.'<span class="am_range_amount_max"></span>'.$append.'</p>';
		}else{
			$html .= '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.'</p>';
		}
		
		$html .= '<div class="am_range" data-min="' . $min . '" data-max="' . $max . '" data-min-cur="' . $min_cur . '" data-max-cur="' . $max_cur . '" data-step="' . $step . '" data-type="' . $slider_type . '"></div>';
		
		$html .= '<input type="hidden" value="' . $value . '" name="' . $field['name'] . '" class="am_range_input" />';
		
		$html .= '</div>';

		_e($html,'acf');
		
	}
	
		
	//Post page content	
	function input_admin_enqueue_scripts() {
		$dir = plugin_dir_url( __DIR__ );
		wp_register_script('acf-input-range', $dir . 'admin/js/input.js', array('acf-input'), $this->settings['version']);
		wp_enqueue_script(array('acf-input-range',));
		wp_enqueue_script( 'acf-am-range', $dir . 'admin/js/range.js', array('acf-input-range', 'range-slider'), $this->settings['version'], true );
		wp_enqueue_script( 'acf-range-validation', $dir . 'admin/js/validation.js', array('jquery'), $this->settings['version'], true );
		wp_enqueue_style('acf-am-jquery-ui',  $dir . 'admin/css/range-slider-addon.css',array(),$this->settings['version']);
}
	
	function load_value( $value, $post_id, $field ) {		
		return $value;		
	}
	
	function update_value( $value, $post_id, $field ) {		
		return $value;		
	}

	function format_value($value, $post_id, $field){
		if( !$value ){
			return 0;
		}
		if( $value == 'null' ){
			return 0;
		}		
		$temp = explode(';', $value);		
		$value_ar = array('min'=>0, 'max'=>0);
		
		if(isset($temp[0])){
			$value_ar['min'] = floatval($temp[0]);
		}
		if(isset($temp[1])){
			$value_ar['max'] = floatval($temp[1]);
		}else{
			if(isset($temp[0])){
				$value_ar = floatval($temp[0]);
			}
		}
		return $value_ar;
	}

	function load_field( $field ) {		
		return $field;		
	}

	function update_field( $field ) {		
		return $field;		
	}
}

new gwlrs_range_slider();

?>