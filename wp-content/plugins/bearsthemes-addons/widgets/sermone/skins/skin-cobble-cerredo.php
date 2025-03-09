<?php
namespace BearsthemesAddons\Widgets\Sermone\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Cobble_Cerredo extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-sermone/section_layout/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/be-sermone/section_design_layout/before_section_end', [ $this, 'registerd_design_layout_controls' ] );
		add_action( 'elementor/element/be-sermone/section_design_layout/after_section_end', [ $this, 'register_design_box_section_controls' ] );
		add_action( 'elementor/element/be-sermone/section_design_layout/after_section_end', [ $this, 'register_design_image_section_controls' ] );
		add_action( 'elementor/element/be-sermone/section_design_layout/after_section_end', [ $this, 'register_design_content_section_controls' ] );

	}

	public function get_id() {
		return 'skin-cobble-cerredo';
	}


	public function get_title() {
		return __( 'Cobble Cerredo', 'bearsthemes-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
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
					'skin_cobble_cerredo_show_thumbnail!'=> '',
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
				'default' => apply_filters( 'cerredo_excerpt_length', 15 ),
				'condition' => [
					'skin_cobble_cerredo_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_more',
			[
				'label' => __( 'Excerpt More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => apply_filters( 'excerpt_more', '' ),
				'condition' => [
					'skin_cobble_cerredo_show_excerpt!' => '',
				],
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
			'show_quickview',
			[
				'label' => __( 'Quickview', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
			]
		);

	}

	public function registerd_design_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

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
					'{{WRAPPER}} .elementor-sermon' => 'text-align: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-sermon' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-sermon' => 'border-radius: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elementor-sermon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'after',
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
				'selector' => '{{WRAPPER}} .elementor-sermon',
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon' => 'border-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-sermon:hover',
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon:hover' => 'border-color: {{VALUE}}',
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
					'skin_cobble_cerredo_show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'overlay_bg_color',
			[
				'label' => __( 'Overlay Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon__overlay' => 'background-color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .elementor-sermon__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-sermon:hover .elementor-sermon__thumbnail img',
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
					'skin_cobble_cerredo_show_title!' => '',
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
					'{{WRAPPER}} .elementor-sermon__title,
           {{WRAPPER}} .elementor-sermon-feature__title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_cerredo_show_title!' => '',
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
					'{{WRAPPER}} .elementor-sermon__title a:hover,
           {{WRAPPER}} .elementor-sermon-feature__title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_cerredo_show_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
        'label' => __( 'Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sermon__title',
				'condition' => [
					'skin_cobble_cerredo_show_title!' => '',
				],
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_feature_typography',
        'label' => __( 'Feature Typography', 'bearsthemes-addons' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sermon-feature__title',
				'condition' => [
					'skin_cobble_cerredo_show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_cerredo_show_meta!' => '',
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
					'{{WRAPPER}} .elementor-sermon__meta,
           {{WRAPPER}} .elementor-sermon-feature__meta' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_cerredo_show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sermon__meta,
                       {{WRAPPER}} .elementor-sermon-feature__meta',
				'condition' => [
					'skin_cobble_cerredo_show_meta!' => '',
				],
			]
		);

    $this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'skin_cobble_cerredo_show_excerpt!' => '',
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
					'{{WRAPPER}} .elementor-sermon-feature__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin_cobble_cerredo_show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-sermon-feature__excerpt',
				'condition' => [
					'skin_cobble_cerredo_show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_quickview_style',
			[
				'label' => __( 'Quickview', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
        'condition' => [
					'skin_cobble_cerredo_show_quickview!' => '',
				],
			]
		);

		$this->add_control(
			'quickview_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon__quickview span,
           {{WRAPPER}} .elementor-sermon-feature__quickview span' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_cobble_cerredo_show_quickview!' => '',
				],
			]
		);

		$this->add_control(
			'quickview_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-sermon__quickview span:hover,
           {{WRAPPER}} .elementor-sermon-feature__quickview span:hover' => 'color: {{VALUE}};',
				],
        'condition' => [
					'skin_cobble_cerredo_show_quickview!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

  protected function render_post_feature( $count ) {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-sermon-feature';
    $post_classes .= ' elementor-sermon--' . $count;

    if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) {
      $post_classes .= ' has-thumbnail';
    }

		?>
      <div class="elementor-sermon-wrap">
  			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
          <?php if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) { ?>
            <div class="elementor-sermon-feature__thumbnail">
							<a href="<?php the_permalink(); ?>">
	  						<div class="elementor-sermon-feature__overlay"></div>
	  						<?php the_post_thumbnail( 'medium_large' ); ?>
							</a>
    				</div>
    			<?php } ?>

    			<div class="elementor-sermon-feature__content">
            <?php if( '' !== $settings['show_meta'] ) { ?>
  						<ul class="elementor-sermon-feature__meta">
  							<li>
  								<?php
  									echo sermone_date_format( '', sermone_get_field( 'sermon_date_preached', get_the_ID() ) );
  								?>
  							</li>
  		          <li>
  								<?php echo get_the_term_list( get_the_ID(), 'sermone_preacher',  __( 'Speaker: ', 'bearsthemes-addons' ), ', ', '.' ) ?>
  							</li>
  		        </ul>
  					<?php } ?>

    				<?php
    					if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ) {
    						the_title( '<h3 class="elementor-sermon-feature__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
    					}
            ?>

            <?php if( '' !== $this->parent->get_instance_value_skin( 'show_excerpt' ) ) { ?>
  						<div class="elementor-sermon-feature__excerpt">
  							<?php echo wp_trim_words( get_the_excerpt(), $this->parent->filter_excerpt_length(), $this->parent->filter_excerpt_more() ); ?>
  						</div>
						<?php } ?>

            <?php if( '' !== $this->parent->get_instance_value_skin( 'show_quickview' ) ) { ?>
              <a href="<?php the_permalink() ?>" class="sermone-quickview elementor-sermon-feature__quickview" data-sermone-quickview="<?php the_ID() ?>">
                <?php
                echo '<span class="video">' . bearsthemes_addons_get_icon_svg( 'video-camera', 16 ) . '</span>' .
                     '<span class="audio">' . bearsthemes_addons_get_icon_svg( 'headphones', 16 ) . '</span>' .
                     '<span class="download">' . bearsthemes_addons_get_icon_svg( 'download-file', 16 ) . '</span>';
                ?>
              </a>
            <?php } ?>
  				</div>
  			</article>
      </div>
		<?php
	}

	protected function render_post( $count ) {
    $settings = $this->parent->get_settings_for_display();

    $post_classes = 'elementor-sermon';
    $post_classes .= ' elementor-sermon--' . $count;

    if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) {
      $post_classes .= ' has-thumbnail';
    }

		?>
      <div class="elementor-sermon-wrap">
  			<article id="post-<?php the_ID();  ?>" <?php post_class( $post_classes ); ?> >
          <?php if( '' !== $this->parent->get_instance_value_skin( 'show_thumbnail' ) ) { ?>
            <div class="elementor-sermon__thumbnail">
							<a href="<?php the_permalink(); ?>">
	  						<div class="elementor-sermon__overlay"></div>
	  						<?php the_post_thumbnail( $this->parent->get_instance_value_skin('thumbnail_size') ); ?>
							</a>
						</div>
    			<?php } ?>

    			<div class="elementor-sermon__content">
            <?php if( '' !== $this->parent->get_instance_value_skin( 'show_meta' ) ) { ?>
  						<ul class="elementor-sermon__meta">
  							<li>
  								<?php
  									echo sermone_date_format( '', sermone_get_field( 'sermon_date_preached', get_the_ID() ) );
  								?>
  							</li>
  		          <li>
  								<?php echo get_the_term_list( get_the_ID(), 'sermone_preacher',  __( 'Speaker: ', 'bearsthemes-addons' ), ', ', '.' ) ?>
  							</li>
  		        </ul>
  					<?php } ?>

    				<?php
    					if( '' !== $this->parent->get_instance_value_skin( 'show_title' ) ) {
    						the_title( '<h3 class="elementor-sermon__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
    					}
            ?>

            <?php if( '' !== $this->parent->get_instance_value_skin( 'show_quickview' ) ) { ?>
              <a href="<?php the_permalink() ?>" class="sermone-quickview elementor-sermon__quickview" data-sermone-quickview="<?php the_ID() ?>">
                <?php
                echo '<span class="video">' . bearsthemes_addons_get_icon_svg( 'video-camera', 16 ) . '</span>' .
                     '<span class="audio">' . bearsthemes_addons_get_icon_svg( 'headphones', 16 ) . '</span>' .
                     '<span class="download">' . bearsthemes_addons_get_icon_svg( 'download-file', 16 ) . '</span>';
                ?>
              </a>
            <?php } ?>
  				</div>
  			</article>
      </div>
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

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
