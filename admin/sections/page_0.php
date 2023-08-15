<?php

namespace saltw;

if ( ! defined( 'ABSPATH' ) ) { exit; }

// --------------------------------
//      --- Table Options ---
// --------------------------------

// ----------------------------------------------------------------------------
//  --- Cia. Address: PYME Info ---

// Añade registros suplementarios a la sección General de los Ajustes (Settings) del administrador:

function get_options_wu_principal()
{
	$settings = array(
		0 => array(
			'id'    => 'comercial',
			'label' => 'Nombre Comercial'
		),
        1 => array(
			'id' 	=> 'slogan',
			'label' => 'Eslogan'
		),
		2 => array(
			'id' 	=> 'legal',
			'label' => 'Nombre legal de la empresa'
		),
		3 => array(
			'id' 	=> 'direccion',
			'label' => 'Dirección (Calle, nº, Ciudad)'
		),
		4 => array(
			'id' 	=> 'cp_prov',
			'label' => 'Código Postal y provincia'
		),
		5 => array(
			'id' 	=> 'ciudad',
			'label' => 'Ciudad'
		),
		6 => array(
			'id' 	=> 'social',
			'label' => 'Domicilio Social'
		),
		7 => array(
			'id' 	=> 'cif',
			'label' => 'C.I.F.'
		),
		8 => array(
			'id' 	=> 'mercantil',
			'label' => 'Registro Mercantil'
		),
		9 => array(
			'id' 	=> 'tfno',
			'label' => 'Teléfono fijo'
		),
		10 => array(
			'id' 	=> 'fax',
			'label' => 'Número de fax'
		),
		11 => array(
			'id' 	=> 'movil1',
			'label' => 'Teléfono móvil principal'
		),
		12 => array(
			'id' 	=> 'movil2',
			'label' => 'Teléfono móvil 2'
		),
		13 => array(
			'id' 	=> 'movil3',
			'label' => 'Teléfono móvil 3'
		),
		14 => array(
			'id' 	=> 'email_principal',
			'label' => 'Correo principal'
		),
		15 => array(
			'id' 	=> 'email_2',
			'label' => 'Correo 2'
		),
		16 => array(
			'id' 	=> 'email_3',
			'label' => 'Correo 3'
		),
		17 => array(
			'id' 	=> 'email_4',
			'label' => 'Correo 4'
		),
        18 => array(
            'id' 	=> 'gtag',
            'label' => 'Google Analytics ID de Seguimiento de propiedad'
        ),
        19 => array(
            'id' 	=> 'googleverify',
            'label' => 'Google Webmaster Tools Código metaetiqueta'
        ),
        20 => array(
            'id' 	=> 'googlemaps',
            'label' => 'Google Maps API Key'
        ),
	);

	// Agregar prefijo a option_name

	$i = 0;
	foreach ( $settings as $anything )
	{
		$id = $settings[$i]['id'];
		$settings[$i]['id'] = WP_PREFIX_OPTIONS_MENU_PARENT . $id;
		$i++;
	}

	return $settings;
}


// --------------------------------
//      --- Page Section ---
// --------------------------------

function wu_section_principal()
{
	$settings 		= get_options_wu_principal();
	$section_slug 	= 'box_' . WP_PREFIX_OPTIONS_MENU_PARENT . 'principal';
	$section_title 	= 'Datos de Empresa';

	add_settings_section(
        // $id [string]         Required
		$section_slug,
        // $title [string]      Required
		$section_title,
        // $callback [callable] Required
		__NAMESPACE__ . '\settings_wu_section_principal_cb',
        // $page [string]       Required
		WU_MENU_PARENT
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
			__NAMESPACE__ . '\settings_field_wu_section_principal_cb',
        	// $page [string]       Required
			WU_MENU_PARENT,
        	// $section [string]    Default 'default'
			$section_slug,
        	// $args [array]    	Default array()
			array(
				$name
			)
		);

		// register_setting ( 'general', $name, 'esc_attr' );
		// register_setting ( 'options', $name, 'esc_attr' );
		register_setting (
        	// $option_group [string] Required
			WU_GROUP_PRINCIPAL,
        	// $option_name [string]  Required
			$name,
        	// $args [array]    	  Default array()
			$sanitize
		);
	}
}
add_action('admin_init', __NAMESPACE__ . '\wu_section_principal');


// ------------------------------
// 		--- Callbacks ---
// ------------------------------

// -------------------------------------------------
// 	--- function wu_section_principal() ---

// Section Callback
function settings_wu_section_principal_cb()
{
	$subtitle = 'Información de contacto y para las páginas legales';

	echo "<p>{$subtitle}</p>";
}

// Textbox Callback
function settings_field_wu_section_principal_cb( $args )
{
	$key = $args[0];
	$value = get_option( $key );
	$type = 'text';

	$input = "<input type='{$type}' id='{$key}' name='{$key}' value='{$value}' class='regular-{$type}'>";

	echo $input;
}
