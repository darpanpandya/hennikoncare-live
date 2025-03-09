<?php
namespace BearsthemesAddons\Widgets\Sponsors;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Sponsors extends Widget_Base {

	public function get_name() {
		return 'be-sponsors';
	}

	public function get_title() {
		return __( 'Be Sponsors', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-heart-o';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

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
			'list_title', [
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Sponsor name' , 'bearsthemes-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_age', [
				'label' => __( 'Age', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '3 Years',
			]
		);

		$repeater->add_control(
			'list_gender', [
				'label' => __( 'Gender', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Female',
			]
		);


		$repeater->add_control(
			'list_waiting', [
				'label' => __( 'Waiting', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '4 Months',
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'List of Sponsors', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #1', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #2', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #3', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #4', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #5', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
					[
						'list_image' => Utils::get_placeholder_image_src(),
						'list_title' => __( 'Sponsor name #6', 'bearsthemes-addons' ),
						'list_age' => '3 Years',
						'list_gender' => 'Female',
						'list_waiting' => '4 Months',
					],
				],
				'title_field' => '{{{ list_title }}}',
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
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_latyout_section_controls() {
		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sponsors-table,
					{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__title,
					{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__age,
					{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__gender,
					{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__waiting' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .elementor-sponsors-table' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_image_section_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_thumbnail!' => '',
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
					'{{WRAPPER}} .elementor-sponsor__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-sponsor__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-sponsor__thumbnail:hover .elementor-post__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_design_header_section_controls() {

    $this->start_controls_section(
			'section_design_header',
			[
				'label' => __( 'Header', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-sponsors-table .elementor-header' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sponsors-table .elementor-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sponsors-table .elementor-header,
											{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__title:before,
											{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__age:before,
											{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__gender:before,
											{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor__waiting:before',
			]
		);

    $this->end_controls_section();
  }

	protected function register_design_content_section_controls() {

    $this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sponsors-table .elementor-sponsor',
			]
		);

    $this->end_controls_section();
  }

	protected function register_controls() {

		$this->register_layout_section_controls();
		$this->register_design_latyout_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_header_section_controls();
		$this->register_design_content_section_controls();

	}

	public function render_loop_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-sponsors-table';

		?>
			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="elementor-header">
					<div class="elementor-header__title"><?php esc_html_e( 'Name', 'bearsthemes-addons' ) ?></div>
					<div class="elementor-header__age"><?php esc_html_e( 'Age', 'bearsthemes-addons' ) ?></div>
					<div class="elementor-header__gender"><?php esc_html_e( 'Gender', 'bearsthemes-addons' ) ?></div>
					<div class="elementor-header__wating"><?php esc_html_e( 'Waiting', 'bearsthemes-addons' ) ?></div>
				</div>
		<?php
	}

	public function render_loop_footer() {

		?>
			</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list'] ) ) {
			return;
		}

		$this->render_loop_header();

		foreach ( $settings['list'] as $index => $item ) {
		?>
			<div class="elementor-sponsor">
				<div class="elementor-sponsor__title">
					<?php if( '' !== $settings['show_thumbnail'] ) { ?>
						<div class="elementor-sponsor__thumbnail">
							<?php
							$attachment = wp_get_attachment_image_src( $item['list_image']['id'], 'thumbnail' );
							if( !empty( $attachment ) ) {
								echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
							} else {
								echo '<img src=" ' . esc_url( $item['list_image']['url'] ) . ' " alt="">';
							}
							 ?>
						</div>
					<?php } ?>

					<?php
						if( !empty( $item['list_title'] ) ) {
							echo '<div class="elementor-sponsor__name">' . $item['list_title'] . '</div>';
						}

					?>
				</div>
				<?php
					echo '<div class="elementor-sponsor__age">' . $item['list_age'] . '</div>';

					echo '<div class="elementor-sponsor__gender">' . $item['list_gender'] . '</div>';

					echo '<div class="elementor-sponsor__waiting">' . $item['list_waiting'] . '</div>';
				?>

			</div>

		<?php
		}

		$this->render_loop_footer();
	}

	protected function content_template() {

	}
}
