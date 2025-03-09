<?php
namespace AIOSEO\Plugin\Common\Schema\Graphs\WebPage;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MedicalWebPage graph class.
 *
 * @since 4.6.4
 */
class MedicalWebPage extends WebPage {
	/**
	 * The graph type.
	 *
	 * This value can be overridden by WebPage child graphs that are more specific.
	 *
	 * @since 4.6.4
	 *
	 * @var string
	 */
	protected $type = 'MedicalWebPage';
}