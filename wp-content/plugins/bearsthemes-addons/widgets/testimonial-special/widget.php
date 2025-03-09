<?php
namespace BearsthemesAddons\Widgets\Testimonial_Special;

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

class Be_Testimonial_Special extends Widget_Base {

	public function get_name() {
		return 'be-testimonial-special';
	}

	public function get_title() {
		return __( 'Be Testimonial Special', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-comments';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
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
				'label' => __( 'Image', 'bearsthemes-addons' ),
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

    $repeater->add_control(
			'list_quote_title', [
				'label' => __( 'Quote Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Jasmine\'s Journey to Confidence' , 'bearsthemes-addons' ),
			]
		);

		$repeater->add_control(
			'list_quote_content', [
				'label' => __( 'Quote Content', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Meet Jasmine, a young girl whose life took a remarkable turn when she joined our "Play for a Cause Football League." Struggling with self-confidence, Jasmine found solace and purpose on the football field. Through the guidance of our coaches and the camaraderie of her teammates, Jasmine blossomed into a confident team player and emerged as a leader both on and off the pitch. Her journey exemplifies how sports can empower young minds and nurture qualities that extend far beyond the game.' , 'bearsthemes-addons' ),
			]
		);

    $repeater->add_control(
			'list_quote_image', [
				'label' => __( 'Quote Image', 'bearsthemes-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Slides', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
        'item_actions' => [
    			'add'       => false,
    			'duplicate' => false,
    			'remove'    => false,
    			'sort'      => true,
    		],
				'default' => [
					[
            'list_image' => Utils::get_placeholder_image_src(),
            'list_name' => __( 'Jasmine Cohen', 'bearsthemes-addons' ),
            'list_job' => 'Primary Teacher',
            'list_quote_title' => __( 'Jasmine\'s Journey to Confidence', 'bearsthemes-addons' ),
						'list_quote_content' => __( 'Meet Jasmine, a young girl whose life took a remarkable turn when she joined our "Play for a Cause Football League." Struggling with self-confidence, Jasmine found solace and purpose on the football field. Through the guidance of our coaches and the camaraderie of her teammates, Jasmine blossomed into a confident team player and emerged as a leader both on and off the pitch. Her journey exemplifies how sports can empower young minds and nurture qualities that extend far beyond the game.', 'bearsthemes-addons' ),
            'list_quote_image' => Utils::get_placeholder_image_src(),
					],
          [
            'list_image' => Utils::get_placeholder_image_src(),
            'list_name' => __( 'Brooklyn Simmons', 'bearsthemes-addons' ),
            'list_job' => 'Medical Assistant',
            'list_quote_title' => __( 'From Struggles to Strides', 'bearsthemes-addons' ),
						'list_quote_content' => __( 'Simmons\'s life was marked by adversity and challenges, but his determination remained unshaken. His participation in the "Running Miles of Hope" event became a turning point. Through months of training and preparation, Simmons not only conquered the physical challenge but also found a renewed sense of purpose. His story reflects the resilience of the human spirit and how the support of a community can propel an individual towards achieving the seemingly impossible.', 'bearsthemes-addons' ),
            'list_quote_image' => Utils::get_placeholder_image_src(),
					],
          [
            'list_image' => Utils::get_placeholder_image_src(),
            'list_name' => __( 'Maria Alexander', 'bearsthemes-addons' ),
            'list_job' => 'Nursing Assistant',
            'list_quote_title' => __( 'Swinging for Dreams: Maria\'s Triumph', 'bearsthemes-addons' ),
						'list_quote_content' => __( 'Maria\'s dream of pursuing golf seemed distant due to financial constraints. However, her talent caught our attention during the "Swing for Dreams Golf Tournament." Through the support of event sponsors and our organization, Maria was granted a scholarship that opened doors to professional training and competitions. Today, Maria stands as a beacon of determination, demonstrating how sports can unlock opportunities and empower dreams.', 'bearsthemes-addons' ),
            'list_quote_image' => Utils::get_placeholder_image_src(),
					],
				],
				'title_field' => '{{{ list_name }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_tab_section_controls() {
		$this->start_controls_section(
			'section_design_tab',
			[
				'label' => __( 'Tab', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__tab-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_name_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__tab-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_name_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-test-special__tab-name',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_panel_section_controls() {

    $this->start_controls_section(
			'section_design_panel',
			[
				'label' => __( 'Panel', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'panel_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__panel-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'heading_Content_style',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__panel-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-test-special__panel-title',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__panel-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-test-special__panel-desc',
			]
		);

		$this->add_control(
			'heading_info_style',
			[
				'label' => __( 'Information', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Name Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__info-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Name Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-test-special__info-name',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Job Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__info-job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'label' => __( 'Job Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-test-special__info-job',
			]
		);

		$this->add_control(
			'info_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-test-special__panel-info' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_section();
  }

	protected function register_controls() {

		$this->register_layout_section_controls();

		$this->register_design_tab_section_controls();
		$this->register_design_panel_section_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list'] ) ) {
			return;
		}
		?>
		<div class="elementor-test-special">
			<div class="elementor-test-special__tab">
				<?php foreach ( $settings['list'] as $index => $item ) { ?>
		      <div class="elementor-test-special__tab-item <?php if($index == 0) echo 'active'; ?>" data-index="<?php echo esc_attr($index); ?>">
		        <div class="elementor-test-special__tab-thumb">
							<?php
								$attachment = wp_get_attachment_image_src( $item['list_image']['id'], 'full' );
								if( !empty( $attachment ) ) {
									echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
								} else {
									echo '<img src=" ' . esc_url( $item['list_image']['url'] ) . ' " alt="">';
								}
							?>
						</div>
						<?php
							if( '' !== $item['list_name'] ) {
								echo '<h3 class="elementor-test-special__tab-name">' . $item['list_name'] . '<svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
											  <path d="M7 21.5L21 7.5" stroke="#0A0A0A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											  <path d="M9.625 7.5H21V18.875" stroke="#0A0A0A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg></h3>';
							}
						?>
		      </div>
				<?php } ?>
			</div>

			<div class="elementor-test-special__panel">
				<?php foreach ( $settings['list'] as $index => $item ) { ?>
		      <div class="elementor-test-special__panel-item <?php if($index == 0) echo 'active'; ?>" data-index="<?php echo esc_attr($index); ?>">
						<div class="elementor-test-special__panel-inner">
							<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M22.4038 32.2634C20.6797 31.767 18.9557 31.5152 17.2786 31.5152C14.6888 31.5152 12.5279 32.107 10.8523 32.8317C12.4677 26.9179 16.3483 16.7138 24.0787 15.5647C24.4292 15.5125 24.7571 15.36 25.0229 15.1256C25.2887 14.8912 25.481 14.585 25.5766 14.2437L27.2661 8.20069C27.3367 7.94823 27.3524 7.68358 27.3122 7.42455C27.2719 7.16551 27.1766 6.9181 27.0328 6.69897C26.8889 6.47983 26.6998 6.29405 26.4781 6.15412C26.2564 6.01419 26.0074 5.92336 25.7476 5.88775C25.1748 5.80969 24.5973 5.77044 24.0192 5.77026C14.7402 5.77026 5.55086 15.4553 1.67319 29.3227C-0.603041 37.4583 -1.27049 49.6898 4.33638 57.3886C7.47391 61.6965 12.0513 63.997 17.9416 64.2268L18.0136 64.2283C25.2814 64.2283 31.7261 59.3337 33.6866 52.3265C34.2683 50.2679 34.436 48.1144 34.1799 45.9905C33.9238 43.8667 33.249 41.8147 32.1945 39.9534C30.0835 36.205 26.6067 33.4727 22.4038 32.2634ZM67.8983 39.9541C65.7873 36.205 62.3105 33.4727 58.1076 32.2634C56.3835 31.767 54.6595 31.5152 52.9831 31.5152C50.7732 31.5085 48.5854 31.9567 46.5561 32.8317C48.1715 26.9179 52.0521 16.7138 59.7832 15.5647C60.1336 15.5123 60.4615 15.3598 60.7272 15.1254C60.993 14.8911 61.1853 14.5849 61.2811 14.2437L62.9706 8.20069C63.0412 7.94823 63.0569 7.68358 63.0167 7.42455C62.9764 7.16551 62.8812 6.9181 62.7373 6.69897C62.5934 6.47983 62.4043 6.29405 62.1826 6.15412C61.961 6.01419 61.7119 5.92336 61.4522 5.88775C60.8793 5.80965 60.3019 5.7704 59.7237 5.77026C50.4448 5.77026 41.2554 15.4553 37.377 29.3227C35.1015 37.4583 34.434 49.6898 40.0416 57.3901C43.1784 61.6973 47.7566 63.9985 53.6462 64.2276L53.7189 64.229C60.9859 64.229 67.4313 59.3344 69.3918 52.3273C69.9728 50.2685 70.14 48.115 69.8836 45.9912C69.6273 43.8674 68.9525 41.8155 67.8983 39.9541Z" fill="#3E8959"/>
							</svg>
							<div class="elementor-test-special__panel-content">
								<?php
									if( '' !== $item['list_quote_title'] ) {
										echo '<h3 class="elementor-test-special__panel-title">' . $item['list_quote_title'] . '</h3>';
									}
									if( '' !== $item['list_quote_content'] ) {
										echo '<div class="elementor-test-special__panel-desc">' . $item['list_quote_content'] . '</div>';
									}
								?>
							</div>
							<div class="elementor-test-special__panel-persion">
								<div class="elementor-test-special__panel-image">
									<?php
										$attachment = wp_get_attachment_image_src( $item['list_quote_image']['id'], 'full' );
										if( !empty( $attachment ) ) {
											echo '<img src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
										} else {
											echo '<img src=" ' . esc_url( $item['list_quote_image']['url'] ) . ' " alt="">';
										}
									?>
								</div>
								<div class="elementor-test-special__panel-info">
									<?php
										if( '' !== $item['list_name'] ) {
											echo '<h3 class="elementor-test-special__info-name">' . $item['list_name'] . '</h3>';
										}
										if( '' !== $item['list_job'] ) {
											echo '<div class="elementor-test-special__info-job">' . $item['list_job'] . '</div>';
										}
									?>
								</div>
							</div>
						</div>
		      </div>
				<?php } ?>

				<div class="elementor-test-special__nav">
					<a href="#" class="elementor-test-special__nav-btn elementor-test-special__nav-prev">
						<svg width="27" height="15" viewBox="0 0 27 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						  <path d="M26 7.5L1.4902 7.5" stroke="#4A4A4A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						  <path d="M7.61768 1L1.00003 7.5L7.61768 14" stroke="#4A4A4A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
					<a href="#" class="elementor-test-special__nav-btn elementor-test-special__nav-next">
						<svg width="27" height="15" viewBox="0 0 27 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						  <path d="M1 7.5L25.5098 7.5" stroke="#0A0A0A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						  <path d="M19.3823 1L26 7.5L19.3823 14" stroke="#0A0A0A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>
				</div>
			</div>
		</div>


		<?php

	}

	protected function content_template() {

	}

}
