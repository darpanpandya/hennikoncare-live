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

class Skin_List_Coropuna extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-testimonial-carousel/section_layout/before_section_end', [ $this, 'register_layout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/before_section_end', [ $this, 'register_design_latyout_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_content_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_box_thumbnail_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-testimonial-carousel/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-list-coropuna';
	}


	public function get_title() {
		return __( 'List Coropuna', 'bearsthemes-addons' );
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
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #4', 'bearsthemes-addons' ),
						'list_job' => 'Job #4',
					],
					[
						'list_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bearsthemes-addons' ),
						'list_image' => Utils::get_placeholder_image_src(),
						'list_name' => __( 'Name #5', 'bearsthemes-addons' ),
						'list_job' => 'Job #5',
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

  public function register_design_box_content_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

    $this->start_controls_section(
			'section_design_box_content',
			[
				'label' => __( 'Box Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'box_content_border_width',
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
					'{{WRAPPER}} .swiper-main' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_content_border_radius',
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
					'{{WRAPPER}} .swiper-main' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_content_padding',
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
					'{{WRAPPER}} .swiper-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

    $this->add_control(
			'box_content_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-main' => 'background-color: {{VALUE}}',
				],
			]
		);

    $this->add_control(
			'box_content_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-main' => 'border-color: {{VALUE}}',
				],
			]
		);

    $this->end_controls_section();
  }

  public function register_design_box_thumbnail_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

    $this->start_controls_section(
			'section_design_box_thumbnail',
			[
				'label' => __( 'Box Thumbnail', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_thumbnail_border_radius',
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
					'{{WRAPPER}} .swiper-thumbs' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_thumbnail_padding',
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
					'{{WRAPPER}} .swiper-thumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

    $this->add_control(
			'box_thumbnail_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-thumbs' => 'background-color: {{VALUE}}',
				],
			]
		);

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

  protected function swiper_data() {
		$settings = $this->parent->get_settings();

		$slides_per_view = $this->parent->get_instance_value_skin('sliders_per_view') ? $this->parent->get_instance_value_skin('sliders_per_view') : 1;
		$slides_per_view_tablet = $this->parent->get_instance_value_skin('sliders_per_view_tablet') ? $this->parent->get_instance_value_skin('sliders_per_view_tablet') : $slides_per_view;
		$slides_per_view_mobile = $this->parent->get_instance_value_skin('sliders_per_view_mobile') ? $this->parent->get_instance_value_skin('sliders_per_view_mobile') : $slides_per_view_tablet;

		$space_between = !empty( $this->parent->get_instance_value_skin('space_between')['size'] ) ? $this->parent->get_instance_value_skin('space_between')['size'] : 30;
		$space_between_tablet = !empty( $this->parent->get_instance_value_skin('space_between_tablet')['size'] ) ? $this->parent->get_instance_value_skin('space_between_tablet')['size'] : $space_between;
		$space_between_mobile = !empty( $this->parent->get_instance_value_skin('space_between_mobile')['size'] ) ? $this->parent->get_instance_value_skin('space_between_mobile')['size'] : $space_between_tablet;


		$swiper_data = array(
			'slidesPerView' => $slides_per_view_mobile,
			'spaceBetween' => $space_between_mobile,
			'speed' => $settings['speed'],
			'loop' => $settings['loop'] == 'yes' ? true : false,
			'breakpoints' => array(
				767 => array(
				  'slidesPerView' => $slides_per_view_tablet,
				  'spaceBetween' => $space_between_tablet,
				),
				1024 => array(
				  'slidesPerView' => $slides_per_view,
				  'spaceBetween' => $space_between,
				)
			),

		);

		if( '' !== $settings['navigation'] ) {
			$swiper_data['navigation'] = array(
				'nextEl' => '.elementor-swiper-button-next',
				'prevEl' => '.elementor-swiper-button-prev',
			);
		}

    if( '' !== $settings['pagination'] ) {
      $swiper_data['pagination'] = array(
        'el' => '.elementor-swiper-pagination',
        'type' => $settings['pagination'],
        'clickable' => true,
      );
    }

		if( $settings['autoplay'] === 'yes' ) {
			$swiper_data['autoplay'] = array(
				'delay' => $settings['autoplay_speed'],
			);
		}

		return $swiper_json = json_encode($swiper_data);
	}

	protected function render_loop_header() {
		$settings = $this->parent->get_settings();

		$classes = 'swiper-main';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-testimonials--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-testimonials--default';
		}

		?>
    <div class="<?php echo esc_attr( $classes ); ?>">
  		<div class="elementor-swiper swiper-container" data-swiper="<?php echo esc_attr( $this->swiper_data() ); ?>">
		    <div class="swiper-wrapper">
		<?php
	}

  protected function render_loop_footer() {
		$settings = $this->parent->get_settings();

		?>
  				</div>

  					<?php
  						if( 'inside' === $settings['pagination_position'] ) {
  							$this->parent->render_pagination();
  						}

  						if( 'inside' === $settings['navigation_position'] ) {
  							$this->parent->render_navigation();
  						}
  					?>

  			</div>

  			<?php
  				if( 'outside' === $settings['pagination_position'] ) {
  					$this->parent->render_pagination();
  				}

  				if( 'outside' === $settings['navigation_position'] ) {
  					$this->parent->render_navigation();
  				}
  			?>
      </div>
		<?php
	}


  protected function swiper_thumbs_data() {

    $swiper_data = array(
			'slidesPerView' => 5,
			'spaceBetween' => 0,
			'loop' => true,
      'centeredSlides' => true,
		);

    return $swiper_json = json_encode($swiper_data);

  }
  protected function render_loop_thumbs_header() {
    $settings = $this->parent->get_settings();

		$classes = 'swiper-thumbs';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-testimonials--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-testimonials--default';
		}

		?>
    <div class="<?php echo esc_attr( $classes ); ?>">
  		<div class="elementor-swiper swiper-container" data-swiper="<?php echo esc_attr( $this->swiper_thumbs_data() ); ?>">
		    <div class="swiper-wrapper">
		<?php
	}

  protected function render_loop_thumbs_footer() {
    ?>
        </div>
      </div>
    </div>
    <?php
  }

	public function render() {
		$settings = $this->parent->get_settings();

		if ( empty( $this->parent->get_instance_value_skin( 'list' ) ) ) {
			return;
		}

		$this->render_loop_header();

		foreach ( $this->parent->get_instance_value_skin( 'list' ) as $index => $item ) {
		?>

		<div class="swiper-slide">
			<div class="elementor-testimonial">

        <div class="elementor-testimonial__icon">
          <?php echo bearsthemes_addons_get_icon_svg( 'quote', 56 ); ?>
        </div>

				<?php
					if( '' !== $item['list_content'] ) {
						echo '<div class="elementor-testimonial__content">' . $item['list_content'] . '</div>';
					}
				?>

        <div class="elementor-testimonial__header">
						<?php
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

		<?php
		}

		$this->render_loop_footer();


    $this->render_loop_thumbs_header();

		foreach ( $this->parent->get_instance_value_skin( 'list' ) as $index => $item ) {
		?>

		<div class="swiper-slide">
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
		</div>

		<?php
		}

		$this->render_loop_thumbs_footer();

	}

	protected function content_template() {

	}

}
