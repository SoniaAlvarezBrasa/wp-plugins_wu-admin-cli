<?php

namespace saltw;

if ( ! defined( 'ABSPATH' ) ) { exit; }

// --------------------------------
//      --- Table Options ---
// --------------------------------

// ----------------------------------------------------------------------------
//  --- Thumbnails -- RelationsShip category - thumbnail

function get_options_images_from_categories()
{
	$settings = array();
	$taxonomy = 'category';

    $terms = get_terms( array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false
    ) );

	if ( !empty( $terms ) )
    {
    	foreach( $terms as $category )
        {
    		// if( $category->parent == 0 )
			// {
				$settings[$category->term_id] = array(
					'id' 	=> WP_PREFIX_OPTIONS_PAGE_1 . $category->slug,
					'label' => $category->name
				);
			// }
		}
	}

	return $settings;
}


// ----------------------------------------------------------------------------
//  --- Thumbnails -- RelationsShip taf - thumbnail
// 		Exclude thumbnails asignados ya a categorias

function get_options_images_from_tags ()
{
	$settings = array();

    $categories = get_terms( array(
        'taxonomy'   => 'category',
        'hide_empty' => false
    ) );

	$exclude_cats = array();
	foreach ($categories as $cat )
	{
		$exclude_cats[] = $cat->slug;
	}

	$taxonomy = 'post_tag';
    $tags = get_terms( array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false
    ) );


	if ( !empty( $tags ) )
    {
    	foreach( $tags as $tag )
        {
			if( !in_array( $tag->slug, $exclude_cats ) )
			{
				$settings[$tag->term_id] = array(
					'id' 	=> WP_PREFIX_OPTIONS_PAGE_1 . $tag->slug,
					'label' => $tag->name
				);
			}
		}
	}

	return $settings;
}


// --------------------------------
//      --- Page Sections ---
// --------------------------------

// --------------------------------
//      --- Page 1 - Group 1 ---

function wu_section_page_1_fieldset_1()
{
	$settings      = get_options_images_from_categories();
	$section_slug  = 'box_' . WP_PREFIX_OPTIONS_PAGE_1 . 'fieldset_1';
	$section_title = 'Imágenes de Categorías';

	add_settings_section(
        // $id [string]         Required
		$section_slug,
        // $title [string]      Required
		$section_title,
        // $callback [callable] Required
		__NAMESPACE__ . '\settings_wu_section_page_1_fieldset_1_cb',
        // $page [string]       Required
		WU_MENU_PAGE_1
	);

	foreach ( $settings as $setting )
    {
        $name  	  = $setting['id'];
        $title 	  = $setting['label'];
        $sanitize = 'esc_attr';

		$label = "<label for='{$name}'>{$title}</label>";

		add_settings_field (
        	// $id [string]         Required
			$name,
        	// $title [string]      Required
			$label,
        	// $callback [callable] Required
			__NAMESPACE__ . '\settings_field_wu_section_page_1_fieldset_1_cb',
        	// $page [string]       Required
			WU_MENU_PAGE_1,
        	// $section [string]    Default 'default'
			$section_slug,
        	// $args [array]    	Default array()
			array(
				$name
			)
		);

		// register_setting ( 'general', $setting['id'], 'esc_attr' );
		// register_setting ( 'options', $setting['id'], 'esc_attr' );
		register_setting (
        	// $option_group [string] Required
			WU_GROUP_PAGE_1,
        	// $option_name [string]  Required
			$name,
        	// $args [array]    	  Default array()
			$sanitize
		);
	}
}
add_action( 'admin_init', __NAMESPACE__ . '\wu_section_page_1_fieldset_1' );


// --------------------------------
//      --- Page 1 - Group 2 ---

function wu_section_page_1_fieldset_2()
{
	$settings      = get_options_images_from_tags();
	$section_slug  = 'box_' . WP_PREFIX_OPTIONS_PAGE_1 . 'fieldset_2';
	$section_title = 'Imágenes de Etiquetas';

	add_settings_section(
        // $id [string]         Required
		$section_slug,
        // $title [string]      Required
		$section_title,
        // $callback [callable] Required
		__NAMESPACE__ . '\settings_wu_section_page_1_fieldset_2_cb',
        // $page [string]       Required
		WU_MENU_PAGE_1
	);

	foreach ( $settings as $setting )
    {
        $name  	  = $setting['id'];
        $title 	  = $setting['label'];
        $sanitize = 'esc_attr';

		$label = "<label for='{$name}'>{$title}</label>";

		add_settings_field (
        	// $id [string]         Required
			$name,
        	// $title [string]      Required
			$label,
        	// $callback [callable] Required
			__NAMESPACE__ . '\settings_field_wu_section_page_1_fieldset_2_cb',
        	// $page [string]       Required
			WU_MENU_PAGE_1,
        	// $section [string]    Default 'default'
			$section_slug,
        	// $args [array]    	Default array()
			array(
				$name
			)
		);

		// register_setting ( 'general', $setting['id'], 'esc_attr' );
		// register_setting ( 'options', $setting['id'], 'esc_attr' );
		register_setting (
        	// $option_group [string] Required
			WU_GROUP_PAGE_1,
        	// $option_name [string]  Required
			$name,
        	// $args [array]    	  Default array()
			$sanitize
		);
	}
}
add_action( 'admin_init', __NAMESPACE__ . '\wu_section_page_1_fieldset_2' );


// --------------------------------
// 		--- Callbacks ---
// --------------------------------

// --------------------------------
//      --- Page 1 - Group 1 ---

// Section Callback
function settings_wu_section_page_1_fieldset_1_cb ()
{
    $subtitle = 'Imágenes de portada de Categorías';

	echo "<p>{$subtitle}</p>";
}

// Textbox Callback
function settings_field_wu_section_page_1_fieldset_1_cb( $args )
{
	$key = $args[0];
	$value = get_option( $key );
	$type = 'number';

	$input = "<input type='{$type}' id='{$key}' name='{$key}' value='{$value}' class='regular-{$type}'>";

    // echo '<input type="number" id="'. $key .'" name="'. $key .'" value="' . $value . '" class="regular-number" />';

	// Muestra de la imagen guardada

	if( !empty( $value ) && $value != NULL )
    {
		$image = $value ;
	}
	else {
		$image = null;
	}

	echo $input;
	echo wp_get_attachment_image( $image );
}


// --------------------------------
//      --- Page 1 - Group 2 ---

// Section Callback
function settings_wu_section_page_1_fieldset_2_cb ()
{
    $subtitle = 'Imágenes de portada de Etiquetas';

	echo "<p>{$subtitle}</p>";
}

// Textbox Callback
function settings_field_wu_section_page_1_fieldset_2_cb( $args )
{
	$key = $args[0];
	$value = get_option( $key );
	$type = 'number';

	$input = "<input type='{$type}' id='{$key}' name='{$key}' value='{$value}' class='regular-{$type}'>";

	// Muestra de la imagen guardada

	if( !empty( $value ) && $value != NULL )
    {
		$image = $value ;
	}
	else {
		$image = null;
	}

	echo $input;
	echo wp_get_attachment_image( $image );
}
