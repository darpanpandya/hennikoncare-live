<?php
namespace BearsthemesAddons\Widgets\Base_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Grid_Pumori extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-base-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-base-carousel/section_design_layout/before_section_end', [ $this, 'register_design_latyout_section_controls' ] );
		add_action( 'elementor/element/be-base-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-base-carousel/section_design_layout/after_section_end', [ $this, 'register_design_overlay_section_controls' ] );

	}

	public function get_id() {
		return 'skin-grid-pumori';
	}


	public function get_title() {
		return __( 'Pumori', 'bearsthemes-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$repeater = new Repeater();

		$repeater->add_control(
			'list_image', [
				'label' => __( 'Thumbnail', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'list_url', [
				'label' => __( 'Url', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
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
						'list_image' => Utils::get_placeholder_image_src(),
						'list_url' => '#',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_url' => '#',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_url' => '#',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_url' => '#',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_url' => '#',
					],
				],
			]
		);

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '5',
				'tablet_default' => '4',
				'mobile_default' => '2',
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => [ 'custom' ],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);

	}


	public function register_design_latyout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 30,
				],
				'frontend_available' => true,
			]
		);
	}

	public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-slide__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-slide__thumbnail:hover .elementor-post__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function register_design_overlay_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_overlay',
			[
				'label' => __( 'Overlay', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__overlay' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_icon_size',
			[
				'label' => __( 'Icon Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__overlay svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_control(
			'overlay_icon_color',
			[
				'label' => __( 'Icon Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__overlay svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_icon_color_hover',
			[
				'label' => __( 'Icon Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-slide__overlay svg:hover' => 'fill: {{VALUE}};',
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
				<div class="elementor-slide">
					<div class="elementor-slide__thumbnail">
						<?php
							$attachment = wp_get_attachment_image_src( $item['list_image']['id'], $this->parent->get_instance_value_skin( 'thumbnail_size') );
							if( !empty( $attachment ) ) {
								echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
							} else {
								echo '<img src=" ' . esc_url( $item['list_image']['url'] ) . ' " alt="">';
							}
						?>
					</div>
					<?php
						if( !empty( $item['list_url'] ) ) {
							echo '<div class="elementor-slide__overlay">
											<a href="' . esc_url( $item['list_url'] ) . '">' . bearsthemes_addons_get_icon_svg('plus', 30) . '</a>
										</div>';
						}
					?>

				</div>
			</div>

		<?php
		}

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
