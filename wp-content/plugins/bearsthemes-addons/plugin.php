<?php
namespace BearsthemesAddons;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public $widgets = array();
	public $woocommerce_status = false;
	public $give_status = false;
	public $events_status = false;
	public $sermone_status = true;
	public $ubermenu_status = false;

	public function woocommerce_status() {

		if ( class_exists( 'WooCommerce' ) ) {
			$this->woocommerce_status = true;
		}

		return $this->woocommerce_status;
	}

	public function give_status() {

		if ( class_exists( 'Give' ) ) {
			$this->give_status = true;
		}

		return $this->give_status;
	}

	public function ubermenu_status() {

		if ( class_exists( 'UberMenu' ) ) {
			$this->ubermenu_status = true;
		}

		return $this->ubermenu_status;
	}

	public function events_status() {

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$this->events_status = true;
		}

		return $this->events_status;
	}

	public function sermone_status() {

		if ( defined('SERMONE_VER') ) {
			$this->sermone_status = true;
		}

		return $this->sermone_status;
	}

	public function widgets_list() {

		$this->widgets = array(
			'icon-box',
			'image-box',
			'video-play-button',
			'video-box',
			'counter',
			'countdown',
			'pie-chart',
			'language-switcher',
			'base-carousel',
			'logo-carousel',
			'testimonial-carousel',
			'testimonial-special',
			'posts',
			'recent-posts',
			'posts-carousel',
			'members',
			'members-carousel',
			'projects',
			'projects-carousel',

		);

		// WooCommerce.
		if ( $this->woocommerce_status() ) {

 			$this->widgets = array_merge(
 				$this->widgets, array(
 					'products',
					'products-carousel',

 				)
 			);

		}

		// ubermenu.
		if ( $this->ubermenu_status() ) {

			$this->widgets = array_merge(
				$this->widgets, array(
					'uber-menu',
				)
			);

		}

		// Give.
		if ( $this->give_status() ) {
		  require_once( __DIR__ . '/widgets/gives-function.php' );

 			$this->widgets = array_merge(
 				$this->widgets, array(
 					'give-totals',
					'give-form',
					'give-form-button',
 					'give-forms',
 					'give-forms-carousel',
					'donors',
					'donors-carousel',
					'sponsors',

 				)
 			);

		}

		// Tribe Events.
		if ( $this->events_status() ) {
			require_once( __DIR__ . '/widgets/events-function.php' );

			$this->widgets = array_merge(
				$this->widgets, array(
					'events',
					'events-carousel',

				)
			);

		}

		// Sermone.
		if ( $this->sermone_status() ) {
			$this->widgets = array_merge(
				$this->widgets, array(
					'sermone',
					'sermone-carousel',

				)
			);

		}

		return $this->widgets;
	}

	/**
	 * widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_styles() {

	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'jquery-magnific-popup', plugins_url( '/assets/js/jquery.magnific-popup.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'jquery-progressbar', plugins_url( '/assets/js/progressbar.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'jquery-countdown-plugin', plugins_url( '/assets/js/jquery.countdown-plugin.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'jquery-countdown', plugins_url( '/assets/js/jquery.countdown.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'bearsthemes-addons', plugins_url( '/assets/js/frontend.js', __FILE__ ), [ 'jquery' ], false, true );

	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {

		foreach( $this->widgets_list() as $widget ) {
			require_once( __DIR__ . '/widgets/'. $widget .'/widget.php' );

			foreach( glob( __DIR__ . '/widgets/'. $widget .'/skins/*.php') as $filepath ) {
				include $filepath;
			}
		}

	}

	/**
	 * Register Category
	 *
	 * Register new Elementor category.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'bearsthemes-addons',
			[
				'title' => esc_html__( 'Bearsthemes Addons', 'bearsthemes-addons' )
			]
		);
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Icon_Box\Be_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Image_Box\Be_Image_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Video_Play_Button\Be_Video_Play_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Video_Box\Be_Video_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Counter\Be_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\CountDown\Be_CountDown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Pie_Chart\Be_Pie_Chart() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Language_Switcher\Be_Language_Switcher() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Base_Carousel\Be_Base_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Logo_Carousel\Be_Logo_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_Carousel\Be_Testimonial_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Testimonial_Special\Be_Testimonial_Special() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Posts\Be_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Recent_Posts\Be_Recent_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Posts_Carousel\Be_Posts_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Members\Be_Members() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Members_Carousel\Be_Members_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Projects\Be_Projects() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Projects_Carousel\Be_Projects_Carousel() );

		// WooCommerce.
		if ( $this->woocommerce_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products\Be_Products() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Products_Carousel\Be_Products_Carousel() );

		}

		// ubermenu.
		if ( $this->ubermenu_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Uber_Menu\Be_Uber_Menu() );

		}

		// Give.
		if ( $this->give_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Give_Totals\Be_Give_Totals() );

			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Give_Form\Be_Give_Form() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Give_Forms\Be_Give_Forms() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Give_Forms_Carousel\Be_Give_Forms_Carousel() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Donors\Be_Donors() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Donors_Carousel\Be_Donors_Carousel() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Give_Form_Button\Be_Give_Form_Button() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Sponsors\Be_Sponsors() );

		}

		// Tribe Events.
		if ( $this->events_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Events\Be_Events() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Events_Carousel\Be_Events_Carousel() );

		}

		// Sermone.
		if ( $this->sermone_status() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Sermone\Be_Sermone() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Sermone_Carousel\Be_Sermone_Carousel() );

		}

	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Register widget styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

	}
}

// Instantiate Plugin Class
Plugin::instance();
