<?php
/**
 * Custom elementor
 *
 * @package Bearsthemes
 */

// Heading
add_action( 'elementor/element/heading/section_title/after_section_end', function( $element, $args ) {

  $element->start_controls_section(
		'heading_custom_section',
		[
			'label' => __( 'Custom', 'bearsthemes-addons' ),
		]
	);

	$element->add_responsive_control(
		'heading_max_width',
		[
			'type' => \Elementor\Controls_Manager::SLIDER,
			'label' => __( 'Max Width', 'bearsthemes-addons' ),
      'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
					'step' => 5,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
      'default' => [
				'unit' => '%',
				'size' => 100,
			],
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => 'max-width: {{SIZE}}{{UNIT}};',
      ],
		]
	);

  $element->add_responsive_control(
		'heading_auto_left',
		[
			'label' => __( 'Auto Left', 'bearsthemes-addons' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'bearsthemes-addons' ),
			'label_off' => __( 'Off', 'bearsthemes-addons' ),
			'return_value' => 'auto',
			'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => 'margin-left: {{VALUE}};',
      ],
		]
	);

  $element->add_responsive_control(
		'heading_auto_right',
		[
			'label' => __( 'Auto Right', 'bearsthemes-addons' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'bearsthemes-addons' ),
			'label_off' => __( 'Off', 'bearsthemes-addons' ),
			'return_value' => 'auto',
			'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-heading-title' => 'margin-right: {{VALUE}};',
      ],
		]
	);

  $element->end_controls_section();

}, 10, 2 );

//Text Editor
add_action( 'elementor/element/text-editor/section_editor/after_section_end', function( $element, $args ) {

  $element->start_controls_section(
		'text_editor_custom_section',
		[
			'label' => __( 'Custom', 'bearsthemes-addons' ),
		]
	);

	$element->add_responsive_control(
		'text_editor_max_width',
		[
			'type' => \Elementor\Controls_Manager::SLIDER,
			'label' => __( 'Max Width', 'bearsthemes-addons' ),
      'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
					'step' => 5,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
      'default' => [
				'unit' => '%',
				'size' => 100,
			],
      'selectors' => [
        '{{WRAPPER}} .elementor-widget-container > *' => 'max-width: {{SIZE}}{{UNIT}};',
      ],
		]
	);

  $element->add_responsive_control(
		'text_editor_auto_left',
		[
			'label' => __( 'Auto Left', 'bearsthemes-addons' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'bearsthemes-addons' ),
			'label_off' => __( 'Off', 'bearsthemes-addons' ),
			'return_value' => 'auto',
			'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-widget-container > *' => 'margin-left: {{VALUE}};',
      ],
		]
	);

  $element->add_responsive_control(
		'text_editor_auto_right',
		[
			'label' => __( 'Auto Right', 'bearsthemes-addons' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => __( 'On', 'bearsthemes-addons' ),
			'label_off' => __( 'Off', 'bearsthemes-addons' ),
			'return_value' => 'auto',
			'default' => '',
      'selectors' => [
        '{{WRAPPER}} .elementor-widget-container > *' => 'margin-right: {{VALUE}};',
      ],
		]
	);

  $element->end_controls_section();

}, 10, 2 );

// Button
add_action( 'elementor/element/button/section_button/after_section_end', function( $element, $args ) {

  $element->start_controls_section(
		'button_custom_section',
		[
			'label' => __( 'Custom', 'bearsthemes-addons' ),
		]
	);

	$element->add_responsive_control(
		'button_min_width',
		[
			'type' => \Elementor\Controls_Manager::SLIDER,
			'label' => __( 'Min Width', 'bearsthemes-addons' ),
      'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
					'step' => 5,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
			],
      'selectors' => [
        '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
      ],
		]
	);

  $element->end_controls_section();

}, 10, 2 );

// Slides
add_action( 'elementor/element/slides/section_slides/before_section_end', function( $element, $args ) {

  $element->add_responsive_control(
		'slides_content_width',
		[
			'type' => \Elementor\Controls_Manager::SLIDER,
			'label' => __( 'Content Width', 'bearsthemes-addons' ),
      'size_units' => [ 'px', '%' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 2000,
					'step' => 5,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
        'default' => [
					'unit' => '%',
					'size' => 100,
				],
			],
      'selectors' => [
        '{{WRAPPER}} .swiper-slide-inner' => 'max-width: {{SIZE}}{{UNIT}};',
      ],
		]
	);

}, 10, 2 );
