<?php
namespace BearsthemesAddons\Widgets\Video_Box\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Embed;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Baruntse extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-video-box/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-video-box/section_design_icon/after_section_end', [ $this, 'register_design_title_section_controls' ] );

	}

	public function get_id() {
		return 'skin-baruntse';
	}


	public function get_title() {
		return __( 'Baruntse', 'bearsthemes-addons' );
	}


	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Housing Assistance Because of Acts of Violence', 'bearsthemes-addons' ),
			]
		);

	}

	public function register_design_title_section_controls( Widget_Base $widget ) {
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
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-video-box__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-video-box__title',
			]
		);

		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$video_url = $settings[ $settings['video_type'] . '_url' ];

		if ( 'hosted' === $settings['video_type'] ) {
			$video_url = $this->parent->get_hosted_video_url();
		}

		if ( empty( $video_url ) ) {
			return;
		}

		if ( 'hosted' === $settings['video_type'] ) {
			ob_start();

			$this->parent->render_hosted_video();

			$video_html = ob_get_clean();
		} else {
			$embed_params = $this->parent->get_embed_params();

			$embed_options = $this->parent->get_embed_options();

			$is_static_render_mode = Plugin::$instance->frontend->is_static_render_mode();
			$post_id = get_queried_object_id();

			if ( $is_static_render_mode ) {
				$video_html = Embed::get_embed_thumbnail_html( $video_url, $post_id );
			} else {
				$video_html = Embed::get_embed_html( $video_url, $embed_params, $embed_options );
			}
		}

		if ( empty( $video_html ) ) {
			echo esc_url( $video_url );

			return;
		}

		$popup_id = 'elementor-video-popup-' . $this->get_id();

		$this->parent->render_element_header();

			if( '' !== $settings['image']['url'] ) {
				echo '<img class="thumb" src="' . esc_url( $settings['image']['url'] ) . '" alt=""/>';
			}

			?>

		<div class="elementor-video-box__overlay"></div>

		<div class="elementor-video-box__content">
			<a href="<?php echo esc_attr( '#'.$popup_id ); ?>" class="elementor-open-popup-link">
				<div class="elementor-video-box__icon">
					<?php echo $this->parent->render_icon(); ?>
				</div>
			</a>
			<?php
				if( $this->parent->get_instance_value_skin( 'title' ) ) {
					echo '<h2 class="elementor-video-box__title">' . $this->parent->get_instance_value_skin( 'title' ) . '</h2>';
				}
			?>
		</div>

		<div id="<?php echo esc_attr( $popup_id ); ?>" class="elementor-popup__white-popup mfp-hide">
			<div class="elementor-popup__video <?php echo 'elementor-popup__aspect-ratio-'.$settings['aspect_ratio'] ?>">
			  <?php echo $video_html; ?>
			</div>
		</div>
		<?php

		$this->parent->render_element_footer();

	}

	protected function content_template() {

	}

}
