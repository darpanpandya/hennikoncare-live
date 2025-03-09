<?php
namespace BearsthemesAddons\Widgets\Testimonial_Carousel\Skins;

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

class Skin_List_Cholatse extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-testimonial-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/before_section_end', [ $this, 'register_design_latyout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-list-cholatse';
	}


	public function get_title() {
		return __( 'List Cholatse', 'bearsthemes-addons' );
	}

	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$repeater = new Repeater();

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.' , 'bearsthemes-addons' ),
			]
		);

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
			'list_name', [
				'label' => __( 'Name', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Name' , 'bearsthemes-addons' ),
			]
		);

		$repeater->add_control(
			'list_job', [
				'label' => __( 'Job', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Job' , 'bearsthemes-addons' ),
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
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #1', 'bearsthemes-addons' ),
						'list_job' => 'Job #1',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #2', 'bearsthemes-addons' ),
						'list_job' => 'Job #2',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #3', 'bearsthemes-addons' ),
						'list_job' => 'Job #3',
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'exclude' => [ 'custom' ],
			]
		);

	}


	public function register_design_latyout_section_controls( Widget_Base $widget ) {
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
					'{{WRAPPER}} .elementor-testimonial' => 'text-align: {{VALUE}};',
				],
			]
		);

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
			'heading_content_style',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__content',
			]
		);

		$this->add_control(
			'heading_name_style',
			[
				'label' => __( 'Name', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__name',
			]
		);

		$this->add_control(
			'heading_job_style',
			[
				'label' => __( 'Job', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-testimonial__job',
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
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			<div class="elementor-testimonial">
				<div class="elementor-testimonial__item">
					<div class="elementor-testimonial__thumbnail">
						<?php
							$attachment = wp_get_attachment_image_src( $item['list_image']['id'], $this->parent->get_instance_value_skin( 'thumbnail_size' ) );
							if( !empty( $attachment ) ) {
								echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
							} else {
								echo '<img src=" ' . esc_url( $item['list_image']['url'] ) . ' " alt="">';
							}
						?>
					</div>
					<div class="elementor-testimonial__infor">
						<?php
							if( '' !== $item['list_content'] ) {
								echo 
		                '<div class="elementor-testimonial__content">' .
		                  $item['list_content'] .
		                '</div>';
							}

							if( '' !== $item['list_name'] ) {
								echo '<h3 class="elementor-testimonial__name">' . $item['list_name'] . '</h3>';
							}
							if( '' !== $item['list_job'] ) {
								echo '<div class="elementor-testimonial__job">' . $item['list_job'] . '</div>';
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
