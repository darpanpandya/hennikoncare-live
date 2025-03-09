<?php
/**
 * SVG icons related functions
 *
 */

/**
 * Gets the SVG code for a given icon.
 */
function bearsthemes_addons_get_icon_svg( $icon, $size = 24 ) {
	return BearsthemesAddons_SVG_Icons::get_svg( 'ui', $icon, $size );
}

/**
 * Gets the SVG code for a given social icon.
 */
function bearsthemes_addons_get_social_icon_svg( $icon, $size = 24 ) {
	return BearsthemesAddons_SVG_Icons::get_svg( 'social', $icon, $size );
}
