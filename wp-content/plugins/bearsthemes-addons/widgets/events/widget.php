<?php
namespace BearsthemesAddons\Widgets\Events;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Events extends Widget_Base {

	public function get_name() {
		return 'be-events';
	}

	public function get_title() {
		return __( 'Be Events', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

	public function get_script_depends() {
		return [ 'bearsthemes-addons' ];
	}

	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Grid_Andrus( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Changla( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Havsula( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Castor( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Grouse( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Sankar( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Manaslu( $this ) );
		$this->add_skin( new Skins\Skin_Grid_Yutmaru( $this ) );
		$this->add_skin( new Skins\Skin_List_Pumori( $this ) );
		$this->add_skin( new Skins\Skin_List_Baruntse( $this ) );
		$this->add_skin( new Skins\Skin_List_Coropuna( $this ) );
		$this->add_skin( new Skins\Skin_List_Changtse( $this ) );
		$this->add_skin( new Skins\Skin_List_Taboche( $this ) );
		$this->add_skin( new Skins\Skin_List_Galloway( $this ) );
		$this->add_skin( new Skins\Skin_List_Paradis( $this ) );
		$this->add_skin( new Skins\Skin_List_Jorasses( $this ) );
		$this->add_skin( new Skins\Skin_List_Michelson( $this ) );
		$this->add_skin( new Skins\Skin_List_Cerredo( $this ) );
		$this->add_skin( new Skins\Skin_List_Gangri( $this ) );
		$this->add_skin( new Skins\Skin_List_Cruces( $this ) );
		$this->add_skin( new Skins\Skin_Cobble_Michelson( $this ) );
		$this->add_skin( new Skins\Skin_Cobble_Vaccine( $this ) );

	}

	protected function get_supported_ids() {
		$supported_ids = [];

		$wp_query = new \WP_Query( array(
														'post_type' => 'tribe_events',
														'post_status' => 'publish'
													) );

		if ( $wp_query->have_posts() ) {
	    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $supported_ids[get_the_ID()] = get_the_title();
	    }
		}

		return $supported_ids;
	}

	public function get_supported_taxonomies() {
		$supported_taxonomies = [];

		$categories = get_terms( array(
			'taxonomy' => 'tribe_events_cat',
	    'hide_empty' => false,
		) );
		if( ! empty( $categories )  && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
			    $supported_taxonomies[$category->term_id] = $category->name;
			}
		}

		return $supported_taxonomies;
	}

	protected function get_supported_venue_taxonomies() {
		$supported_taxonomies = [];

		$args = array(
			'post_type' => 'tribe_venue',
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

	protected function get_supported_organizer_taxonomies() {
		$supported_taxonomies = [];

		$args = array(
			'post_type' => 'tribe_organizer',
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

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
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
				'prefix_class' => 'elementor-grid%s-',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'condition' => [
					'_skin' => '',
				],
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
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium',
				'exclude' => [ 'custom' ],
				'condition' => [
					'_skin' => '',
					'show_thumbnail!'=> '',
				],
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label' => __( 'Image Ratio', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event__thumbnail' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
				'condition' => [
					'_skin' => '',
					'show_thumbnail!'=> '',
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
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' => __( 'Meta Data', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
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
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => apply_filters( 'excerpt_length', 25 ),
				'condition' => [
					'_skin' => '',
					'show_excerpt!' => '',
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
					'_skin' => '',
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'show_cost',
			[
				'label' => __( 'Cost', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bearsthemes-addons' ),
				'label_off' => __( 'Hide', 'bearsthemes-addons' ),
				'default' => 'yes',
				'condition' => [
					'_skin' => '',
				],
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
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => __( 'Read More Text', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More »', 'bearsthemes-addons' ),
				'condition' => [
					'_skin' => '',
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_query_section_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'bearsthemes-addons' ),
			]
		);

		$this->start_controls_tabs( 'tabs_query' );

		$this->start_controls_tab(
			'tab_query_include',
			[
				'label' => __( 'Include', 'elementor' ),
			]
		);

		$this->add_control(
			'ids',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
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
			]
		);

		$this->add_control(
			'venue',
			[
				'label' => __( 'Venue', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_venue_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'organizer',
			[
				'label' => __( 'Organizer', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_organizer_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_query_exnlude',
			[
				'label' => __( 'Exclude', 'elementor' ),
			]
		);

		$this->add_control(
			'ids_exclude',
			[
				'label' => __( 'Ids', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_ids(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'category_exclude',
			[
				'label' => __( 'Category', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'venue_exclude',
			[
				'label' => __( 'Venue', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_venue_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'organizer_exclude',
			[
				'label' => __( 'Organizer', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_supported_organizer_taxonomies(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => __( 'Offset', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'description' => __( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'bearsthemes-addons' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'coming_soon',
			[
				'label' => __( 'Coming Soon', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'bearsthemes-addons' ),
				'label_off' => __( 'Off', 'bearsthemes-addons' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'event_start_date',
			[
				'label' => __( 'Event Start Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DATE_TIME,
				'condition' => [
					'coming_soon' => '',
				],
			]
		);

		$this->add_control(
			'event_end_date',
			[
				'label' => __( 'Event End Date', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DATE_TIME,
				'condition' => [
					'coming_soon' => '',
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'event_start_date' => __( 'Event Start Date', 'bearsthemes-addons' ),
					'post_date' => __( 'Date', 'bearsthemes-addons' ),
					'post_title' => __( 'Title', 'bearsthemes-addons' ),
					'menu_order' => __( 'Menu Order', 'bearsthemes-addons' ),
					'rand' => __( 'Random', 'bearsthemes-addons' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc' => __( 'ASC', 'bearsthemes-addons' ),
					'desc' => __( 'DESC', 'bearsthemes-addons' ),
				],
				'condition' => [
					'orderby!' => 'event_start_date',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_pagination_section_controls() {
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'bearsthemes-addons' ),
					'number' => __( 'Number', 'bearsthemes-addons' ),
					'both' => __( 'Number + Previous/Next', 'bearsthemes-addons' ),
				],
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
				'condition' => [
					'_skin' => '',
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
				'condition' => [
					'_skin' => '',
				],
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
				'condition' => [
					'_skin' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_box_section_controls() {
		$this->start_controls_section(
			'section_design_box',
			[
				'label' => __( 'Box', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
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
					'{{WRAPPER}} .elementor-event__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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

	protected function register_design_image_section_controls() {
		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
					'show_thumbnail!' => '',
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'bearsthemes-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-event__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .elementor-event__thumbnail img',
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
				'selector' => '{{WRAPPER}} .elementor-event:hover .elementor-event__thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
			'heading_title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_title!' => '',
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
					'show_title!' => '',
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
					'show_title!' => '',
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
					'show_title!' => '',
				],
			]
		);

		$this->add_control(
			'heading_meta_style',
			[
				'label' => __( 'Meta Data', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_meta!' => '',
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
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_space_between',
			[
				'label' => __( 'Space Between', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-event__meta li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__meta li',
				'condition' => [
					'show_meta!' => '',
				],
			]
		);

		$this->add_control(
			'heading_excerpt_style',
			[
				'label' => __( 'Excerpt', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_excerpt!' => '',
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
					'{{WRAPPER}} .elementor-event__excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__excerpt',
				'condition' => [
					'show_excerpt!' => '',
				],
			]
		);

		$this->add_control(
			'heading_cost_style',
			[
				'label' => __( 'Cost', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_cost!' => '',
				],
			]
		);

		$this->add_control(
			'cost_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-event__cost' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cost!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cost_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .elementor-event__cost',
				'condition' => [
					'show_cost!' => '',
				],
			]
		);

		$this->add_control(
			'heading_read_more_style',
			[
				'label' => __( 'Read More', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_read_more!' => '',
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
					'show_read_more!' => '',
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
					'show_read_more!' => '',
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
					'show_read_more!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_design_pagination_section_controls() {
		$this->start_controls_section(
			'section_design_pagination',
			[
				'label' => __( 'Pagination', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_alignment',
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
					'{{WRAPPER}} .elementor-pagination' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_size',
			[
				'label' => __( 'Size', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 45,
				],
				'tablet_default' => [
					'size' => 45,
				],
				'mobile_default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers' => 'line-height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_border_color',
			[
				'label' => __( 'Border Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers:not(:last-child)' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'label' => __( 'Typography', 'bearsthemes-addons' ),
				'selector' => '{{WRAPPER}} .elementor-pagination .nav-links .page-numbers',
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_navigation' );

		$this->start_controls_tab(
			'tabs_pagination_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_background',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_pagination_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers.current' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers:hover svg' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->add_control(
			'pagination_background_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elementor-pagination .nav-links .page-numbers.current' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_controls() {

		$this->register_layout_section_controls();
		$this->register_query_section_controls();
		$this->register_pagination_section_controls();

		$this->register_design_latyout_section_controls();
		$this->register_design_box_section_controls();
		$this->register_design_image_section_controls();
		$this->register_design_content_section_controls();
		$this->register_design_pagination_section_controls();

	}

	public function get_instance_value_skin( $key ) {
		$settings = $this->get_settings_for_display();

		if( '' !== $settings['_skin'] && isset( $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key] ) ) {
			 return $settings[str_replace( '-', '_', $settings['_skin'] ) . '_' . $key];
		}
		return $settings[$key];
	}

	public function query_posts() {
		$settings = $this->get_settings_for_display();

		if( is_front_page() ) {
	    $paged = (get_query_var('page')) ? absint( get_query_var('page') ) : 1;
		} else {
	    $paged = (get_query_var('paged')) ? absint( get_query_var('paged') ) : 1;
		}

		$args = [
			'post_type' => 'tribe_events',
			'posts_per_page' => $this->get_instance_value_skin('posts_per_page'),
			'paged' => $paged,

		];

		if('event_start_date' == $settings['orderby']) {
			$args['orderby'] = 'meta_value';
			$args['meta_key'] = '_EventStartDate';
		} else {
			$args['orderby'] = $settings['orderby'];
			$args['order'] = $settings['order'];
		}

		$meta_query = array();

		$event_start_date = $settings['event_start_date'];
		$event_end_date = $settings['event_end_date'];

		if( '' !== $settings['coming_soon'] ) {
			$event_start_date = date('Y-m-d h:i:s');
			$event_end_date = '';
		}

		if( $event_start_date ) {
			$meta_query[] = array(
				'key' => '_EventStartDate',
				'value' => $event_start_date,
				'compare' => '>=',
			);
		}

		if( $event_end_date ) {
			$meta_query[] = array(
				'key' => '_EventEndDate',
				'value' => $event_end_date,
				'compare' => '<=',
			);
		}

		if( $settings['venue'] ) {
			$meta_query[] = array(
				'key' => '_EventVenueID',
				'value' => $settings['venue'],
				'operator'  => 'IN'
			);
		}

		if( $settings['organizer'] ) {
			$meta_query[] = array(
				'key' => '_EventOrganizerID',
				'value' => $settings['organizer'],
				'operator'  => 'IN'
			);
		}

		if( $settings['venue_exclude'] ) {
			$meta_query[] = array(
				'key' => '_EventVenueID',
				'value' => $settings['venue_exclude'],
				'operator'  => 'NOT IN'
			);
		}

		if( $settings['organizer_exclude'] ) {
			$meta_query[] = array(
				'key' => '_EventOrganizerID',
				'value' => $settings['organizer_exclude'],
				'operator'  => 'NOT IN'
			);
		}

		if( ! empty( $meta_query ) ) {
			$meta_query['relation'] = 'AND';
			$args['meta_query'] = $meta_query;
		}

		if( ! empty( $settings['ids'] ) ) {
			$args['post__in'] = $settings['ids'];
		}

		if( ! empty( $settings['ids_exclude'] ) ) {
			$args['post__not_in'] = $settings['ids_exclude'];
		}

		if( ! empty( $settings['category'] ) ) {
			$args['tax_query'] = array(
        array(
            'taxonomy' => 'tribe_events_cat',
            'field'    => 'term_id',
            'terms'    => $settings['category'],
        ),
    	);
		}

		if( ! empty( $settings['category_exclude'] ) ) {
			$args['tax_query'] = array(
        array(
            'taxonomy' => 'tribe_events_cat',
            'field'    => 'term_id',
            'terms'    => $settings['category_exclude'],
						'operator' => 'NOT IN',
        ),
    	);
		}

		if( 0 !== absint( $settings['offset'] ) ) {
			$args['offset'] = $settings['offset'];
		}

		return $query = new \WP_Query( $args );
	}

	public function pagination() {
		$settings = $this->get_settings_for_display();

		if ( '' === $settings['pagination'] ) {
			return;
		}

		$query = $this->query_posts();

		if ( ! $query->found_posts ) {
			return;
		}

		?>
		<nav class="elementor-pagination" role="navigation">
			<div class="nav-links">
				<?php
					$big = 999999999;

					if( is_front_page() ) {
						$current = max( 1, get_query_var('page') );
					} else {
						$current = max( 1, get_query_var('paged') );
					}

					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => $current,
						'total' => $query->max_num_pages,
						'mid_size'  => 2,
						'prev_next' => 'both' === $settings['pagination'] ? true : false,
						'prev_text' => '<svg class="svg-icon" width="12" height="12" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 443.52 443.52" style="enable-background:new 0 0 443.52 443.52;" xml:space="preserve"><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8    c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712    L143.492,221.863z"></path></svg>' . __( 'Prev', 'bearsthemes-addons' ),
						'next_text' => __( 'Next', 'bearsthemes-addons' ) . '<svg class="svg-icon" width="12" height="12" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 443.52 443.52" style="enable-background:new 0 0 443.52 443.52;" xml:space="preserve"><path d="M336.226,209.591l-204.8-204.8c-6.78-6.548-17.584-6.36-24.132,0.42c-6.388,6.614-6.388,17.099,0,23.712l192.734,192.734    		L107.294,414.391c-6.663,6.664-6.663,17.468,0,24.132c6.665,6.663,17.468,6.663,24.132,0l204.8-204.8    C342.889,227.058,342.889,216.255,336.226,209.591z"></path></svg>',
					) );
				?>
			</div>
		</nav>
		<?php
	}

	public function render_filter() {
		if( 'yes' !== $this->get_instance_value_skin('show_filter') ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$classes = 'elementor-filter-wrap';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-events--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-events--default';
		}

		$cats = $this->get_instance_value_skin('filter_category');

		if( !empty( $cats ) ) {
			?>
				<div class="<?php echo esc_attr( $classes ); ?>">
					<ul class="elementor-filter" data-type="event">
						<?php
							echo '<li>
										<a class="elementor-filter__link active" href="#" data-filter="all">' . esc_html__( 'All Events', 'bearsthemes-addons' ) . '</a>
									</li>';

							foreach ($cats as $key => $value) {
								$cat = get_term_by('id', $value, 'tribe_events_cat');

								echo '<li>
												<a class="elementor-filter__link" href="#" data-filter="' . esc_attr( $cat->slug ) . '">' . $cat->name . '</a>
											</li>';
							}
						?>
					</ul>
				</div>
			<?php
		}

	}

	public function render_loop_header() {
		$settings = $this->get_settings_for_display();

		$classes = 'elementor-grid';

		if( $settings['_skin'] ) {
			$classes .= ' elementor-events--' . $settings['_skin'];
		} else {
			$classes .= ' elementor-events--default';
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

	public function event_addres( $venue_id ) {

		if ( ! $venue_id ) {
			return;
		}

		$full_region = tribe_get_full_region( $venue_id );

		?>
		<span class="tribe-address">

		<?php
		// This location's street address.
		if ( tribe_get_address( $venue_id ) ) : ?>
		<span class="tribe-street-address"><?php echo tribe_get_address( $venue_id ); ?></span>
			<?php if ( ! tribe_is_venue() ) : ?>
				<br>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		// This locations's city.
		if ( tribe_get_city( $venue_id ) ) :
			if ( tribe_get_address( $venue_id ) ) : ?>
				<br>
			<?php endif; ?>
			<span class="tribe-locality"><?php echo tribe_get_city( $venue_id ); ?></span><span class="tribe-delimiter">,</span>
		<?php endif; ?>

		<?php
		// This location's abbreviated region. Full region name in the element title.
		if ( tribe_get_region( $venue_id ) ) : ?>
			<abbr class="tribe-region tribe-events-abbr" title="<?php esc_attr_e( $full_region ); ?>"><?php echo tribe_get_region( $venue_id ); ?></abbr>
		<?php endif; ?>

		<?php
		// This location's postal code.
		if ( tribe_get_zip( $venue_id ) ) : ?>
			<span class="tribe-postal-code"><?php echo tribe_get_zip( $venue_id ); ?></span>
		<?php endif; ?>

		<?php
		// This location's country.
		if ( tribe_get_country( $venue_id ) ) : ?>
			<span class="tribe-country-name"><?php echo tribe_get_country( $venue_id ); ?></span>
		<?php endif; ?>

		</span>
		<?php
	}

	public function filter_excerpt_length() {

		return $this->get_instance_value_skin('excerpt_length');
	}

	public function filter_excerpt_more() {

		return $this->get_instance_value_skin('excerpt_more');
	}

	protected function render_post() {
		$settings = $this->get_settings_for_display();

		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'elementor-event' ); ?>>
			<?php if( '' !== $settings['show_thumbnail'] ) { ?>
				<div class="elementor-event__thumbnail">
					<?php the_post_thumbnail( $settings['thumbnail_size'] ); ?>
				</div>
			<?php } ?>

			<div class="elementor-event__content">
				<?php
					if( '' !== $settings['show_title'] ) {
						the_title( '<h3 class="elementor-event__title"><a href="' . get_the_permalink() . '">', '</a></h3>' );
					}
				?>

				<?php if( '' !== $settings['show_meta'] ) { ?>
					<ul class="elementor-event__meta">
						<?php
							echo tribe_events_event_schedule_details( get_the_ID(), '<li>' . bearsthemes_addons_get_icon_svg( 'clock', 14 ), '</li>' );
								$venue_id = get_post_meta( get_the_ID(), '_EventVenueID', true);
								if( $venue_id ) {
									echo '<li>' . bearsthemes_addons_get_icon_svg( 'map-marker', 16 );
										$this->event_addres( $venue_id );
									echo '</li>';
								}
							?>
					</ul>
				<?php } ?>

				<?php if( '' !== $settings['show_excerpt'] ) { ?>
					<div class="elementor-event__excerpt">
						<?php echo wp_trim_words( get_the_excerpt(), $this->filter_excerpt_length(), $this->filter_excerpt_more() ); ?>
					</div>
				<?php } ?>

				<?php if ( tribe_get_cost() && '' !== $settings['show_cost'] ) : ?>
					<div class="elementor-event__cost"><?php echo tribe_get_cost( null, true ) ?></div>
				<?php endif; ?>

				<?php
					if( '' !== $settings['show_read_more'] ) {
						echo '<a class="elementor-event__read-more" href="' . get_the_permalink() . '">' . $settings['read_more_text'] . '</a>';
					}
				?>

			</div>
		</article>
		<?php
	}

	protected function render() {

		$query = $this->query_posts();

		if ( $query->have_posts() ) {

			$this->render_loop_header();

				while ( $query->have_posts() ) {
					$query->the_post();

					$this->render_post();

				}

			$this->render_loop_footer();

		} else {
		    // no posts found
		}

		$this->pagination();

		wp_reset_postdata();
	}

	protected function content_template() {

	}

}
