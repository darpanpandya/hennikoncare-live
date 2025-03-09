<?php
namespace BearsthemesAddons\Widgets\Give_Form;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Give_Form extends Widget_Base {

	public function get_name() {
		return 'be-give-form';
	}

	public function get_title() {
		return __( 'Be Give Form', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Andrus( $this ) );
		$this->add_skin( new Skins\Skin_Tronador( $this ) );
		$this->add_skin( new Skins\Skin_Yutmaru( $this ) );
		$this->add_skin( new Skins\Skin_Vaccine( $this ) );
		$this->add_skin( new Skins\Skin_Jimara( $this ) );
		$this->add_skin( new Skins\Skin_Nuptse( $this ) );
		$this->add_skin( new Skins\Skin_Somoni( $this ) );

	}

	protected function get_supported_post_ids() {
		$supported_taxonomies = [];

		$args = array(
			'post_type' => 'give_forms',
			'post_status'    => 'publish',
		);

		$query = new \WP_Query( $args );
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
			$supported_taxonomies[get_the_ID()] = get_the_title();
			endwhile;
	 		wp_reset_postdata();
	 	endif;

		return $supported_taxonomies;
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __( 'Form Id', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_supported_post_ids(),
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

		$this->end_controls_section();
	}

	protected function register_design_content_section_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
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
					'.give-form[data-style="elementor-give-form--default"] .give-total-wrap #give-amount,
					.give-form[data-style="elementor-give-form--default"] #give-donation-level-button-wrap .give-btn:hover,
					.give-form[data-style="elementor-give-form--default"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					.give-form[data-style="elementor-give-form--default"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-form--default"] #give-donation-level-radio-list li input.give-default-level + label,
					.give-form[data-style="elementor-give-form--default"] #give-donation-level-radio-list li label:hover,
					.give-form[data-style="elementor-give-form--default"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-form--default"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-form--default"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-form--default"] #give_terms_agreement input[type=checkbox]:checked + label,
					.give-form[data-style="elementor-give-form--default"] .give_terms_links:hover,
					.give-form[data-style="elementor-give-form--default"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-form--default"] .give-total-wrap .give-currency-symbol,
				 .give-form[data-style="elementor-give-form--default"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-form--default"] #give-donation-level-radio-list li label:after,
				 .give-form[data-style="elementor-give-form--default"] #give-gateway-radio-list > li label:after,
				 .give-form[data-style="elementor-give-form--default"] #give_terms_agreement input[type=checkbox]:checked + label:before,
				 .give-form[data-style="elementor-give-form--default"] #give-final-total-wrap .give-donation-total-label,
				 .give-form[data-style="elementor-give-form--default"] .give-submit,
				 .give-form[data-style="elementor-give-form--default"] .give-btn-modal' => 'background-color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-form--default"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-form--default"] #give-donation-level-button-wrap .give-btn:hover,
				 .give-form[data-style="elementor-give-form--default"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
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
					'.give-form[data-style="elementor-give-form--default"] .give-submit:hover,
 				  .give-form[data-style="elementor-give-form--default"] .give-btn-modal:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '.give-form[data-style="elementor-give-form--default"]',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_content_section_controls();
	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( !empty( $settings['_skin'] ) && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

	public function render_loop_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-give-form';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-give-form--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-give-form--default';
		}

		?>
			<div class="<?php echo esc_attr( $classes ); ?>">
		<?php
	}

	public function render_loop_footer() {

		?>
			</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->render_loop_header();

		// Maybe display the form donate button.
		$atts = array(
			'id' => $settings['form_id'],  // integer.
			'show_title' => false, // boolean.
			'show_goal' => false, // boolean.
			'show_content' => 'none', //above, below, or none
			'display_style' => 'modal', //modal, button, and reveal
			'continue_button_title' => '' //string

		);

		add_filter('give_form_html_tags', function($form_html_tags, $form) {
			$form_html_tags['data-style'] = 'elementor-give-form--default';

			return $form_html_tags;
		}, 10, 2);

		echo give_get_donation_form( $atts );

		$this->render_loop_footer();

	}

	protected function content_template() {

	}
}
