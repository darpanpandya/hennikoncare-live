<?php
namespace BearsthemesAddons\Widgets\Base_Widget\Skins;

use Elementor\Widget_Base;
use Elementor\Skin_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Simple extends Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/be-base-widget/section_content/before_section_end', [ $this, 'register_controls' ] );

	}

	public function get_id() {
		return 'skin-simple';
	}


	public function get_title() {
		return __( 'Simple', 'bearsthemes-addons' );
	}


	public function register_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->add_control(
			'title_simple',
			[
				'label' => __( 'Title Simple', 'bearsthemes-addons' ),
				'type' => Controls_Manager::TEXT,
			]
		);
	}

	public function render() {
		$settings = $this->parent->get_settings();

		echo '<div class="title">';
		echo $settings['skin_simple_title_simple'];
		echo '</div>';

	}

	protected function content_template() {

	}

}
