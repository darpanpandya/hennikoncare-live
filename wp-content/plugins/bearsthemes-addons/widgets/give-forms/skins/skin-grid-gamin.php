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

class Skin_Grid_Gamin extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-give-forms/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_give_form_section_controls' ] );
		add_action( 'elementor/element/be-give-forms/section_design_layout/after_section_end', [ $this, 'register_design_goal_progress_section_controls' ] );
	}

	public function get_id() {
		return 'skin-grid-gamin';
	}


	public function get_title() {
		return __( 'Grid Gamin', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'elementor-grid%s-',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
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
        'default' => 'medium_large',
        'exclude' => [ 'custom' ],
				'condition' => [
					'skin_grid_gamin_show_thumbnail!'=> '',
				],
      ]
    );

    $this->add_responsive_control(
      'item_ratio',
      [
        'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
        'type' => Controls_Manager::SLIDER,
        'default' => [
          'size' => 0.66,
        ],
        'range' => [
          'px' => [
            'min' => 0.3,
            'max' => 2,
            'step' => 0.01,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .give-card__media' => 'padding-bottom: calc( {{SIZE}} * 100% );',
        ],
				'condition' => [
					'skin_grid_gamin_show_thumbnail!'=> '',
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
      ]
    );

		$this->add_control(
      'show_excerpt',
      [
        'label' => __( 'Excerpt', 'bearsthemes-addons'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => __( 'Show', 'bearsthemes-addons'),
        'label_off' => __( 'Hide', 'bearsthemes-addons'),
        'default' => 'yes',
      ]
    );

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'gamin_excerpt_length', 20 ),
				'condition' => [
					'skin_grid_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'gamin_excerpt_more', '' ),
				'condition' => [
					'skin_grid_gamin_show_excerpt!' => '',
				],
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
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'bearsthemes-addons' ),
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
					'{{WRAPPER}}' => '--grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
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

  public function register_design_box_section_controls( Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
      'section_design_box',
      [
        'label' => __( 'Box', 'bearsthemes-addons' ),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

		$this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-give-form',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form,
					 {{WRAPPER}} .give-card__body' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .elementor-give-form:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form:hover,
					 {{WRAPPER}} .elementor-give-form:hover .give-card__body' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

  }

  public function register_design_image_section_controls(Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_grid_gamin_show_thumbnail!' => '',
				],
			]
		);

    $this->add_control(
			'thumbnail_border_radius',
      [
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .give-card__media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-give-form:hover .give-card__media img',
			]
		);

    $this->end_controls_tab();

		$this->end_controls_tabs();

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
					'skin_grid_gamin_show_title!' => '',
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
					'{{WRAPPER}} .give-card__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_gamin_show_title!' => '',
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
					' {{WRAPPER}} .give-card__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_gamin_show_title!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .give-card__title',
				'condition' => [
					'skin_grid_gamin_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give-card__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_gamin_show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .give-card__excerpt',
				'condition' => [
					'skin_grid_gamin_show_excerpt!' => '',
				],
			]
		);

    $this->add_control(
			'heading_goal_progress_style',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
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
					'{{WRAPPER}} .elementor-give-form .give-card__completed' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-card__completed',
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
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
					'{{WRAPPER}} .elementor-give-form .give-card__goal' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-card__goal',
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
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
					'skin_grid_gamin_show_donation_button!' => '',
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
					'.give-form[data-style="elementor-give-forms--gamin"] .give-total-wrap #give-amount,
					.give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-button-wrap .give-btn:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					.give-form[data-style="elementor-give-forms--gamin"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-radio-list li input.give-default-level + label,
					.give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-radio-list li label:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give_terms_agreement input[type=checkbox]:checked + label,
					.give-form[data-style="elementor-give-forms--gamin"] .give_terms_links:hover,
					.give-form[data-style="elementor-give-forms--gamin"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-forms--gamin"] .give-total-wrap .give-currency-symbol,
				 .give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-radio-list li label:after,
				 .give-form[data-style="elementor-give-forms--gamin"] #give-gateway-radio-list > li label:after,
				 .give-form[data-style="elementor-give-forms--gamin"] #give_terms_agreement input[type=checkbox]:checked + label:before,
				 .give-form[data-style="elementor-give-forms--gamin"] #give-final-total-wrap .give-donation-total-label,
				 .give-form[data-style="elementor-give-forms--gamin"] .give-submit' => 'background-color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-forms--gamin"] #give-donation-level-button-wrap .give-btn:hover,
				 .give-form[data-style="elementor-give-forms--gamin"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
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
					'.give-form[data-style="elementor-give-forms--gamin"] .give-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '.give-form[data-style="elementor-give-forms--gamin"]',
			]
		);

		$this->end_controls_section();
	}

	public function register_design_goal_progress_section_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_goal_progress',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_grid_gamin_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'custom_goal_progress',
			[
				'label' => __( 'Custom Goal Progress', 'bearsthemes-addons' ),
				'description' => __( 'Check this to custom goal progress in give forms.', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'bearsthemes-addons' ),
				'label_off' => __( 'Off', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'goal_progress_easing',
			[
				'label' => __( 'Easing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'linear' => __( 'Linear', 'bearsthemes-addons' ),
					'easeOut' => __( 'EaseOut', 'bearsthemes-addons' ),
					'bounce' => __( 'Bounce', 'bearsthemes-addons' ),
				],
				'condition' => [
					'skin_grid_gamin_custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_duration',
			[
				'label' => __( 'Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'condition' => [
					'skin_grid_gamin_custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_color_from',
			[
				'label' => __( 'from Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFEA82',
				'condition' => [
					'skin_grid_gamin_custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_color_to',
			[
				'label' => __( 'to Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ED6A5A',
				'condition' => [
					'skin_grid_gamin_custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_trailcolor',
			[
				'label' => __( 'Trail Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#EEEEEE',
				'condition' => [
					'skin_grid_gamin_custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_padding',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .give-goal-progress svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'goal_progress_background',
			[
				'label' => __( 'Background', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-goal-progress svg' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render_post() {

    $settings = $this->parent->get_settings_for_display();

		$form_id = get_the_ID(); // Form ID.

		$form_class = 'elementor-give-form';

    if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
      $form_class .= ' has-thumbnail';
    }

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $form_class ); ?> >
				<?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
  				<div class="give-card__media">
						<a href="<?php the_permalink(); ?>">
	  	        <?php
	  	          // Maybe display the featured image.
	  	          printf(
	  	            '%s<div class="give-card__overlay"></div>',
	  	            get_the_post_thumbnail( $form_id, $this->parent->get_instance_value_skin( 'thumbnail_size' ) )
	  	          );

	  	        ?>
						</a>
  				</div>
        <?php } ?>

        <?php
          if( '' !== $this->parent->get_instance_value_skin('show_goal_progress') && give_is_setting_enabled( get_post_meta( $form_id, '_give_goal_option', true ) ) ) {
            echo '<div class="give-card__progress-wrap">';
              $args = array(
                'show_text' => false,
                'show_bar' => true,
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
                'height' => '6px',
              );

              bearsthemes_addons_goal_progress( $form_id, $args, $bar_opts );

              $total_income = give_get_form_earnings_stats( $form_id );
              $goal_amount = give_get_meta( $form_id, '_give_set_goal', true );
              $goal_percentage_completed = ( $total_income < $goal_amount ) ? round( ( $total_income / $goal_amount ) * 100, 0 ) : 100;

              printf(
  	            '<div class="give-card__completed">%s</div>',
  	            $goal_percentage_completed .
                esc_html__( '%', 'bearsthemes-addons' )
  	          );

							$form_currency = apply_filters( 'give_goal_form_currency', give_get_currency( $form_id ), $form_id );

              $goal_format_args = apply_filters(
          			'give_goal_amount_format_args',
          			array(
          				'sanitize' => false,
          				'currency' => $form_currency,
          				'decimal'  => false,
          			),
          			$form_id
          		);

          		$total_income = give_get_form_earnings_stats( $form_id );
          		$goal_amount = give_get_meta( $form_id, '_give_set_goal', true );

          		$currency = give_get_currency();
          		$currency_symbol = give_currency_symbol( $currency );
          		$currency_pos = give_get_currency_position();
          		if( 'before' == $currency_pos ) {
          			$total = $currency_symbol . give_format_amount( $total_income,$goal_format_args );
          			$total_goal = $currency_symbol . give_format_amount( $goal_amount,$goal_format_args );

          		} else {
          			$total = give_format_amount( $total_income,$goal_format_args ) . $currency_symbol;
          			$total_goal = give_format_amount( $goal_amount,$goal_format_args ) . $currency_symbol;
          		}

              printf(
	              '<div class="give-card__goal">
	  							%s <span class="raised-income">%s</span> / <span class="raised-goal">%s</span>
	  						</div>',
	  						esc_html__('Raised', 'bearsthemes-addons'),
                $total,
                $total_goal
	            );

            echo '</div>';
          }
        ?>

        <div class="give-card__body">
          <?php
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

						if( '' !== $this->parent->get_instance_value_skin( 'show_excerpt' ) ){
	            $content      = give_get_meta( $form_id, '_give_form_content', true );
	          	$display_content = give_get_meta( $form_id, '_give_display_content', true );

							$excerpt_length = $this->parent->get_instance_value_skin( 'excerpt_length' );
							$excerpt_more = $this->parent->get_instance_value_skin( 'excerpt_more' );

	            if('enabled' == $display_content) {
	              echo '<div class="give-card__excerpt">' . wp_trim_words( $content, $excerpt_length, $excerpt_more ) . '</div>';
	            }
						}
          ?>

          <div class="give-card__footer">
            <div class="give-card__icon">
              <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.95369 21.5814C10.8532 21.5814 13.9071 16.9337 13.9071 11C13.9071 5.06638 10.8532 0.418701 6.95369 0.418701C3.0542 0.418701 0.000244141 5.06638 0.000244141 11C0.000244141 16.9337 3.0542 21.5814 6.95369 21.5814ZM6.95369 2.23264C9.3383 2.23264 11.4011 5.17776 11.9474 9.00566C11.5841 8.75647 11.1597 8.6112 10.72 8.58555C10.2802 8.55989 9.84184 8.65482 9.45209 8.86008C9.06234 9.06534 8.73606 9.37315 8.50844 9.75028C8.28082 10.1274 8.16053 10.5595 8.16053 11C8.16053 11.4405 8.28082 11.8727 8.50844 12.2498C8.73606 12.6269 9.06234 12.9347 9.45209 13.14C9.84184 13.3452 10.2802 13.4402 10.72 13.4145C11.1597 13.3889 11.5841 13.2436 11.9474 12.9944C11.4011 16.8223 9.3383 19.7674 6.95369 19.7674C4.16784 19.7674 1.81419 15.7526 1.81419 11C1.81419 6.2475 4.16784 2.23264 6.95369 2.23264ZM26.0001 11C26.0001 16.9337 22.9461 21.5814 19.0466 21.5814C18.1748 21.5497 17.3218 21.3192 16.5527 20.9074C15.7836 20.4956 15.1188 19.9135 14.6091 19.2055C14.957 18.59 15.2587 17.9496 15.5119 17.2896C15.8396 17.9707 16.3367 18.5562 16.9557 18.9901C17.5746 19.424 18.2946 19.6916 19.0466 19.7674C21.4312 19.7674 23.4941 16.8223 24.0403 12.9944C23.6771 13.2436 23.2527 13.3889 22.8129 13.4145C22.3732 13.4402 21.9348 13.3452 21.545 13.14C21.1553 12.9347 20.829 12.6269 20.6014 12.2498C20.3738 11.8727 20.2535 11.4405 20.2535 11C20.2535 10.5595 20.3738 10.1274 20.6014 9.75028C20.829 9.37315 21.1553 9.06534 21.545 8.86008C21.9348 8.65482 22.3732 8.55989 22.8129 8.58555C23.2527 8.6112 23.6771 8.75647 24.0403 9.00566C23.4941 5.17776 21.4312 2.23264 19.0466 2.23264C18.2946 2.30845 17.5746 2.5761 16.9557 3.00997C16.3367 3.44384 15.8396 4.02938 15.5119 4.71049C15.2587 4.05043 14.957 3.41005 14.6091 2.7946C15.1188 2.08659 15.7836 1.50445 16.5527 1.09267C17.3218 0.680892 18.1748 0.450364 19.0466 0.418701C22.9461 0.418701 26.0001 5.06638 26.0001 11Z" fill="white"/>
              </svg>
            </div>

            <?php
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
									$form_html_tags['data-style'] = 'elementor-give-forms--gamin';

									return $form_html_tags;
								}, 10, 2);

								echo give_get_donation_form( $atts );
  						}
            ?>
          </div>
        </div>
			</article>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_loop_header();

				while ( $query->have_posts() ) {
					$query->the_post();

					$this->render_post();

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
