<?php

/* =============================================================================================
❗️ IMPORTANT:
Replace all instances of the word 'themeslug' with your actual theme slug. Then remove this message.
============================================================================================= */

/**
 * Theme's functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/core-concepts/custom-functionality/
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */


/**
 * Gets the paths of some stylesheets.
 *
 * @return array An array of stylesheets URIs.
 */
function themeslug_get_stylesheets_paths() {
	return array(
		// Additional stylesheets.
		get_parent_theme_file_uri('assets/css/base.css'),
		get_parent_theme_file_uri('assets/css/layouts.css'),
		get_parent_theme_file_uri('assets/css/utility-classes.css'),
		get_parent_theme_file_uri('assets/css/gravity-forms.css'),
		// Active theme's style.css.
		get_stylesheet_uri()
	);
}


/**
 * Enqueues custom stylesheets on the front end of the website.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#front-end-stylesheets
 *
 * @return void
 */
function themeslug_enqueue_styles() {
	$css_paths = themeslug_get_stylesheets_paths();

	foreach ($css_paths as $path) {
		wp_enqueue_style(
			md5($path),
			$path,
			array(),
			wp_get_theme()->get('Version')
		);
	}
}
add_action('wp_enqueue_scripts', 'themeslug_enqueue_styles');


/**
 * Enqueues custom stylesheets in the Editor.
 *
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
 * @link https://developer.wordpress.org/themes/core-concepts/including-assets/#editor-stylesheets
 *
 * @return void
 */
function themeslug_editor_styles() {
	add_editor_style(themeslug_get_stylesheets_paths());
}
add_action('after_setup_theme', 'themeslug_editor_styles');


/**
 * Enqueues custom block stylesheets (on the front end and in the Editor).
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 * @link https://developer.wordpress.org/themes/features/block-stylesheets/
 *
 * @return void
 */
function themeslug_block_stylesheets() {
	// Adds the block name (with namespace prefix) for each style.
	$blocks = [
		'core/button',
		'core/navigation',
		'core/query-pagination',
		'core/site-logo',
	];

	// Loops through each block and enqueues its styles.
	foreach ($blocks as $block) {
		// Replaces slash with hyphen for filename.
		$block_slug = str_replace('/', '-', $block);

		// Relative path of block stylesheets.
		$blocks_path = "assets/css/blocks/{$block_slug}.css";

		wp_enqueue_block_style($block, array(
			'handle' => "themeslug-{$block_slug}",
			'src'    => get_theme_file_uri($blocks_path),
			'path'   => get_theme_file_path($blocks_path)
		));
	}
}
add_action('init', 'themeslug_block_stylesheets');


/**
 * Registers custom block style variations.
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 * @link https://developer.wordpress.org/themes/features/block-style-variations/
 *
 * @return void
 */
function themeslug_block_style_variations() {
	// register_block_style(
	// 	'core/_____',
	// 	array(
	// 		'name'         => '__________',
	// 		'label'        => __('__________', 'themeslug'),
	// 	)
	// );
}
add_action('init', 'themeslug_block_style_variations');
