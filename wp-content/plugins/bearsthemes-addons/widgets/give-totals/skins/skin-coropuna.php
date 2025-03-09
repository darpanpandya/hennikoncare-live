<?php
namespace BearsthemesAddons\Widgets\Give_Totals\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Coropuna extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-give-totals/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
    add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_total_box_controls' ] );
		add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_total_section_controls' ] );
		add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_form_section_controls' ] );
    add_action( 'elementor/element/be-give-totals/section_design_layout/after_section_end', [ $this, 'register_design_give_socials_section_controls' ] );

	}

	public function get_id() {
		return 'skin-coropuna';
	}


	public function get_title() {
		return __( 'Coropuna', 'bearsthemes-addons' );
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
				'default' => __( 'The long journey to end poverty begins with a child.', 'bearsthemes-addons' ),
			]
		);

		$this->parent->end_injection();

		$this->parent->start_injection( [
			'at' => 'after',
			'of' => 'form_id',
		] );

		$this->add_control(
			'socials_title',
			[
				'label' => __( 'Socials Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Share Us At:', 'bearsthemes-addons' ),
			]
		);

    $this->add_control(
			'socials_list',
			[
				'label' => __( 'Socials List', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'facebook'  => __( 'Facebook', 'bearsthemes-addons' ),
					'twitter' => __( 'Twitter', 'bearsthemes-addons' ),
          'pinterest' => __( 'Pinterest', 'bearsthemes-addons' ),
          'linkedin' => __( 'Linkedin', 'bearsthemes-addons' ),
          'google' => __( 'Google', 'bearsthemes-addons' ),
          'mail' => __( 'Mail', 'bearsthemes-addons' ),
				],
				'default' => [ 'facebook', 'twitter', 'pinterest', 'linkedin' ],
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
					'{{WRAPPER}} .give-goal-progress .income,
					 {{WRAPPER}} .give-goal-progress .goal-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_primary_typography',
				'label' => __( 'Primary Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .give-goal-progress .income,
				 							 {{WRAPPER}} .give-goal-progress .goal-text',
			]
		);

		$this->add_control(
			'goal_progress_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give-goal-progress' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'goal_progress_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .give-goal-progress',
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
				'condition' => [
					'form_id!'=> '',
				],
			]
		);

		$this->add_control(
			'heading_form',
			[
				'label' => __( 'Give Form', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'form_main_color',
			[
				'label' => __( 'Main Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] .give-total-wrap #give-amount' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] .give-btn-modal:hover,
					.give-form[data-style="elementor-give-totals--coropuna"] .give-submit:hover,
					 {{WRAPPER}} .elementor-gt-form form[id*=give-form] #give-donation-level-button-wrap .give-btn:not(.give-default-level)' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] #give-donation-level-button-wrap .give-btn:not(.give-default-level)' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] .give-total-wrap .give-currency-symbol' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_secondary_color',
			[
				'label' => __( 'Secondary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level,
					 {{WRAPPER}} .elementor-gt-form form[id*=give-form] .give-btn-modal' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-gt-form form[id*=give-form] #give-donation-level-button-wrap .give-btn.give-default-level' => 'border-color: {{VALUE}};',
					'.give-form[data-style="elementor-give-totals--coropuna"] #give-gateway-radio-list > li label:hover,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give_terms_agreement label:hover,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give_terms_agreement input[type=checkbox]:checked + label,
					 .give-form[data-style="elementor-give-totals--coropuna"] .give_terms_links:hover,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',
					'.give-form[data-style="elementor-give-totals--coropuna"] #give-gateway-radio-list > li.give-gateway-option-selected label:after,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give_terms_agreement input[type=checkbox]:checked + label:before,
					 .give-form[data-style="elementor-give-totals--coropuna"] #give-final-total-wrap .give-donation-total-label,
					 .give-form[data-style="elementor-give-totals--coropuna"] .give-submit' => 'background-color: {{VALUE}};',
					'.give-form[data-style="elementor-give-totals--coropuna"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} form[id*=give-form],
											 {{WRAPPER}} form[id*=give-form] #give-donation-level-button-wrap .give-btn,
											 .give-form[data-style="elementor-give-totals--coropuna"]',
			]
		);

		$this->end_controls_section();
	}

  public function register_design_give_socials_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_give_socials',
			[
				'label' => __( 'Socials', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'heading_socials_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'socials_title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-socials__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'socials_title_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-gt-socials__title',
			]
		);

    $this->add_control(
			'heading_socials_list_style',
			[
				'label' => __( 'List', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

    $this->start_controls_tabs( 'socials_effects_tabs' );

		$this->start_controls_tab( 'social_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'socials_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-socials__list a svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_background_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-socials__list a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'socials_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

    $this->add_control(
			'socials_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-socials__list a svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_background_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-gt-socials__list a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
			'type' => 'line',
			'strokewidth' => 1,
			'easing' => $settings['goal_progress_easing'],
			'duration' => absint( $settings['goal_progress_duration']['size'] ),
			'color' => $settings['goal_progress_color_from'],
			'trailcolor' => $settings['goal_progress_trailcolor'],
			'trailwidth' => 1,
			'tocolor' => $settings['goal_progress_color_to'],
			'width' => '100%',
			'height' => '15px',
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

					echo bearsthemes_addons_give_totals ( $args, $bar_opts );

				?>
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
							'display_style' => 'modal', //modal, button, and reveal
							'continue_button_title' => '' //string

						);

						add_filter('give_form_html_tags', function($form_html_tags, $form) {
							$form_html_tags['data-style'] = 'elementor-give-totals--coropuna';

							return $form_html_tags;
						}, 10, 2);

						echo give_get_donation_form( $atts );
					}
				?>

			</div>

      <div class="elementor-gt-socials">
        <?php
          if( $this->parent->get_instance_value_skin('socials_title') ) {
            echo '<h3 class="elementor-gt-socials__title">' . $this->parent->get_instance_value_skin('socials_title') . '</h3>';
          }
          if( !empty( $this->parent->get_instance_value_skin('socials_list') ) ) {
            $socials_html = '';

            $socials['facebook'] ='<a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url( get_permalink( $settings['form_id'] ) ) . '" class="facebook" target="_blank">' . bearsthemes_addons_get_social_icon_svg('facebook', 14) . '</a>';

            $socials['twitter'] = '<a href="https://twitter.com/home?status=' . esc_url( get_permalink( $settings['form_id'] ) ) . '" class="twitter" target="_blank">' . bearsthemes_addons_get_social_icon_svg('twitter', 14) . '</a>';

            $socials['pinterest'] = '<a href="https://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink( $settings['form_id'] ) ) . '&amp;media=&amp;description=" class="pinterest" target="_blank">' . bearsthemes_addons_get_social_icon_svg('pinterest', 14) . '</a>';

            $socials['linkedin'] = '<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . esc_url( get_permalink( $settings['form_id'] ) ) . '&amp;title=&amp;summary=&amp;source=' . get_the_permalink( $settings['form_id'] ) . '" class="linkedin" target="_blank">' . bearsthemes_addons_get_social_icon_svg('linkedin', 14) . '</a>';

            $socials['google'] = '<a href="https://plus.google.com/share?url=' . esc_url( get_permalink( $settings['form_id'] ) ) . '" class="google" target="_blank">' . bearsthemes_addons_get_social_icon_svg('google-plus', 14) . '</a>';

            $socials['mail'] = '<a href="mailto:info@websiteplanet.com?&amp;subject=' . esc_url( get_permalink( $settings['form_id'] ) ) . '&amp;body=Hi guys, %0AJust wanted to say you created an amazing theme, i love it. Well done!' . get_the_permalink( $settings['form_id'] ) . '" class="mail">' . bearsthemes_addons_get_social_icon_svg('mail', 14) . '</a>';

            foreach ($this->parent->get_instance_value_skin('socials_list') as $key => $value) {
              $socials_html .= $socials[$value];
            }

            echo '<div class="elementor-gt-socials__list">' . $socials_html . '</div>';

          }

        ?>
      </div>

		<?php

		$this->parent->render_loop_footer();

	}

	protected function content_template() {

	}

}
