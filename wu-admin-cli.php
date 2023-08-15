<?php
/*
    Plugin Name: Admin CLI
    Description: Administración back-end y visión general del sitio web
    Plugin Dependencies: Site Plugins
    Author: Sonia Álvarez
    Version: 1.0.1
    License: MIT
*/

namespace saltw;

defined( 'ABSPATH' ) or die ( "Marcho que teño que marchar!" );


/**
    * Include constants and Options definitions
*/
include_once dirname( __FILE__ ) . '/constants.php';


/**
    * Load the plugin's text domain.
*/

function load_text_domain() {

    load_plugin_textdomain( WU_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\load_text_domain' );


/**
    * Includes required files and initializes the plugin.
*/

function init() {
    include_once dirname( __FILE__ ) . '/admin/menu.php';
    include_once dirname( __FILE__ ) . '/admin/sections/page_0.php';
    include_once dirname( __FILE__ ) . '/admin/sections/page_1.php';
    include_once dirname( __FILE__ ) . '/admin/options.php';
    // include_once dirname( __FILE__ ) . '/inc/functions.php';
    include_once dirname( __FILE__ ) . '/views/principal.php';
    include_once dirname( __FILE__ ) . '/views/thumbnails.php';

    // All done
    do_action( __NAMESPACE__ . '_loaded' );
}
add_action('plugins_loaded', __NAMESPACE__ . '\init');



function register_scripts() {

	// We need this on all pages
	wp_enqueue_style( WU_MENU_PAGE_1, asset( 'css/thumbnails.css' ), null);

	// wp_register_script( __NAMESPACE__, asset( 'js/script.js' ), array( 'jquery' ), VERSION );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\register_scripts' );


function activate()
{
    // init();

    include_once dirname( __FILE__ ) . '/inc/tables.php';

    foreach ( get_plugin_tables() as $table )
    {
        sabrinsky_create_table ( $table );

        // flush_rewrite_rules();
    }

    // flush_rewrite_rules();

    // register_team_member_post_type();
    // register_team_member_position_taxonomy();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\activate' );


function deactivate()
{
    init();

    // WHILE tests DEV
    // wu_delete_options_db( get_options_wu_principal() );
    // wu_delete_options_db( get_options_images_from_categories() );
    // wu_delete_options_db( get_options_images_from_tags () );

    // register_team_member_post_type();
    // register_team_member_position_taxonomy();

    include_once dirname( __FILE__ ) . '/inc/tables.php';
    $tables = get_plugin_tables();
    sabrinsky_drop_tables ( $tables );

    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate' );


//  --------------------------------
//      --- function asset() ---
//  --------------------------------

/**
    * Obtener la ruta a un archivo de recursos.
    *
    * @param string  $path
    * @return string $base Ruta al contenedor del archivo de recurso
    * @since 4.0.0
*/
function asset( $path = '', $url = true )
{
    if( $url )
    {
        $file = trailingslashit( plugin_dir_url( __FILE__ ) );
    } else {
        $file =  trailingslashit( plugin_dir_path( __FILE__ ) );
    }

    $base = $file . 'assets/' . ltrim( $path, '/' );

    return $base;
}


//  ----------------------------------
//  ----     CUSTOM DASHBOARD 	---
//  ----------------------------------


// ----------------------------------------------------------------------------
//	--- PLUGIN WORDPRESS SEO ( YOAST SEO ) ---
// ----------------------------------------------------------------------------


//  ----------------------------------------------
//  ----     CUSTOM MEDIA TAXONOMIES     ---
//  ----------------------------------------------
