<?php

class gwlrs_range_slider extends acf_field
{
	var 
	$settings, 
	$defaults;

	// __construct
	function __construct()
	{
		$this->name = 'range';
		$this->label = __('Range');
		$this->category = __("jQuery",'acf');
		$this->defaults = array(
			'slider_type' => 'default',
			'min' => 0,
			'max' => 100,
			'default_value_1' => 0,
			'default_value_2' => 100,
			'step' => 1,
			'title' => __('Range','acf'),
			'separate' => '-',
			'prepend' => '',
			'append'  => ''
		);

		parent::__construct();

		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.2'
		);

	}


	//Field Back-end menu
	function create_options($field)
	{
		$field = array_merge($this->defaults, $field);
		$key = $field['name'];

	//Back-end HTML Design
		?>
		<tr class="field_option field_option_range_type field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Type",'acf'); ?></label>
				<p class="description"><?php _e('Choose the number or slider view','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'radio',
					'name'  => 'fields[' . $key . '][slider_type]',
					'choices'  => array('default'=>__('Number','acf'), 'range'=>__('Range','acf')),
					'value' => $field['slider_type'],
					'layout'  => 'horizontal'
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Title",'acf'); ?></label>
				<p class="description"><?php _e('eg. Show extra content before numbers','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'text'
					, 'name'  => 'fields[' . $key . '][title]'
					, 'value' => $field['title']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Prepend",'acf'); ?></label>
				<p class="description"><?php _e('Appears before the number','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'text'
					, 'name'  => 'fields[' . $key . '][prepend]'
					, 'value' => $field['prepend']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Append",'acf'); ?></label>
				<p class="description"><?php _e('Appears after the number','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'text'
					, 'name'  => 'fields[' . $key . '][append]'
					, 'value' => $field['append']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_range_separate field_option_<?php _e($this->name, 'acf'); ?>" <?php /*if( $field['slider_type']!='range' ): ?>style="display:none"<?php endif;*/ ?>>
			<td class="label">
				<label><?php _e("Separate Symbol",'acf'); ?></label>
				<p class="description"><?php _e('Choose the separator for two values for the Slider view','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'text'
					, 'name'  => 'fields[' . $key . '][separate]'
					, 'value' => $field['separate']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Default Value #1",'acf'); ?></label>
				<p class="description"><?php _e('Appears when creating a new post','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'number'
					, 'name'  => 'fields[' . $key . '][default_value_1]'
					, 'value' => $field['default_value_1']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Default Value #2",'acf'); ?></label>
				<p class="description"><?php _e('Appears when creating a new post for the Slider view','acf'); ?></p>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'number'
					, 'name'  => 'fields[' . $key . '][default_value_2]'
					, 'value' => $field['default_value_2']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Minimum Value",'acf'); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'number'
					, 'name'  => 'fields[' . $key . '][min]'
					, 'value' => $field['min']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Maximum Value",'acf'); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'number'
					, 'name'  => 'fields[' . $key . '][max]'
					, 'value' => $field['max']
				) );
				?>
			</td>
		</tr>
		<tr class="field_option field_option_<?php _e($this->name, 'acf'); ?>">
			<td class="label">
				<label><?php _e("Step Size",'acf'); ?></label>
			</td>
			<td>
				<?php
				do_action('acf/create_field', array(
					'type'    => 'number'
					, 'name'  => 'fields[' . $key . '][step]'
					, 'value' => $field['step']
				) );
				?>
			</td>
		</tr>
		<?php

	}

	//Post page content
	function create_field( $field )	{
		$field = array_merge($this->defaults, $field);		
		$step = $field['step'];
		if(empty($step))
			$step = 1;
		$slider_type = $field['slider_type'];
		if(empty($slider_type))
			$slider_type = 'default';
		$min = $field['min'];
		$max = $field['max'];
		$prepend = $field['prepend'];
		$append = $field['append'];
		$default_value_1 = $field['default_value_1'];
		$default_value_2 = $field['default_value_2'];
		$value = $field['value'];

		$title = '';
		if(!empty($field['title'])){
			$title = '<span class="am_range_amount_title"> '.esc_html($field['title']).' </span>';
		}
		
		$separate = '';
		if(!empty($field['separate'])){
			$separate = ' <span class="am_range_amount_sep">'.esc_html($field['separate']).'</span> ';
		}
		$min_cur = $default_value_1;
		$max_cur = $default_value_2;
		if($slider_type=='range'){
			if($value!=''){
				$value_ar = explode(';', $value);
				if(isset($value_ar[0])){
					$min_cur = $value_ar[0];
				}
				if(isset($value_ar[0])){
					$max_cur = $value_ar[1];
				}
			}
			if($value===false){
				$value = $min_cur.';'.$max_cur;
			}
		}else{
			if($value!=''){
				$min_cur = $max_cur = $value;
			}
			if($value===false){
				$value = $min_cur;
			}
		}		
		$html_view = '';
		$html_view .= '<div class="am_range_amount">';	

		if($slider_type=='range')
		{
			$html_view .= '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.$separate.$prepend.'<span class="am_range_amount_max"></span>'.$append.'</p>';
		}
		else
		{
			$html_view .= '<p>'.$title.$prepend.'<span class="am_range_amount_min"></span>'.$append.'</p>';
		}

		$html_view .= '<div class="am_range" data-min="' . $min . '" data-max="' . $max . '" data-min-cur="' . $min_cur . '" data-max-cur="' . $max_cur . '" data-step="' . $step . '" data-type="' . $slider_type . '"></div>';
		$html_view .= '<input type="hidden" value="' . $value . '" name="' . $field['name'] . '" class="am_range_input" />';
		$html_view .= '</div>';

		_e($html_view,'acf');
	}

	//Register Style and Script
	function input_admin_enqueue_scripts()	{
		$dir = plugin_dir_url( __DIR__ );	
		wp_register_script('acf-input-range', $dir . 'admin/js/input.js', array('acf-input'), $this->settings['version']);
		wp_enqueue_script( 'acf-am-range', $dir . 'admin/js/range.js', array('acf-input-range', 'jquery-ui-slider'), $this->settings['version'], true );
		wp_enqueue_style(array('acf-input-range',));		
		wp_enqueue_style('acf-am-jquery-ui',  $dir . 'admin/css/range-slider-addon.css',array(),$this->settings['version']);
	}

	function format_value_for_api($value, $post_id, $field)
	{
		// format value
		if ( empty($value) ) {
			
			if ( empty($field['default_value_1']) ) {
				$default_value_1 = 0;
			} else {
				$default_value_1 = $field['default_value_1'];
			}

			if ( empty($field['default_value_2']) ) {
				$default_value_2 = 0;
			} else {
				$default_value_2 = $field['default_value_2'];
			}

			if ( $field['slider_type'] == 'range' ) {
				$value = $default_value_1.';'.$default_value_2;
			} else {
				$value = $default_value_1;
			}
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

	    // return value
		return $value_ar;
	}

}


// create field
new gwlrs_range_slider();

?>