<?php
namespace BearsthemesAddons\Widgets\Give_Form_Button;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Give_Form_Button extends Widget_Base {

	public function get_name() {
		return 'be-give-form-button';
	}

	public function get_title() {
		return __( 'Be Give Form Button', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
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
      'form_button_text',
      [
        'label' => __( 'Button Text', 'bearsthemes-addons' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Donate Now', 'bearsthemes-addons' ),
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
					'{{WRAPPER}} .give-form-wrap .give-btn-modal' => 'text-align: {{VALUE}};',
				],
			]
		);

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'give_btn_typography',
        'default' => '',
        'selector' => '{{WRAPPER}} .give-form-wrap .give-btn-modal',
      ]
    );

    $this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

    $this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give-form-wrap .give-btn-modal' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'bearsthemes-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .give-form-wrap .give-btn-modal',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'global' => [
							'type' => Controls_Manager::COLOR,
						],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .give-form-wrap .give-btn-modal:hover, {{WRAPPER}} .give-form-wrap .give-btn-modal:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .give-form-wrap .give-btn-modal:hover svg, {{WRAPPER}} .give-form-wrap .give-btn-modal:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => __( 'Background', 'bearsthemes-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .give-form-wrap .give-btn-modal:hover, {{WRAPPER}} .give-form-wrap .give-btn-modal:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .give-form-wrap .give-btn-modal:hover, {{WRAPPER}} .give-form-wrap .give-btn-modal:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .give-form-wrap .give-btn-modal',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .give-form-wrap .give-btn-modal' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .give-form-wrap .give-btn-modal',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .give-form-wrap .give-btn-modal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    $this->add_responsive_control(
      'text_margin',
      [
        'label' => __( 'Margin', 'bearsthemes-addons' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', 'em', '%' ],
        'selectors' => [
          '{{WRAPPER}} .give-form-wrap .give-btn-modal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );


		$this->end_controls_section();
	}

	protected function register_design_form_section_controls() {
		$this->start_controls_section(
			'section_design_form',
			[
				'label' => __( 'Give Form', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_main_color',
			[
				'label' => __( 'Main Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.give-form[data-style="elementor-give-form-button"] .give-total-wrap #give-amount,
					 .give-form[data-style="elementor-give-form-button"] #give-donation-level-button-wrap .give-btn:not(.give-default-level):hover,
					 .give-form[data-style="elementor-give-form-button"] #give-gateway-radio-list > li label:hover,
					 .give-form[data-style="elementor-give-form-button"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					 .give-form[data-style="elementor-give-form-button"] #give_terms_agreement label:hover,
					 .give-form[data-style="elementor-give-form-button"] #give_terms_agreement input[type=checkbox]:checked + label,
					 .give-form[data-style="elementor-give-form-button"] .give_terms_links:hover,
					 .give-form[data-style="elementor-give-form-button"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',
					'.give-form[data-style="elementor-give-form-button"] .give-total-wrap .give-currency-symbol,
					 .give-form[data-style="elementor-give-form-button"] #give-donation-level-button-wrap .give-btn.give-default-level,
					 .give-form[data-style="elementor-give-form-button"] #give-gateway-radio-list > li.give-gateway-option-selected label:after,
					 .give-form[data-style="elementor-give-form-button"] #give_terms_agreement input[type=checkbox]:checked + label:before,
					 .give-form[data-style="elementor-give-form-button"] #give-final-total-wrap .give-donation-total-label,
					 .give-form[data-style="elementor-give-form-button"] .give-submit' => 'background-color: {{VALUE}};',
					'.give-form[data-style="elementor-give-form-button"] #give-donation-level-button-wrap .give-btn:hover,
					 .give-form[data-style="elementor-give-form-button"] #give-donation-level-button-wrap .give-btn.give-default-level,
					 .give-form[data-style="elementor-give-form-button"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'form_main_color_hover',
			[
				'label' => __( 'Main Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.give-form[data-style="elementor-give-form-button"] .give-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '.give-form[data-style="elementor-give-form-button"]',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_form_section_controls();
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

		if( !empty( $settings['form_id'] ) ) {
			// Maybe display the form donate button.
			$atts = array(
				'id' => $settings['form_id'],  // integer.
				'show_title' => false, // boolean.
				'show_goal' => false, // boolean.
				'show_content' => 'none', //above, below, or none
				'display_style' => 'button', //modal, button, and reveal
				'continue_button_title' => $settings['form_button_text'] //string

			);

			add_filter('give_form_html_tags', function($form_html_tags, $form) {
				$form_html_tags['data-style'] = 'elementor-give-form-button';

				return $form_html_tags;
			}, 10, 2);

			echo give_get_donation_form( $atts );
		}

		$this->render_loop_footer();

	}

	protected function content_template() {

	}
}
