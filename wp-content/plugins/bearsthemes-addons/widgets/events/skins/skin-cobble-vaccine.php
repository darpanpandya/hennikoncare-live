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

class Skin_Cobble_Vaccine extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-events/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-events/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cobble-vaccine';
	}


	public function get_title() {
		return __( 'Cobble Vaccine', 'bearsthemes-addons' );
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
				'default' => 'medium_large',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_cobble_vaccine_show_thumbnail!'=> '',
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
			'show_meta',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
				'default' => apply_filters( 'excerpt_length_vaccine', 50 ),
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'excerpt_more_vaccine', '' ),
				'condition' => [
					'show_excerpt!' => '',
				],
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
				'default' => __( 'Find Tickets', 'bearsthemes-addons' ),
				'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
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
          '{{WRAPPER}} .elementor-event' => 'padding: 0 calc({{SIZE}}{{UNIT}} / 2)',
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
					'{{WRAPPER}} .elementor-event' => 'margin-bottom: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event__inner' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event__inner' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-event__inner',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__inner' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-event__inner:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__inner:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__inner:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'skin_cobble_vaccine_show_thumbnail!' => '',
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
					'skin_cobble_vaccine_show_title!' => '',
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
					'skin_cobble_vaccine_show_title!' => '',
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
					'skin_cobble_vaccine_show_title!' => '',
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
					'skin_cobble_vaccine_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_date_style',
			[
				'label' => __( 'Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
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
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

    $this->add_control(
			'date_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__date' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
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
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

    $this->add_control(
			'heading_category_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_vaccine_show_category!' => '',
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
					'skin_cobble_vaccine_show_category!' => '',
				],
			]
		);

    $this->start_controls_tabs( 'category_tabs');

		$this->start_controls_tab( 'category_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
        'condition' => [
					'skin_cobble_vaccine_show_category!' => '',
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
					'{{WRAPPER}} .elementor-event__category a' => 'color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'cateogry_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a' => 'border-color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'cateogry_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_tab();

		$this->start_controls_tab( 'category_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
        'condition' => [
					'skin_cobble_vaccine_show_category!' => '',
				],
			]
		);

    $this->add_control(
			'cateogry_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'cateogry_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'cateogry_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__category a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_tab();

		$this->end_controls_tabs();

    $this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

    $this->add_control(
			'meta_icon_color',
			[
				'label' => __( 'Icon Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__meta svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

		$this->add_control(
			'meta_text_color',
			[
				'label' => __( 'Text Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__meta' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__meta',
				'condition' => [
					'skin_cobble_vaccine_show_date!' => '',
				],
			]
		);

    $this->add_control(
			'heading_read_more_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__read-more',
				'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);

    $this->start_controls_tabs( 'read_more_tabs');

		$this->start_controls_tab( 'read_more_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
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
					'{{WRAPPER}} .elementor-event__read-more' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more' => 'background-color: {{VALUE}}',
				],
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_tab();

		$this->start_controls_tab( 'read_more_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
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
					' {{WRAPPER}} .elementor-event__read-more:hover' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);
		$this->add_control(
			'read_more_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more' => 'background-color: {{VALUE}}',
				],
        'condition' => [
					'skin_cobble_vaccine_show_read_more!' => '',
				],
			]
		);

    $this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render_post( $count ) {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-event';

    if( $count % 2 == 1 ) {
      $post_classes .= ' elementor-event--horizontal';
    } else {
      $post_classes .= ' elementor-event--vertical';
    }

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <div class="elementor-event__inner">
          <div class="elementor-event__thumbnail">
            <div class="elementor-event__overlay"></div>

            <?php if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) { ?>
							<a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( $this->parent->get_instance_value_skin( 'thumbnail_size' ) ); ?>
							</a>
            <?php } ?>
  				</div>

    			<div class="elementor-event__content">
            <?php
              if( $count % 2 == 1 ) {
                echo '<div class="elementor-event__mark">' . esc_html__('EVENTS', 'alone') . '</div>';
              }

              if( '' !== $this->parent->get_instance_value_skin( 'show_category' ) ) {
  							echo get_the_term_list( get_the_ID(), 'tribe_events_cat', '<div class="elementor-event__category">', '', '</div>' );
  						}

              if( '' !== $this->parent->get_instance_value_skin( 'show_date' ) ) {
                echo '<div class="elementor-event__date">
                        <span class="day">' . tribe_get_start_date( get_the_ID(), false, 'd' ) . '</span>
                        <span class="month">' . tribe_get_start_date( get_the_ID(), false, 'M' ) . '</span>
                      </div>';
              }

              if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ) {
                the_title( '<h3 class="elementor-event__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
              }

              if( '' !== $this->parent->get_instance_value_skin( 'show_meta' ) ) {
                echo '<ul class="elementor-event__meta">';
                  $venue_id = get_post_meta( get_the_ID(), '_EventVenueID', true);
                  echo '<li class="location">' .
                    bearsthemes_addons_get_icon_svg( 'location', 18 );
                    $this->parent->event_addres( $venue_id );
                  echo '</li>';

                  $time_format = get_option( 'time_format' );
                  echo '<li class="time">' .
                        bearsthemes_addons_get_icon_svg( 'clock', 18 ) .
                        '<span class="time">'  . tribe_get_start_date( get_the_ID(), false, $time_format ) . '</span>
                        </li>';
                echo '</ul>';
              }

              if( $count % 2 == 1 ) {
      					if( '' !== $this->parent->get_instance_value_skin('show_excerpt') ) {
									?>
	      						<div class="elementor-event__excerpt">
	      							<?php echo wp_trim_words( get_the_excerpt(), $this->parent->filter_excerpt_length(), $this->parent->filter_excerpt_more() ); ?>
	      						</div>
    							<?php
								}
              }

              if( '' !== $this->parent->get_instance_value_skin( 'show_read_more' ) ) {
                echo '<a class="elementor-event__read-more" href="' . get_the_permalink() . '">' . $this->parent->get_instance_value_skin( 'read_more_text' ) . '</a>';
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

        $count = 0;
        while ( $query->have_posts() ) {
          $query->the_post();
          $count ++;

          if( $count % 2 == 1 ) {
            echo '<div class="elementor-event-wrap">';
          }

            $this->render_post( $count );

          if( $count % 2 == 0 || $count == $query->post_count ) {
            echo '</div>';
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
