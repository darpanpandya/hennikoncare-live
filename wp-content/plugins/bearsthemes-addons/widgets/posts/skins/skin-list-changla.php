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

class Skin_List_Changla extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-posts/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_feature_section_controls' ] );
		add_action( 'elementor/element/be-posts/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-list-changla';
	}


	public function get_title() {
		return __( 'List Changla', 'bearsthemes-addons' );
	}


  public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
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
					'skin_list_changla_show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.76,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'skin_list_changla_show_thumbnail!'=> '',
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
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default'  => 'yes',
			]
		);

    $this->add_control(
			'show_author',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' 	=> Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default'  => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
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
					'{{WRAPPER}} .elementor-post-feature,
           {{WRAPPER}} .elementor-post' => 'text-align: {{VALUE}};',
				],
			]
		);

	}

	public function register_design_image_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin_list_changla_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'thumbnail_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-post-feature__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-post-feature:hover .elementor-post-feature__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

  public function register_design_content_feature_section_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'section_design_content_feature',
			[
				'label' => __( 'Content Feature', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title_feature_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_feature_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post-feature__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title-feature_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post-feature__title',
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_feature_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__meta li' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_feature_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__meta li:last-child,
           {{WRAPPER}} .elementor-post-feature__meta li a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_feature_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post-feature__meta li',
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_author_feature_style',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_feature_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post-feature__author' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_feature_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post-feature__author a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_feature_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post-feature__author',
				'condition' => [
					'skin_list_changla_show_author!' => '',
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
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_title!' => '',
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
					'{{WRAPPER}} .elementor-post__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_title!' => '',
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
					' {{WRAPPER}} .elementor-post__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__title',
				'condition' => [
					'skin_list_changla_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_meta!' => '',
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
					'{{WRAPPER}} .elementor-post__meta li' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__meta li:last-child,
           {{WRAPPER}} .elementor-post__meta li a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__meta li',
				'condition' => [
					'skin_list_changla_show_meta!' => '',
				],
			]
		);

    	$this->add_control(
			'heading_author_style',
			[
				'label' => __( 'Author', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-post__author' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_control(
			'author_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .elementor-post__author a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-post__author',
				'condition' => [
					'skin_list_changla_show_author!' => '',
				],
			]
		);

		$this->end_controls_section();
  }

  protected function render_feature_post() {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post-feature';

    if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) {
      $post_classes .= ' has-thumbnail';
    }

		?>
      <div class="elementor-post-wrap">
  			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
          <?php if( '' !== $this->parent->get_instance_value_skin('show_thumbnail') ) { ?>
            <div class="elementor-post-feature__thumbnail">
							<a href="<?php the_permalink(); ?>">
	              <?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
							</a>
						</div>
          <?php } ?>

          <div class="elementor-post-feature__content">
            <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
    					<ul class="elementor-post-feature__meta">
                <li>
									<?php
	                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
	  							?>
    	          </li>

                <?php
                  if ( has_category() ) {
                    echo '<li>';
                      the_category( ', ' );
                    echo '</li>';
                  }
                ?>
    	        </ul>
    				<?php } ?>

            <?php
              if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
                the_title( '<h3 class="elementor-post-feature__title __max-2-line"><a href="' . get_the_permalink() . '">', '</a></h3>' );
              }
            ?>

            <?php if( '' !== $this->parent->get_instance_value_skin('show_author') ) { ?>
              <div class="elementor-post-feature__author">
                <?php
                echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                  get_avatar( get_the_author_meta( 'ID' ), 40 ) .
                  '<span>' . esc_html__('Posted by ', 'bearsthemes-addons') . '</span>' . get_the_author() .
                '</a>';
                ?>
              </div>
            <?php } ?>

          </div>

  			</article>
      </div>
		<?php
  }

  protected function render_post() {
		$settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-post';

		?>
      <div class="elementor-post-wrap">
  			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >

          <?php if( '' !== $this->parent->get_instance_value_skin('show_meta') ) { ?>
  					<ul class="elementor-post__meta">
              <li>
                <?php
                  echo '<time class="entry-date published" datetime="' . esc_attr( get_the_date( DATE_W3C ) ) . '">' . esc_html( get_the_date() ) . '</time>';
  							?>
  	          </li>

              <?php
                if ( has_category() ) {
                  echo '<li>';
                    the_category( ', ' );
                  echo '</li>';
                }
              ?>
  	        </ul>
  				<?php } ?>

          <?php
            if( '' !== $this->parent->get_instance_value_skin('show_title') ) {
              the_title( '<h3 class="elementor-post__title __max-2-line"><a href="' . get_the_permalink() . '">', '</a></h3>' );
            }
          ?>

          <?php if( '' !== $this->parent->get_instance_value_skin('show_author') ) { ?>
            <div class="elementor-post__author">
              <?php
              echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.
                '<span>' . esc_html__('Posted by ', 'bearsthemes-addons') . '</span>' . get_the_author() .
              '</a>';
              ?>
            </div>
          <?php } ?>

  			</article>
      </div>
		<?php
	}

	public function render() {

		$query = $this->parent->query_posts();

    if ( $query->have_posts() ) {

			$this->parent->render_loop_header();

				$count = 0;
				while ( $query->have_posts() ) { $count++;
					$query->the_post();

					if( 1 == $count ) {
						$this->render_feature_post();
					} else {
						$this->render_post();
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
