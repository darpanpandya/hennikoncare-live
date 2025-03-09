<?php
namespace BearsthemesAddons\Widgets\Give_Totals;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Give_Totals extends Widget_Base {

	public function get_name() {
		return 'be-give-totals';
	}

	public function get_title() {
		return __( 'Be Give Totals', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'elementor-waypoints', 'jquery-progressbar', 'bearsthemes-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Pumori( $this ) );
		$this->add_skin( new Skins\Skin_Baruntse( $this ) );
		$this->add_skin( new Skins\Skin_Coropuna( $this ) );
		$this->add_skin( new Skins\Skin_Saltoro( $this ) );
		$this->add_skin( new Skins\Skin_Changla( $this ) );
		$this->add_skin( new Skins\Skin_Taboche( $this ) );
		$this->add_skin( new Skins\Skin_Galloway( $this ) );
		$this->add_skin( new Skins\Skin_Wilson( $this ) );
		$this->add_skin( new Skins\Skin_Jorasses( $this ) );

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

	protected function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'give_forms_category',
	    'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

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
			'heading_give_total',
			[
				'label' => __( 'Give Total', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'total_goal',
			[
				'label' => __( 'Total Goal', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
			]
		);

		$this->add_control(
			'custom_total_earnings',
			[
				'label' => __( 'Custom Total Earnings', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'total_earnings',
			[
				'label' => __( 'Total Earnings', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1200,
				'condition' => [
					'custom_total_earnings!' => '',
				],
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_post_ids(),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'custom_total_earnings' => '',
				],
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'custom_total_earnings' => '',
				],
			]
		);

		$this->add_control(
			'heading_give_form',
			[
				'label' => __( 'Give Form', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .elementor-give-totals' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_give_total_section_controls() {
		$this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Give Total', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
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
			'goal_progress_main_color',
			[
				'label' => __( 'Main Color', 'bearsthemes-addons' ),
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
				'name' => 'goal_progress_main_typography',
				'label' => __( 'Main Typography', 'bearsthemes-addons' ),
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

		$this->add_control(
			'heading_message',
			[
				'label' => __( 'Message', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'mesage_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .give-totals-message' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .give-totals-message',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_give_form_section_controls() {
		$this->start_controls_section(
			'section_give_form',
			[
				'label' => __( 'Give Form', 'bearsthemes-addons' ),
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
					'.give-form[data-style="elementor-give-totals--default"] .give-total-wrap #give-amount,
					.give-form[data-style="elementor-give-totals--default"] #give-donation-level-button-wrap .give-btn:hover,
					.give-form[data-style="elementor-give-totals--default"] #give-gateway-radio-list > li.give-gateway-option-selected label,
					.give-form[data-style="elementor-give-totals--default"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-totals--default"] #give-donation-level-radio-list li input.give-default-level + label,
					.give-form[data-style="elementor-give-totals--default"] #give-donation-level-radio-list li label:hover,
					.give-form[data-style="elementor-give-totals--default"] #give-gateway-radio-list > li label:hover,
					.give-form[data-style="elementor-give-totals--default"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-totals--default"] #give_terms_agreement label:hover,
					.give-form[data-style="elementor-give-totals--default"] #give_terms_agreement input[type=checkbox]:checked + label,
					.give-form[data-style="elementor-give-totals--default"] .give_terms_links:hover,
					.give-form[data-style="elementor-give-totals--default"] #give-final-total-wrap .give-final-total-amount' => 'color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-totals--default"] .give-total-wrap .give-currency-symbol,
				 .give-form[data-style="elementor-give-totals--default"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-totals--default"] #give-donation-level-radio-list li label:after,
				 .give-form[data-style="elementor-give-totals--default"] #give-gateway-radio-list > li label:after,
				 .give-form[data-style="elementor-give-totals--default"] #give_terms_agreement input[type=checkbox]:checked + label:before,
				 .give-form[data-style="elementor-give-totals--default"] #give-final-total-wrap .give-donation-total-label,
				 .give-form[data-style="elementor-give-totals--default"] .give-submit,
				 .give-form[data-style="elementor-give-totals--default"] .give-btn-modal' => 'background-color: {{VALUE}};',

				 '.give-form[data-style="elementor-give-totals--default"] #give-donation-level-button-wrap .give-btn.give-default-level,
				 .give-form[data-style="elementor-give-totals--default"] #give-donation-level-button-wrap .give-btn:hover,
				 .give-form[data-style="elementor-give-totals--default"] #give_terms_agreement input[type=checkbox]:checked + label:before' => 'border-color: {{VALUE}};',
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
					'.give-form[data-style="elementor-give-totals--default"] .give-submit:hover,
 				  .give-form[data-style="elementor-give-totals--default"] .give-btn-modal:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '.give-form[data-style="elementor-give-totals--default"]',
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_goal_progress_section_controls() {
		$this->start_controls_section(
			'section_goal_progress',
			[
				'label' => __( 'Goal Progress', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_goal_progress',
			[
				'label' => __( 'Custom Goal Progress', 'bearsthemes-addons' ),
				'description' => __( 'Check this to custom goal progress in give forms.', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'bearsthemes-addons' ),
				'label_off' => __( 'Off', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'goal_progress_easing',
			[
				'label' => __( 'Easing', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'linear' => __( 'Linear', 'bearsthemes-addons' ),
					'easeOut' => __( 'EaseOut', 'bearsthemes-addons' ),
					'bounce' => __( 'Bounce', 'bearsthemes-addons' ),
				],
				'condition' => [
					'custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_duration',
			[
				'label' => __( 'Duration', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'condition' => [
					'custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_color_from',
			[
				'label' => __( 'from Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFEA82',
				'condition' => [
					'custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_color_to',
			[
				'label' => __( 'to Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ED6A5A',
				'condition' => [
					'custom_goal_progress!' => '',
				],
			]
		);

		$this->add_control(
			'goal_progress_trailcolor',
			[
				'label' => __( 'Trail Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#EEEEEE',
				'condition' => [
					'custom_goal_progress!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_give_total_section_controls();
		$this->register_design_give_form_section_controls();
		$this->register_design_goal_progress_section_controls();
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

		$classes = 'elementor-give-totals';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-give-totals--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-give-totals--default';
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
			'message'      => apply_filters( 'give_totals_message', __( 'Hey! We\'ve raised {total} of the {total_goal} we are trying to raise for this campaign!', 'bearsthemes-addons' ) ),
			'link'         => '', // URL.
			'link_text'    => __( 'Donate Now', 'bearsthemes-addons' ), // string,
			'progress_bar' => true, // boolean.
			'show_text' => true, // boolean.
			'show_bar' => true, // boolean.
			'income_text' => __( 'of', 'bearsthemes-addons' ),
			'goal_text' => __( 'raised', 'bearsthemes-addons' ),
			'custom_goal_progress' => $settings['custom_goal_progress'],
		);

		$bar_opts = array(
			'type' => 'line',
			'strokewidth' => 4,
			'easing' => $settings['goal_progress_easing'],
			'duration' => absint( $settings['goal_progress_duration']['size'] ),
			'color' => $settings['goal_progress_color_from'],
			'trailcolor' => $settings['goal_progress_trailcolor'],
			'trailwidth' => 1,
			'tocolor' => $settings['goal_progress_color_to'],
			'width' => '100%',
			'height' => '12px',
		);

		echo bearsthemes_addons_give_totals ( $args, $bar_opts );

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
			$form_html_tags['data-style'] = 'elementor-give-totals--default';

			return $form_html_tags;
		}, 10, 2);

		echo give_get_donation_form( $atts );

		$this->render_loop_footer();

	}

	protected function content_template() {

	}
}
