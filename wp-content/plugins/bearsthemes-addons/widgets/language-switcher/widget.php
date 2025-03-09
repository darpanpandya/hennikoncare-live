<?php
namespace BearsthemesAddons\Widgets\Language_Switcher;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Be_Language_Switcher extends Widget_Base {

	public function get_name() {
		return 'be-language-switcher';
	}

	public function get_title() {
		return __( 'Be Language Switcher', 'bearsthemes-addons' );
	}

	public function get_icon() {
		return 'eicon-select';
	}

	public function get_categories() {
		return [ 'bearsthemes-addons' ];
	}

  protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_country', [
				'label' => __( 'Country', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'en',
        'options' => [
					'en' => esc_html__( 'English', 'bearsthemes-addons' ),
					'fr' => esc_html__( 'France', 'bearsthemes-addons' ),
					'es' => esc_html__( 'Spanish', 'bearsthemes-addons' ),
					'de' => esc_html__( 'German', 'bearsthemes-addons' ),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Language', 'bearsthemes-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_country' => 'en',
					],
          [
						'list_country' => 'fr',
					],
          [
						'list_country' => 'es',
					],
          [
						'list_country' => 'de',
					],
				],
				'title_field' => '{{{ list_country }}}',
			]
		);

		$this->end_controls_section();
	}

  protected function register_design_layout_section_controls() {

    $this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'heading_current_country_style',
			[
				'label' => __( 'Current Country', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'curent_country_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language.current' => 'color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'curent_country_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language.current' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'curent_country_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .menu-item-language.current',
			]
		);

    $this->add_control(
			'curent_country_min_height',
			[
				'label' => __( 'Min Height', 'bearsthemes-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-item-language.current > a' => 'min-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

    $this->add_control(
			'heading_list_country_style',
			[
				'label' => __( 'List Country', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

    $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_country_box_shadow',
				'selector' => '{{WRAPPER}} .sub-menu',
			]
		);

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_country_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .menu-item-language:not(.current)',
			]
		);

    $this->start_controls_tabs( 'country_effects_tabs' );

		$this->start_controls_tab( 'classic_style_normal',
			[
				'label' => __( 'Normal', 'bearsthemes-addons' ),
			]
		);

    $this->add_control(
			'list_country_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language:not(.current)' => 'color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'list_country_bg_color',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language:not(.current)' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_tab();

		$this->start_controls_tab( 'classic_style_hover',
			[
				'label' => __( 'Hover', 'bearsthemes-addons' ),
			]
		);

    $this->add_control(
			'list_country_color_hover',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language:not(.current):hover' => 'color: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'list_country_bg_color_hover',
			[
				'label' => __( 'Background Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .menu-item-language:not(.current):hover' => 'background-color: {{VALUE}};',
				],
			]
		);

    $this->end_controls_tab();

    $this->end_controls_section();
  }

	protected function register_controls() {
    $this->register_layout_section_controls();
    $this->register_design_layout_section_controls();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

    if ( empty( $settings['list'] ) ) {
			return;
		}

    $list_country = array(
      'en' => esc_html__( 'English', 'bearsthemes-addons' ),
      'fr' => esc_html__( 'France', 'bearsthemes-addons' ),
      'es' => esc_html__( 'Spanish', 'bearsthemes-addons' ),
      'de' => esc_html__( 'German', 'bearsthemes-addons' ),
    );

    $currentItem = array();
    $listItem = array();

    foreach ($settings['list'] as $index => $item) {
      if($index == 0) {
        $currentItem[$item['list_country']] = $list_country[$item['list_country']];
      } else {
        $listItem[$item['list_country']] = $list_country[$item['list_country']];
      }
    }

		?>
    <ul class="elementor-language-switcher">
      <li class="menu-item-language current">
        <?php foreach ($currentItem as $key => $value) { ?>
          <a href="<?php echo '#' . $key;  ?>">
            <?php
              echo '<img src="'. plugin_dir_url( __DIR__ ) . 'language-switcher/flags/' . $key . '.png" alt="' . $value . '">';
              echo '<span>' . $value . '</span>';
              echo bearsthemes_addons_get_icon_svg( 'chevron-down', 14 );
            ?>
          </a>
        <?php } ?>
        <ul class="sub-menu">
          <?php foreach ($listItem as $key => $value) { ?>
            <li class="menu-item-language">
              <a href="<?php echo '#'.$key;  ?>">
                <?php
                  echo '<img src="'. plugin_dir_url( __DIR__ ) . 'language-switcher/flags/' . $key . '.png" alt="' . $value . '">';
                  echo '<span>' . $value . '</span>';
                ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </li>
    </ul>
    <?php
	}

	protected function content_template() {

	}
}
