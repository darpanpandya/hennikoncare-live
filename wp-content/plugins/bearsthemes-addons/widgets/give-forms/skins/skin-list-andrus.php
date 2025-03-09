<?php
namespace BearsthemesAddons\Widgets\Give_Forms\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_List_Andrus extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-give-forms/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
    add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_content_feature_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_give_form_section_controls' ] );
	}

	public function get_id() {
		return 'skin-list-andrus';
	}


	public function get_title() {
		return __( 'List Andrus', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
      'show_thumbnail',
      [
        'label' => __( 'Thumbnail', 'bearsthemes-addons' ),
        'type'  => Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'bearsthemes-addons' ),
        'label_off' => __( 'Hide', 'bearsthemes-addons' ),
        'default'  => 'yes',
        'separator' => 'before',
      ]
    );

    $this->add_group_control(
      Group_Control_Image_Size::get_type(),
      [
        'name' => 'thumbnail',
        'default' => 'medium',
        'exclude' => [ 'custom' ],
				'condition' => [
					'skin_list_andrus_show_thumbnail!'=> '',
				],
      ]
    );

    $this->add_control(
      'show_title',
      [
        'label' => __( 'Title', 'bearsthemes-addons'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'bearsthemes-addons'),
        'label_off' => __( 'Hide', 'bearsthemes-addons'),
        'default' => 'yes',
        'separator' => 'before',
      ]
    );

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type'  => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons'),
				'default' => 'yes',
			]
		);

		$this->add_control(
      'show_goal_progress',
      [
        'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'bearsthemes-addons'),
        'label_off' => __( 'Hide', 'bearsthemes-addons'),
        'default' => 'yes',
      ]
    );

		$this->add_control(
			'show_donation_button',
			[
				'label' => __( 'Donation Button', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'bearsthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bearsthemes-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form' => 'text-align: {{VALUE}};',
				],
			]
		);

	}

	public function register_design_image_section_controls(Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_list_andrus_show_thumbnail!' => '',
				],
			]
		);

    $this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

    $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .give-card__media img',
			]
		);

    $this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

    $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature:hover .give-card__media img,
											 {{WRAPPER}} .elementor-give-form:hover .give-card__media img',
			]
		);

    $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

  }

	public function register_design_content_feature_section_controls(Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
			'section_design_content_feature',
			[
				'label' => __( 'Content Feature', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_feature_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_control(
			'title_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-card__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_control(
			'title_feature_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-give-form-feature .give-card__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_feature_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature .give-card__title',
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_feature_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-card__category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_feature_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-card__category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_feature_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature .give-card__category',
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'heading_goal_progress_feature_style',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_feature_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-goal-progress .income,
					 {{WRAPPER}} .elementor-give-form-feature .give-goal-progress .goal-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_feature_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature .give-goal-progress .income,
				 							 {{WRAPPER}} .elementor-give-form-feature .give-goal-progress .goal-text',
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-goal-progress' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_feature_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature .give-goal-progress',
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->end_controls_section();
  }

	public function register_design_content_section_controls(Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-card__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-give-form .give-card__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-card__title',
				'condition' => [
					'skin_list_andrus_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-card__category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-card__category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-card__category',
				'condition' => [
					'skin_list_andrus_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'heading_goal_progress_style',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-goal-progress .income,
					 {{WRAPPER}} .elementor-give-form .give-goal-progress .goal-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-goal-progress .income,
				 							 {{WRAPPER}} .elementor-give-form .give-goal-progress .goal-text',
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-goal-progress' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-goal-progress',
				'condition' => [
					'skin_list_andrus_show_goal_progress!' => '',
				],
			]
		);

		$this->end_controls_section();
  }

	public function register_design_give_form_section_controls(Widget_Base $widget) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_give_form',
			[
				'label' => __( 'Give Form', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_list_andrus_show_donation_button!' => '',
				],
			]
		);

		$this->add_control(
			'form_main_color',
			[
				'label' => __( 'Main Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-btn-modal,
					 {{WRAPPER}} .elementor-give-form .give-btn-modal' => 'background-color: {{VALUE}};',
					 '.give-form[data-style="elementor-give-form--list-andrus"] .give-total-wrap #give-amount,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-donation-level-button-wrap .give-btn:not(.give-default-level):hover,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-gateway-radio-list > li label:hover,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-gateway-radio-list > li.give-gateway-option-selected label,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give_terms_agreement label:hover,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give_terms_agreement input[type=checkbox]:checked + label,
 					 .give-form[data-style="elementor-give-form--list-andrus"] .give_terms_links:hover,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',
 					'.give-form[data-style="elementor-give-form--list-andrus"] .give-total-wrap .give-currency-symbol,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-donation-level-button-wrap .give-btn.give-default-level,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-gateway-radio-list > li.give-gateway-option-selected label:after,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give_terms_agreement input[type=checkbox]:checked + label:before,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-final-total-wrap .give-donation-total-label,
 					 .give-form[data-style="elementor-give-form--list-andrus"] .give-submit' => 'background-color: {{VALUE}};',
 					'.give-form[data-style="elementor-give-form--list-andrus"] #give-donation-level-button-wrap .give-btn:hover,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give-donation-level-button-wrap .give-btn.give-default-level,
 					 .give-form[data-style="elementor-give-form--list-andrus"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
 				],
			]
		);

		$this->add_control(
			'form_main_color_hover',
			[
				'label' => __( 'Main Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form-feature .give-btn-modal:hover,
					 {{WRAPPER}} .elementor-give-form .give-btn-modal:hover,
					 .give-form[data-style="elementor-give-form--list-andrus"] .give-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form-feature .give-btn-modal,
											 {{WRAPPER}} .elementor-give-form .give-btn-modal,
											 {{WRAPPER}} form[id*=give-form] #give-donation-level-button-wrap .give-btn,
											 .give-form[data-style="elementor-give-form--list-andrus"]',
			]
		);

		$this->end_controls_section();
	}

	protected function render_feature_post() {
		$settings = $this->parent->get_settings_for_display();

		$form_id = get_the_ID(); // Form ID.

		$form_class = 'elementor-give-form-feature';

		?>
			<div class="elementor-post-wrap">
				<article id="post-<?php the_ID();  ?>" <?php post_class( $form_class ); ?> >
					<div class="give-card__media">
						<?php
							if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ){
								// Maybe display the featured image.
								printf(
									'%s<div class="give-card__overlay"></div>',
									get_the_post_thumbnail( $form_id, 'large' )
								);

							}

						?>
					</div>

					<div class="give-card__body">
						<?php
							if( '' !== $this->parent->get_instance_value_skin( 'show_category' ) ){
								the_terms( $form_id, 'give_forms_category', '<div class="give-card__category">'. esc_html__( 'Project In: ', 'bearsthemes-addons' ) , ',', '</div>' );
							}

							if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ){
								// Maybe display the form title.
								printf(
									'<h3 class="give-card__title">
										<a href="%s">%s</a>
									</h3>',
									get_the_permalink(),
									get_the_title()
								);
							}

							if( '' !== $this->parent->get_instance_value_skin('show_goal_progress') && give_is_setting_enabled( get_post_meta( $form_id, '_give_goal_option', true ) ) ) {
								$args = array(
									'show_text' => true,
									'show_bar' => false,
									'income_text' => __( 'Raised', 'bearsthemes-addons' ),
									'goal_text' => __( 'Goal', 'bearsthemes-addons' ),
									'custom_goal_progress' => $this->parent->get_instance_value_skin('custom_goal_progress'),

								);

								$bar_opts = array(
									'type' => 'line',
									'strokewidth' => 1,
									'easing' => $this->parent->get_instance_value_skin('goal_progress_easing'),
									'duration' => !empty( $this->parent->get_instance_value_skin('goal_progress_duration')['size'] ) ? absint( $this->parent->get_instance_value_skin('goal_progress_duration')['size']) : 0,
									'color' => $this->parent->get_instance_value_skin('goal_progress_color_from'),
									'trailcolor' => $this->parent->get_instance_value_skin('goal_progress_trailcolor'),
									'trailwidth' => 1,
									'tocolor' => $this->parent->get_instance_value_skin('goal_progress_color_to'),
									'width' => '100%',
									'height' => '20px',
								);

								bearsthemes_addons_goal_progress( $form_id, $args, $bar_opts );
							}

							if( '' !== $this->parent->get_instance_value_skin( 'show_donation_button' ) ) {
								// Maybe display the form donate button.
								$atts = array(
									'id' => $form_id,  // integer.
									'show_title' => false, // boolean.
									'show_goal' => false, // boolean.
									'show_content' => 'none', //above, below, or none
									'display_style' => 'button', //modal, button, and reveal
									'continue_button_title' => '' //string

								);

								add_filter('give_form_html_tags', function($form_html_tags, $form) {
									$form_html_tags['data-style'] = 'elementor-give-form--list-andrus';

									return $form_html_tags;
								}, 10, 2);

								echo give_get_donation_form( $atts );
							}
						?>
					</div>
				</article>
			</div>
		<?php
	}

	protected function render_post() {
		$settings = $this->parent->get_settings_for_display();

		$form_id = get_the_ID(); // Form ID.

		$form_class = 'elementor-give-form';

		?>
			<div class="elementor-post-wrap">
				<article id="post-<?php the_ID();  ?>" <?php post_class( $form_class ); ?> >
					<div class="give-card__media">
						<div class="give-card__thumb">
							<?php
								if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ){
									// Maybe display the featured image.
									printf(
										'%s<div class="give-card__overlay"></div>',
										get_the_post_thumbnail( $form_id, $this->parent->get_instance_value_skin( 'thumbnail_size' ) )
									);

								}

								if( '' !== $this->parent->get_instance_value_skin( 'show_donation_button' ) ) {
									// Maybe display the form donate button.
									$atts = array(
										'id' => $form_id,  // integer.
										'show_title' => false, // boolean.
										'show_goal' => false, // boolean.
										'show_content' => 'none', //above, below, or none
										'display_style' => 'button', //modal, button, and reveal
										'continue_button_title' => '' //string

									);

									add_filter('give_form_html_tags', function($form_html_tags, $form) {
										$form_html_tags['data-style'] = 'elementor-give-form--list-andrus';

										return $form_html_tags;
									}, 10, 2);

									echo give_get_donation_form( $atts );
								}
							?>
						</div>
					</div>

					<div class="give-card__body">
						<?php
							if( '' !== $this->parent->get_instance_value_skin( 'show_category' ) ){
								the_terms( $form_id, 'give_forms_category', '<div class="give-card__category">'. esc_html__( 'Project In: ', 'bearsthemes-addons' ) , ',', '</div>' );
							}

							if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ){
								// Maybe display the form title.
								printf(
									'<h3 class="give-card__title">
										<a href="%s">%s</a>
									</h3>',
									get_the_permalink(),
									get_the_title()
								);
							}

							if( '' !== $this->parent->get_instance_value_skin('show_goal_progress') && give_is_setting_enabled( get_post_meta( $form_id, '_give_goal_option', true ) ) ) {
								$args = array(
									'show_text' => true,
									'show_bar' => false,
									'income_text' => __( 'Raised', 'bearsthemes-addons' ),
									'goal_text' => __( 'Goal', 'bearsthemes-addons' ),
									'custom_goal_progress' => $this->parent->get_instance_value_skin('custom_goal_progress'),

								);

								$bar_opts = array(
									'type' => 'line',
									'strokewidth' => 1,
									'easing' => $this->parent->get_instance_value_skin('goal_progress_easing'),
									'duration' => !empty( $this->parent->get_instance_value_skin('goal_progress_duration')['size'] ) ? absint( $this->parent->get_instance_value_skin('goal_progress_duration')['size'] ) : 0,
									'color' => $this->parent->get_instance_value_skin('goal_progress_color_from'),
									'trailcolor' => $this->parent->get_instance_value_skin('goal_progress_trailcolor'),
									'trailwidth' => 1,
									'tocolor' => $this->parent->get_instance_value_skin('goal_progress_color_to'),
									'width' => '100%',
									'height' => '20px',
								);

								bearsthemes_addons_goal_progress( $form_id, $args, $bar_opts );
							}

						?>
					</div>
				</article>
			</div>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_loop_header();

				$count = 0;
				while ( $query->have_posts() ) { $count++;
					$query->the_post();

					if( 1 == $count ) {
						$this->render_feature_post();
					} else {
						$this->render_post();
					}

				}

			$this->parent->render_loop_footer();

		} else {
		    // no posts found
		}

		$this->parent->pagination();

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
