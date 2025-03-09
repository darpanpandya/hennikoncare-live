<?php
namespace BearsthemesAddons\Widgets\Events_Carousel\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Grid_Yutmaru extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-events-carousel/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-events-carousel/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-events-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
    	add_action( 'elementor/element/be-events-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-grid-yutmaru';
	}


	public function get_title() {
		return __( 'Grid Yutmaru', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_responsive_control(
			'sliders_per_view',
			[
				'label' => __( 'Slides Per View', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => __( 'Posts count', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
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
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_grid_yutmaru_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

    $this->add_control(
			'show_meta',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'bearsthemes-addons' ),
				'condition' => [
					'skin_grid_yutmaru_show_read_more!' => '',
				],
			]
		);
	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
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
					'{{WRAPPER}} .elementor-event' => 'text-align: {{VALUE}};',
				],
			]
		);

	}

  public function register_design_box_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'box_border_width',
			[
				'label' => __( 'Border Width', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-event' => 'border-radius: {{SIZE}}{{UNIT}}',
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
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'bg_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-event',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .elementor-event:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-event:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
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
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_yutmaru_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_yutmaru_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-event__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_yutmaru_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__title',
				'condition' => [
					'skin_grid_yutmaru_show_title!' => '',
				],
			]
		);

    $this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_yutmaru_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__meta' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_grid_yutmaru_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__meta',
				'condition' => [
					'skin_grid_yutmaru_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'heading_read_more_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_grid_yutmaru_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__read-more' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_grid_yutmaru_show_read_more!' => '',
				],
			]
		);

    $this->add_control(
			'read_more_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-event__read-more:hover' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_grid_yutmaru_show_read_more!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__read-more',
				'condition' => [
					'skin_grid_yutmaru_show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_post() {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-event';

    if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) {
      $post_classes .= ' has-thumbnail';
    }

		?>
		<div class="swiper-slide">
      <article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) { ?>
          <div class="elementor-event__thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail( $this->parent->get_instance_value_skin( 'thumbnail_size' ) ); ?>
            </a>
          </div>
        <?php } ?>

        <div class="elementor-event__content">
          <?php
            $organizer_id = get_post_meta( get_the_ID(), '_EventOrganizerID', true);
            if( $organizer_id ) {
              echo '<div class="elementor-event__organizer">' .
                  get_the_post_thumbnail( $organizer_id, 'medium' ) .
                  '<span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9416 0.00133427C23.227 -0.0133772 23.5052 0.0941082 23.7066 0.296913C23.9079 0.499438 24.0135 0.77797 23.9972 1.063C23.1989 15.1 10.7032 20.3681 10.5775 20.4194C10.2029 20.5725 9.77306 20.4862 9.48669 20.2002L3.79932 14.5128C3.51478 14.2279 3.42775 13.8006 3.57813 13.427C3.6284 13.3004 8.83823 0.737265 22.9416 0.00133427ZM13.3056 11.7822C14.057 12.0934 14.922 11.9212 15.497 11.346C16.2819 10.5608 16.2819 9.28804 15.497 8.50284C14.922 7.92765 14.057 7.75551 13.3056 8.0667C12.5542 8.37789 12.0642 9.11111 12.0642 9.92444C12.0642 10.7378 12.5542 11.471 13.3056 11.7822Z" fill="white"/>
                  <path d="M1.11898 18.8161C1.84047 18.0897 2.89531 17.8045 3.88456 18.0683C4.87382 18.3322 5.64649 19.1049 5.91035 20.0941C6.17422 21.0834 5.88901 22.1382 5.16258 22.8597C4.04561 23.9767 0 23.9998 0 23.9998C0 23.9998 0 19.9321 1.11898 18.8161Z" fill="white"/>
                  <path opacity="0.59854" d="M10.4125 2.22412C7.53674 1.7236 4.59746 2.65546 2.53541 4.72146C1.99774 5.26411 1.53027 5.87208 1.14397 6.53112C0.911305 6.9262 0.975403 7.42864 1.29981 7.75265L3.29949 9.75333C5.15763 6.8044 7.57386 4.24678 10.4125 2.22412Z" fill="white"/>
                  <path opacity="0.59854" d="M21.7749 13.5864C22.2754 16.4622 21.3435 19.4014 19.2775 21.4635C18.7349 22.0012 18.1269 22.4686 17.4679 22.8549C17.0728 23.0876 16.5704 23.0235 16.2464 22.6991L14.2457 20.6994C17.1946 18.8413 19.7522 16.425 21.7749 13.5864Z" fill="white"/>
                  </svg></span>' .
                '</div>';
            }
            ?>

            <div class="elementor-event__content-inner">
              <?php
                if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ) {
                  the_title( '<h3 class="elementor-event__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
                }

                if( '' !== $this->parent->get_instance_value_skin( 'show_meta' ) ) {
                  echo '<ul class="elementor-event__meta">';
                    $venue_id = get_post_meta( get_the_ID(), '_EventVenueID', true);
                    echo '<li class="location">' .
                      bearsthemes_addons_get_icon_svg( 'location', 16 );
                      $this->parent->event_addres( $venue_id );
                    echo '</li>';

                    echo '<li class="time">' .
                          bearsthemes_addons_get_icon_svg( 'clock', 16 ) .
                          '<span class="time">'  . tribe_get_start_date( get_the_ID() ) . '</span>
                          </li>';
                  echo '</ul>';
                }

                if( '' !== $this->parent->get_instance_value_skin( 'show_read_more' ) ) {
                  echo '<a class="elementor-event__read-more" href="' . get_the_permalink() . '">' . $this->parent->get_instance_value_skin( 'read_more_text' ) . '<svg width="24" height="12" viewBox="0 0 24 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.937483 5.06249H20.7918L17.5028 1.78949C17.1358 1.42424 17.1344 0.830668 17.4997 0.463684C17.8649 0.096653 18.4586 0.095294 18.8255 0.460497L23.7242 5.33549C23.7245 5.33577 23.7247 5.3361 23.725 5.33638C24.0911 5.70163 24.0922 6.29713 23.7251 6.6636C23.7248 6.66388 23.7245 6.66421 23.7243 6.66449L18.8256 11.5395C18.4587 11.9046 17.8651 11.9034 17.4998 11.5363C17.1345 11.1693 17.1359 10.5757 17.5029 10.2105L20.7918 6.93749H0.937483C0.419703 6.93749 -1.71661e-05 6.51777 -1.71661e-05 5.99999C-1.71661e-05 5.48221 0.419703 5.06249 0.937483 5.06249Z"/>
                        </svg></a>';
                }
            ?>
          </div>
        </div>
      </article>
		</div>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

			$this->parent->render_loop_header();

				while ( $query->have_posts() ) {
					$query->the_post();

					$this->render_post();

				}

			$this->parent->render_loop_footer();

		} else {
		    // no posts found
		}

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
