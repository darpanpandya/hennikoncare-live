<?php
namespace BearsthemesAddons\Widgets\Posts\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Cobble_Grouse extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
    	add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cobble-grouse';
	}


	public function get_title() {
		return __( 'Cobble Grouse', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
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
				'default' => 'medium',
				'exclude' => [ 'custom' ],
				'condition' => [
					'skin_cobble_grouse_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
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
			'show_excerpt',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'grouse_excerpt_length', 15 ),
				'condition' => [
					'skin_cobble_grouse_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'grouse_excerpt_more', '' ),
				'condition' => [
					'skin_cobble_grouse_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default'  => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'column_gap',
			[
				'label' => __( 'Columns Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => __( 'Rows Gap', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
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
					'{{WRAPPER}} .elementor-post' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-post,
           {{WRAPPER}} .elementor-post.has-thumbnail .elementor-post__author,
           {{WRAPPER}} .elementor-post.has-thumbnail .elementor-post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'selector' => '{{WRAPPER}} .elementor-post',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

  }

	public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_cobble_grouse_show_thumbnail!'=> '',
				],
			]
		);

    $this->add_control(
			'overlay_bg_color',
			[
				'label' => __( 'Overlay Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-post__overlay' => 'background-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-post__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-post:hover .elementor-post__thumbnail img',
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
			'heading_date_style',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_grouse_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__category a,
           {{WRAPPER}} .elementor-post-feature__category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_category!' => '',
				],
			]
		);

		$this->add_control(
			'category_color_secondary',
			[
				'label' => __( 'Secondary', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__category,
           {{WRAPPER}} .elementor-post-feature__category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_category!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__category,
                       {{WRAPPER}} .elementor-post-feature__category',
				'condition' => [
					'skin_cobble_grouse_show_category!' => '',
				],
			]
		);

    $this->add_control(
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_grouse_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title,
          {{WRAPPER}} .elementor-post-feature__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title a:hover,
           {{WRAPPER}} .elementor-post-feature__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__title,
                       {{WRAPPER}} .elementor-post-feature__title',
				'condition' => [
					'skin_cobble_grouse_show_title!' => '',
				],
			]
		);

    	$this->add_control(
			'excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_grouse_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post-feature__excerpt',
				'condition' => [
					'skin_cobble_grouse_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_grouse_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_primary_color',
			[
				'label' => __( 'Primary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta a,
           {{WRAPPER}} .elementor-post-feature__meta a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_meta!' => '',
				],
			]
		);

    $this->add_control(
			'meta_secondary_color',
			[
				'label' => __( 'Secondary Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta,
           {{WRAPPER}} .elementor-post-feature__meta' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_grouse_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__meta,
                       {{WRAPPER}} .elementor-post-feature__meta',
				'condition' => [
					'skin_cobble_grouse_show_meta!' => '',
				],
			]
		);

    $this->end_controls_section();
  }

  protected function render_post_feature( $count ) {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post-feature';
    $post_classes .= ' elementor-post--' . $count;

		if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
			$post_classes .= ' has-thumbnail';
		}

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post-feature__thumbnail-wrap">
            <div class="elementor-post-feature__thumbnail">
              <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
              <div class="elementor-post-feature__overlay"></div>
            </div>
          </div>
        <?php } ?>

        <div class="elementor-post-feature__content">
          <?php
            if ( has_category() && '' !== $this->parent->get_instance_value_skin('show_category') ) {
              echo '<div class="elementor-post-feature__category">';
                the_category( ', ' );
              echo '</div>';
            }

						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post-feature__title __max-2-line"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}

            if( '' !== $this->parent->get_instance_value_skin('show_excerpt') ) {
							?>
								<div class="elementor-post-feature__excerpt">
									<?php echo wp_trim_words( get_the_excerpt(), $this->parent->filter_excerpt_length(), $this->parent->filter_excerpt_more() ); ?>
								</div>
							<?php
						}
					?>

          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<ul class="elementor-post-feature__meta">
  	          <li>
  	            <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	          </li>
              <li>
                <?php
                  echo '<span>' . esc_html__('By ', 'bearsthemes-addons') . '</span>' .
                  '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                    get_the_author() .
                  '</a>';
                ?>
              </li>
  	        </ul>
  				<?php } ?>
        </div>

			</article>
		<?php
  }

	protected function render_post( $count ) {
		$settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post';
    $post_classes .= ' elementor-post--' . $count;

		if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) {
			$post_classes .= ' has-thumbnail';
		}

		?>
			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
        <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
          <div class="elementor-post__thumbnail-wrap">
            <div class="elementor-post__thumbnail">
              <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
              <div class="elementor-post__overlay"></div>
            </div>
          </div>
        <?php } ?>

        <div class="elementor-post__content">
          <?php
            if ( has_category() && '' !== $this->parent->get_instance_value_skin('show_category') ) {
              echo '<div class="elementor-post__category">';
                the_category( ', ' );
              echo '</div>';
            }

						if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
							the_title( '<h3 class="elementor-post__title __max-2-line"><a href="' . get_the_permalink() . '">', '</a></h3>' );
						}
					?>

          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<ul class="elementor-post__meta">
  	          <li>
  	            <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	          </li>
              <li>
                <?php
                  echo '<span>' . esc_html__('By ', 'bearsthemes-addons') . '</span>' .
                  '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                    get_the_author() .
                  '</a>';
                ?>
              </li>
  	        </ul>
  				<?php } ?>
        </div>

			</article>
		<?php
	}

  public function render() {

		$query = $this->parent->query_posts();

		if ( $query->have_posts() ) {

      $this->parent->render_loop_header();

        $count = 0;
        while ( $query->have_posts() ) {
          $query->the_post();
          $count ++;

          if( $count == 1 ) {
            $this->render_post_feature( $count );
          } else {
            $this->render_post( $count );
          }

        }

			$this->parent->render_loop_footer();

		} else {
		    // no posts found
		}

		$this->parent->pagination();

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
