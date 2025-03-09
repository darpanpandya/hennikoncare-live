<?php
namespace BearsthemesAddons\Widgets\Give_Totals\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Taboche extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-give-totals/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
  	add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_total_box_controls' ] );
		add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_total_section_controls' ] );
		add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_form_section_controls' ] );

	}

	public function get_id() {
		return 'skin-taboche';
	}


	public function get_title() {
		return __( 'Taboche', 'bearsthemes-addons' );
	}


	public function register_layout_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->parent->start_injection( [
			'at' => 'before',
			'of' => 'total_goal',
		] );

    $this->add_control(
			'header_sub_title',
			[
				'label' => __( 'Sub Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'We\'re Near to Our', 'bearsthemes-addons' ),
			]
		);
		$this->add_control(
			'header_title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Campaign', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'header_desc',
			[
				'label' => __( 'Description', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Raising money for clean water is twice as easy.', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'time_remain',
			[
				'label' => __( 'Time Remain', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '397Days Left', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'donatees',
			[
				'label' => __( 'Donatees', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
			]
		);

		$this->parent->end_injection();

	}


  public function register_design_give_total_box_controls( Widget_Base $widget ) {
		$this->parent = $widget;

    $this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'box_background',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-give-totals' => 'background-color: {{VALUE}};',
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
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-give-totals' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
  }
	public function register_design_give_total_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_give_totals',
			[
				'label' => __( 'Give Total', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'heading_header_sub_title_style',
			[
				'label' => __( 'Sub Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'header_sub_title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-header__sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_sub_title_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-gt-header__sub-title',
			]
		);

		$this->add_control(
			'heading_header_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'header_title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-header__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_title_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-gt-header__title',
			]
		);

		$this->add_control(
			'heading_header_desc_style',
			[
				'label' => __( 'Description', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'header_desc_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-header__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_desc_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-gt-header__desc',
			]
		);

		$this->add_control(
			'heading_goal_progress_style',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'goal_progress_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .goal-progress .income,
					 {{WRAPPER}} .goal-progress .goal-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .goal-progress .income,
				 							 {{WRAPPER}} .goal-progress .goal-text',
			]
		);

		$this->add_control(
			'goal_progress_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .goal-progress' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .goal-progress',
			]
		);

		$this->add_control(
			'heading_goal_remain_style',
			[
				'label' => __( 'Goal Remain', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'goal_remain_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gt-remain .item-remain .gt-remain__remain-value,
					 {{WRAPPER}} .gt-remain .item-donate .gt-remain__donate-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_remain_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .gt-remain .item-remain .gt-remain__remain-value,
											 {{WRAPPER}} .gt-remain .item-donate .gt-remain__donate-value',
			]
		);

		$this->add_control(
			'goal_remain_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gt-remain .item-remain .gt-remain__remain-title,
					 {{WRAPPER}} .gt-remain .item-donate .gt-remain__donate-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_remain_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .gt-remain .item-remain .gt-remain__remain-title,
											 {{WRAPPER}} .gt-remain .item-donate .gt-remain__donate-title',
			]
		);

		$this->end_controls_section();
	}

	public function register_design_give_form_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_give_form',
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
					'.give-form[data-style="elementor-give-totals--taboche"] .give-total-wrap #give-amount,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-donation-level-button-wrap .give-btn:not(.give-default-level):hover,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-gateway-radio-list > li label:hover,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					 .give-form[data-style="elementor-give-totals--taboche"] #give_terms_agreement label:hover,
					 .give-form[data-style="elementor-give-totals--taboche"] #give_terms_agreement input[type=checkbox]:checked + label,
					 .give-form[data-style="elementor-give-totals--taboche"] .give_terms_links:hover,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',
					'.give-form[data-style="elementor-give-totals--taboche"] .give-total-wrap .give-currency-symbol,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-donation-level-button-wrap .give-btn.give-default-level,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-gateway-radio-list > li.give-gateway-option-selected label:after,
					 .give-form[data-style="elementor-give-totals--taboche"] #give_terms_agreement input[type=checkbox]:checked + label:before,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-final-total-wrap .give-donation-total-label,
					 .give-form[data-style="elementor-give-totals--taboche"] .give-submit' => 'background-color: {{VALUE}};',
					'.give-form[data-style="elementor-give-totals--taboche"] #give-donation-level-button-wrap .give-btn:hover,
					 .give-form[data-style="elementor-give-totals--taboche"] #give-donation-level-button-wrap .give-btn.give-default-level,
					 .give-form[data-style="elementor-give-totals--taboche"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-gt-form .give-btn-modal:hover,
					 .give-form[data-style="elementor-give-totals--taboche"] .give-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-gt-form .give-btn-modal,
											 .give-form[data-style="elementor-give-totals--taboche"]',
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$total_earnings = get_option( 'give_earnings_total', false );
		if( '' !== $settings['custom_total_earnings'] ) {
			$total_earnings = $settings['total_earnings'];
		}

		$args = array(
			'total_earnings' => $total_earnings, // integer.
			'total_goal'   => $settings['total_goal'], // integer.
			'ids'          => $settings['ids'], // integer|array.
			'cats'         => $settings['category'], // integer|array.
			'tags'         => 0, // integer|array.
			'message'      => '', // apply_filters( 'give_totals_message', __( 'Hey! We\'ve raised {total} of the {total_goal} we are trying to raise for this campaign!', 'bearsthemes-addons' ) ),
			'link'         => '', // URL.
			'link_text'    => __( 'Donate Now', 'bearsthemes-addons' ), // string,
			'progress_bar' => true, // boolean.
			'show_text' => true, // boolean.
			'show_bar' => true, // boolean.
			'income_text' => __( 'Raised:', 'bearsthemes-addons' ),
			'goal_text' => __( 'Goal:', 'bearsthemes-addons' ),
			'custom_goal_progress' => $settings['custom_goal_progress'],
		);

		$bar_opts = array(
			'type' => 'circle',
			'strokewidth' => 9,
			'easing' => $settings['goal_progress_easing'],
			'duration' => absint( $settings['goal_progress_duration']['size'] ),
			'color' => $settings['goal_progress_color_from'],
			'trailcolor' => $settings['goal_progress_trailcolor'],
			'trailwidth' => 8,
			'tocolor' => $settings['goal_progress_color_to'],
		);

		$this->parent->render_loop_header();

		?>

			<div class="elementor-gt-header">
				<?php
          if( $this->parent->get_instance_value_skin('header_sub_title') ) {
            echo '<h3 class="elementor-gt-header__sub-title">' . $this->parent->get_instance_value_skin('header_sub_title') . '</h3>';
          }

					if( $this->parent->get_instance_value_skin('header_title') ) {
						echo '<h2 class="elementor-gt-header__title">' . $this->parent->get_instance_value_skin('header_title') . '</h2>';
					}

					if( $this->parent->get_instance_value_skin('header_desc') ) {
						echo '<div class="elementor-gt-header__desc">' . $this->parent->get_instance_value_skin('header_desc') . '</div>';
					}

				?>
			</div>
			<div class="goal-progress">
				<?php echo bearsthemes_addons_give_totals_circle ( $args, $bar_opts ); ?>
				<div class="gt-remain">
					<?php
					if( $this->parent->get_instance_value_skin('time_remain') ) {
						echo '<div class="item-remain">';
						echo '<h4 class="gt-remain__remain-title">' . esc_html__('Time Remain:', 'bearsthemes-addons') . '</h4>';
						echo '<span class="gt-remain__remain-value">' . $this->parent->get_instance_value_skin('time_remain') . '</span>';
						echo '</div>';
					} ?>
					<?php
					if( $this->parent->get_instance_value_skin('donatees') ) {
						echo '<div class="item-donate">';
						echo '<h4 class="gt-remain__donate-title">' . esc_html__('Donatees:', 'bearsthemes-addons') . '</h4>';
						echo '<span class="gt-remain__donate-value">' . $this->parent->get_instance_value_skin('donatees') . '</span>';
						echo '</div>';
					} ?>
				</div>
			</div>
			<div class="elementor-gt-form">

				<?php
					if( !empty( $settings['form_id'] ) ) {
						// Maybe display the form donate button.
						$atts = array(
							'id' => $settings['form_id'],  // integer.
							'show_title' => false, // boolean.
							'show_goal' => false, // boolean.
							'show_content' => 'none', //above, below, or none
							'display_style' => 'button', //modal, button, and reveal
							'continue_button_title' => '' //string

						);

						add_filter('give_form_html_tags', function($form_html_tags, $form) {
							$form_html_tags['data-style'] = 'elementor-give-totals--taboche';

							return $form_html_tags;
						}, 10, 2);

						echo give_get_donation_form( $atts );
					}
				?>

			</div>

		<?php

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
