<?php
namespace BearsthemesAddons\Widgets\Give_Forms_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_List_Saltoro extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-give-forms-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-give-forms-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-give-forms-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-give-forms-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );
		add_action( 'elementor/element/be-give-forms-carousel/section_design_layout/after_section_end', [ $this, 'register_design_give_form_section_controls' ] );
	}

	public function get_id() {
		return 'skin-list-saltoro';
	}


	public function get_title() {
		return __( 'List Saltoro', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts Count', 'bearsthemes-addons' ),
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
        'default' => 'large',
        'exclude' => [ 'custom' ],
				'condition' => [
					'skin_list_saltoro_show_thumbnail!'=> '',
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
					'skin_list_saltoro_show_thumbnail!'=> '',
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
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'saltoro_excerpt_length', 15 ),
				'condition' => [
					'skin_list_saltoro_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'saltoro_excerpt_more', '' ),
				'condition' => [
					'skin_list_saltoro_show_excerpt!' => '',
				],
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

		$this->add_control(
			'donation_button_label',
			[
				'label' => __( 'Donation button Label', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Donate Now', 'bearsthemes-addons' ),
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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

  public function register_design_image_section_controls(Widget_Base $widget) {
    $this->parent = $widget;

    $this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_list_saltoro_show_thumbnail!' => '',
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
					'skin_list_saltoro_show_title!' => '',
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
					'skin_list_saltoro_show_title!' => '',
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
					'skin_list_saltoro_show_title!' => '',
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
					'skin_list_saltoro_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_saltoro_show_category!' => '',
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
					'skin_list_saltoro_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-card__category,
           {{WRAPPER}} .elementor-give-form .give-card__category:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_saltoro_show_category!' => '',
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
					'skin_list_saltoro_show_category!' => '',
				],
			]
		);

    $this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_saltoro_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-give-form .give-card__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_saltoro_show_excerpt!' => '',
				],
			]
		);

    	$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-give-form .give-card__excerpt',
				'condition' => [
					'skin_list_saltoro_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_goal_progress_style',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_saltoro_show_goal_progress!' => '',
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
					'skin_list_saltoro_show_goal_progress!' => '',
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
					'skin_list_saltoro_show_goal_progress!' => '',
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
					'skin_list_saltoro_show_goal_progress!' => '',
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
					'skin_list_saltoro_show_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'heading_donation_button_style',
			[
				'label' => __( 'Donation Button', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'donation_button_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .give-btn-modal',
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
			]
		);

		$this->add_control(
			'donation_button_width',
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
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'donation_button_radius',
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
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'donation_button_padding',
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
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'donation_button_tabs' );

		$this->start_controls_tab( 'donation_button_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
			]
		);

		$this->add_control(
			'donation_button_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'donation_button_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'donation_button_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'donation_button',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
				'condition' => [
					'skin_list_saltoro_show_donation_button!' => '',
				],
			]
		);

		$this->add_control(
			'donation_button_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .give-btn-modal:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'donation_button_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'donation_button_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-btn-modal:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'skin_list_saltoro_show_donation_button!' => '',
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
					'.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] .give-total-wrap #give-amount,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-button-wrap .give-btn:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-radio-list li input.give-default-level + label,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-radio-list li label:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give_terms_agreement input[type=checkbox]:checked + label,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] .give_terms_links:hover,
					.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] .give-total-wrap .give-currency-symbol,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-radio-list li label:after,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-gateway-radio-list > li label:after,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give_terms_agreement input[type=checkbox]:checked + label:before,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-final-total-wrap .give-donation-total-label,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] .give-submit' => 'background-color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give-donation-level-button-wrap .give-btn:hover,
				 .give-form[data-style="elementor-give-forms-carousel--list-saltoro"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
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
					'.give-form[data-style="elementor-give-forms-carousel--list-saltoro"] .give-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '.give-form[data-style="elementor-give-forms-carousel--list-saltoro"]',
			]
		);

		$this->end_controls_section();
	}

	protected function render_post() {
    $settings = $this->parent->get_settings_for_display();

		$form_id = get_the_ID(); // Form ID.

		$form_class = 'elementor-give-form';

		?>
		<div class="swiper-slide">
			<article id="post-<?php the_ID();  ?>" <?php post_class( 'elementor-give-form' ); ?> >
        <div class="give-card__header">
          <div class="give-card__media">
            <?php
              if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ){
                // Maybe display the featured image.
                printf(
                  '%s<div class="give-card__overlay"></div>',
                  get_the_post_thumbnail( $form_id, $form_id, $this->parent->get_instance_value_skin( 'thumbnail_size' ) )
                );

              }

            ?>
          </div>

          <?php
            if( '' !== $this->parent->get_instance_value_skin( 'show_category' ) ){
              the_terms( $form_id, 'give_forms_category', '<div class="give-card__category">' , ',', '</div>' );
            }
          ?>
        </div>


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

            if( '' !== $this->parent->get_instance_value_skin('show_excerpt') ) {
							?>
							<div class="give-card__excerpt">
								<?php
                  $num_words = absint( $this->parent->get_instance_value_skin('excerpt_length') );
                  $more = $this->parent->get_instance_value_skin('excerpt_more');
                  echo wp_trim_words( get_the_excerpt() , $num_words, $more );
                ?>
							</div>
							<?php
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

						if( '' !== $this->parent->get_instance_value_skin( 'show_donation_button' ) ) {
							// Maybe display the form donate button.
							$atts = array(
								'id' => $form_id,  // integer.
								'show_title' => false, // boolean.
								'show_goal' => false, // boolean.
								'show_content' => 'none', //above, below, or none
								'display_style' => 'button', //modal, button, and reveal
								'continue_button_title' => $this->parent->get_instance_value_skin( 'donation_button_label' ) //string

							);

							add_filter('give_form_html_tags', function($form_html_tags, $form) {
								$form_html_tags['data-style'] = 'elementor-give-forms-carousel--list-saltoro';

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

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
