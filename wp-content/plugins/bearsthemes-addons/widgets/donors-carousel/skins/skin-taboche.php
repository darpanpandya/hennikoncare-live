<?php
namespace BearsthemesAddons\Widgets\Donors_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Taboche extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-donors-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-donors-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-donors-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-donors-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-taboche';
	}


	public function get_title() {
		return __( 'Taboche', 'bearsthemes-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$repeater = new Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is donor name' , 'bearsthemes-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_price', [
				'label' => __( 'Price', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '$1,200',
				'label_block' => true,
			]
		);

    $repeater->add_control(
			'list_image', [
				'label' => __( 'Author Avatar', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $repeater->add_control(
      'list_name', [
        'label' => __( 'Author Name', 'bearsthemes-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'This is donor name' , 'bearsthemes-addons' ),
        'label_block' => true,
      ]
    );

		$repeater->add_control(
			'list_url', [
				'label' => __( 'Custom Link', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#',
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Slides', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'South African Primary School Build Children', 'bearsthemes-addons' ),
						'list_price' => '$1,200',
            'list_image' => Utils::get_placeholder_image_src(),
            'list_name' => __( 'MR. ALADIN', 'bearsthemes-addons' ),
						'list_url' => '#',
					],
					[
						'list_title' => __( 'Brilliant After All A New Album by Rebecca', 'bearsthemes-addons' ),
						'list_price' => '$1,200',
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'AMANDA SEYFRIED', 'bearsthemes-addons' ),
						'list_url' => '#',
					],
					[
						'list_title' => __( 'Provide Pure Water And Fresh Food For Syrian', 'bearsthemes-addons' ),
						'list_price' => '$1,200',
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'ZUMMON KHAN', 'bearsthemes-addons' ),
						'list_url' => '#',
					],
					[
						'list_title' => __( 'A New Album by Rebecca: Help poor people', 'bearsthemes-addons' ),
						'list_price' => '$1,200',
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'JAMES JACKSIN', 'bearsthemes-addons' ),
						'list_url' => '#',
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
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
				'frontend_available' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'Author Avatar', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
			'show_price',
			[
				'label' => __( 'Price', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_name',
			[
				'label' => __( 'Author Name', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
					'{{WRAPPER}} .elementor-donor' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-donor' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
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
					'{{WRAPPER}} .elementor-donor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
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
					'{{WRAPPER}} .elementor-donor__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-donor',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-donor' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-donor' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-donor:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-donor:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-donor:hover' => 'border-color: {{VALUE}}',
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
					'skin_taboche_show_thumbnail!' => '',
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
					'{{WRAPPER}} .elementor-donor__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-donor__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-donor__thumbnail:hover .elementor-post__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-donor__overlay' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'skin_taboche_show_thumbnail!' => '',
				],
			]
		);

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
					'skin_taboche_show_title!' => '',
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
					'{{WRAPPER}} .elementor-donor__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_taboche_show_title!' => '',
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
					'{{WRAPPER}} .elementor-donor__title:hover,
					 {{WRAPPER}} .elementor-donor__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_taboche_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-donor__title',
				'condition' => [
					'skin_taboche_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_price_style',
			[
				'label' => __( 'Price', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_taboche_show_price!' => '',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-donor__price' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_taboche_show_price!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-donor__price',
				'condition' => [
					'skin_taboche_show_price!' => '',
				],
			]
		);

		$this->add_control(
			'heading_name_style',
			[
				'label' => __( 'Author Name', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_taboche_show_name!' => '',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-donor__author' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_taboche_show_name!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-donor__author',
				'condition' => [
					'skin_taboche_show_name!' => '',
				],
			]
		);

    $this->end_controls_section();
  }

	public function render() {
		$settings = $this->parent->get_settings();

		if ( empty( $this->parent->get_instance_value_skin( 'list' ) ) ) {
			return;
		}

		$this->parent->render_loop_header();

		foreach ( $this->parent->get_instance_value_skin( 'list' ) as $index => $item ) {
		?>
			<div class="swiper-slide">
				<div class="elementor-donor">
					<div class="elementor-donor__content">
						<?php
							if( !empty( $item['list_title'] ) && '' !== $this->parent->get_instance_value_skin('show_title') ) {

								if( !empty( $item['list_url'] ) ) {
									echo '<h3 class="elementor-donor__title"><a href="' . esc_url( $item['list_url'] ) . '">' . $item['list_title'] . '</a></h3>';
								} else {
									echo '<h3 class="elementor-donor__title">' . $item['list_title'] . '</h3>';
								}

							}
							if( !empty( $item['list_price'] ) && '' !== $this->parent->get_instance_value_skin('show_price') ) {
								echo '<div class="elementor-donor__price"><span>' . esc_html__( 'Goal: ', 'bearsthemes-addons' ) . '</span> ' . $item['list_price'] . '</div>';
							}
						?>
						<div class="elementor-donor__info">
							<?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
								<div class="elementor-donor__thumbnail">
									<?php
										$attachment = wp_get_attachment_image_src( $item['list_image']['id'], $this->parent->get_instance_value_skin('thumbnail_size') );
										if( !empty( $attachment ) ) {
											echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
										} else {
											echo '<img src=" ' . esc_url( $item['list_image']['url'] ) . ' " alt="">';
										}
									 ?>
								</div>
							<?php } ?>
							<?php
								if( !empty( $item['list_name'] ) && '' !== $this->parent->get_instance_value_skin('show_name') ) {
									echo '<div class="elementor-donor__author">' . $item['list_name'] . '</div>';
								}
							?>
						</div>
					</div>
				</div>
			</div>

		<?php
		}

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
