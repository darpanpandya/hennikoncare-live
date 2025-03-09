<?php
namespace BearsthemesAddons\Widgets\Events\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_List_Baruntse extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-events/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
    	add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_filter_section_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-list-baruntse';
	}


	public function get_title() {
		return __( 'List Baruntse', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label' => __( 'Show Filter', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => '',
			]
		);

		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->parent->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'skin_list_baruntse_show_filter!' => '',
				],
			]
		);

    $this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Thumbnail', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_list_baruntse_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

    $this->add_control(
			'show_address',
			[
				'label' => __( 'Address', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View', 'bearsthemes-addons' ),
				'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
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
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event' => 'text-align: {{VALUE}};',
				],
			]
		);

	}

  public function register_design_box_section_controls( Widget_Base $widget ) {
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
					'{{WRAPPER}} .elementor-event' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'after',
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
				'selector' => '{{WRAPPER}} .elementor-event',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-event:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function register_design_filter_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_filter',
			[
				'label' => __( 'Filter', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-filter li a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_filter!' => '',
				],
			]
		);

		$this->add_control(
			'filter_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-filter li a.active,
					 {{WRAPPER}} .elementor-filter li a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_filter!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-filter',
				'condition' => [
					'skin_list_baruntse_show_filter!' => '',
				],
			]
		);

		$this->add_control(
			'filter_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-filter' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_filter!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

  public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_list_baruntse_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-event__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-event__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-event:hover .elementor-event__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

  public function register_design_content_section_controls( Widget_Base $widget ) {
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
					'skin_list_baruntse_show_title!' => '',
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
					'{{WRAPPER}} .elementor-event__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_title!' => '',
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
					' {{WRAPPER}} .elementor-event__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__title',
				'condition' => [
					'skin_list_baruntse_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_date_style',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_baruntse_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__date' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_date!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__date',
				'condition' => [
					'skin_list_baruntse_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

    $this->add_control(
			'cateogry_title_color',
			[
				'label' => __( 'Title Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_title_typography',
        'label' => __( 'Title Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__category-title',
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'cateogry_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'cateogry_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__category',
				'condition' => [
					'skin_list_baruntse_show_category!' => '',
				],
			]
		);

    $this->add_control(
			'heading_address_style',
			[
				'label' => __( 'Address', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_baruntse_show_address!' => '',
				],
			]
		);

    $this->add_control(
			'address_title_color',
			[
				'label' => __( 'Title Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__address-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_address!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'address_title_typography',
        'label' => __( 'Title Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__address-title',
				'condition' => [
					'skin_list_baruntse_show_address!' => '',
				],
			]
		);

		$this->add_control(
			'address_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__address' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_baruntse_show_address!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'address_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__address',
				'condition' => [
					'skin_list_baruntse_show_address!' => '',
				],
			]
		);

		$this->add_control(
			'heading_read_more_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__read-more a',
				'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_border_radius',
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
					'{{WRAPPER}} .elementor-event__read-more a' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_padding',
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
					'{{WRAPPER}} .elementor-event__read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);


    $this->start_controls_tabs( 'read_more_tabs');

		$this->start_controls_tab( 'read_more_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more a' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more a' => 'background-color: {{VALUE}}',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_tab();

		$this->start_controls_tab( 'read_more_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-event__read-more a:hover' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

		$this->add_control(
			'read_more_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more a:hover' => 'border-color: {{VALUE}}',
				],
        'condition' => [
					'skin_list_baruntse_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render_post() {
    $settings = $this->parent->get_settings_for_display();

		$post_classes = 'elementor-event elementor-item';

		$group = array();
		foreach ( get_the_terms( get_the_ID(), 'tribe_events_cat' ) as $tax ) {
			$group[] = $tax->slug;
		}

		if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) {
      $post_classes .= ' has-thumbnail';
    }

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> data-group="<?php echo implode(' ', $group); ?>">
        <?php if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) { ?>
          <div class="elementor-event__thumbnail-wrap">
            <div class="elementor-event__thumbnail">
							<a href="<?php the_permalink(); ?>">
	              <?php the_post_thumbnail( $this->parent->get_instance_value_skin( 'thumbnail_size' ) ); ?>
							</a>
						</div>
          </div>
  			<?php } ?>

  			<div class="elementor-event__content">
					<div class="elementor-event__content-column elementor-event__content-header">
	          <div class="elementor-event__content-inner">
	    				<?php
	    					if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ) {
	    						the_title( '<h3 class="elementor-event__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
	    					}

	              if( '' !== $this->parent->get_instance_value_skin( 'show_date' ) ) {
	                echo tribe_events_event_schedule_details( get_the_ID(), '<div class="elementor-event__date">', '</div>' );
	              }

	    				?>
	          </div>
					</div>

          <?php
						if( '' !== $this->parent->get_instance_value_skin( 'show_category' ) ) {
							echo get_the_term_list( get_the_ID(),
																			'tribe_events_cat',
																			'<div class="elementor-event__content-column elementor-event__category">
																				<div class="elementor-event__content-inner">
																					<h3 class="elementor-event__category-title">' . esc_html__( 'Events Category:', 'bearsthemes-addons' ) . '</h3>',
																			  ', ',
																				'</div>
																			</div>' );
						}

            $venue_id = get_post_meta( get_the_ID(), '_EventVenueID', true);
            if( $venue_id && '' !== $this->parent->get_instance_value_skin( 'show_address' ) ) {
              echo '<div class="elementor-event__content-column elementor-event__address">
											<div class="elementor-event__content-inner">
				                <h3 class="elementor-event__address-title">' . esc_html__( 'Events Location:', 'bearsthemes-addons' ) . '</h3>';
				                	$this->parent->event_addres( $venue_id );
              echo '</div></div>';
            }

						if( '' !== $this->parent->get_instance_value_skin( 'show_read_more' ) ) {
							echo '<div class="elementor-event__content-column elementor-event__read-more">
											<div class="elementor-event__content-inner">
												<a href="' . get_the_permalink() . '">' . $this->parent->get_instance_value_skin( 'read_more_text' ) . '</a>
											</div>
										</div>';
						}
          ?>
				</div>
			</article>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_filter();

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
