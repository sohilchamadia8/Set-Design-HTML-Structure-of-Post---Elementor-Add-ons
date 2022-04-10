<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
class Get_Post_Data_Widgets extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'post-date';
    }
  
    public function get_title() {
        return __( 'Get Post', 'get-post-add-on' );
    }
  
    public function get_icon() {
        return 'eicon-post-excerpt';
    }
  
    public function get_categories() {
        return [ 'general' ];
    }
 
    protected function register_controls() { 
        $post_type = get_post_types();
    
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'get-post-data-elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post-name',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Post', 'get-post-data-elementor-addon' ),
				'options' => $post_type,
				'default' => 'post',
			]
		);

        $this->add_control(
			'width',
			[
				'label' => esc_html__( 'Image Width', 'get-post-data-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .cgpdw-post-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'post_ui_structure',
			[
				'label' => esc_html__( 'Custom HTML', 'get-post-data-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
                'default'  => ' {post_title} ',
				'rows' => 20,
			]
		);


		$this->end_controls_section();
    }
      
    protected function render() {
      
        $settings = $this->get_settings_for_display();
      
        $post_array = array(
            'numberposts'      => 5,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => $settings['post-name'],
        );
        $postList = get_posts($post_array);
        if($postList){
            $len_of_specific_char = strlen('{post_date,'); 
            $output = '';
            foreach($postList as $post_key => $post_val){
                $ui_struc_replace =  $settings['post_ui_structure'];

                $ui_struc_replace = str_replace("{post_title}", $post_val->post_title, $ui_struc_replace);
                $ui_struc_replace = str_replace("{post_excerpt}", '<p class="cgpdw-post-img">'.$post_val->post_excerpt.'</p>', $ui_struc_replace);
                $ui_struc_replace = str_replace("{post_date}", $post_val->post_date, $ui_struc_replace);
                $ui_struc_replace = str_replace("{post_image}", '<img class="cgpdw-post-img" src="'.get_the_post_thumbnail_url($post_val->ID).'" />', $ui_struc_replace);
                $ui_struc_replace = str_replace("{post_permalink}", get_permalink($post_val->ID), $ui_struc_replace);
                

                $str_start_pos = strpos( $ui_struc_replace, '{post_date,' );
                if ( $str_start_pos ) {

                $str_comma_length = $str_start_pos + $len_of_specific_char;
                $str_end_pos = strpos($ui_struc_replace,'}',$str_comma_length);
                $date_format = substr($ui_struc_replace,$str_comma_length,($str_end_pos - $str_comma_length));               
                $ui_struc_replace = str_replace("{post_date,".$date_format."}", date_format(date_create($post_val->post_date),$date_format), $ui_struc_replace);

                }
                $output .= $ui_struc_replace;
            }
            echo $output;
        } else {
           ?>
                <p>No Post Found</p>
           <?php
        }   
    }
}