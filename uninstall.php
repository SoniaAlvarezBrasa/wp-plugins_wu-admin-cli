<?php

namespace saltw;

// if uninstall.php is not called by WordPress, die

if( !defined('WP_UNINSTALL_PLUGIN') ) { die; }

include_once dirname( __FILE__ ) . '/constants.php';
include_once dirname( __FILE__ ) . '/admin/options.php';
// include_once dirname( __FILE__ ) . '/inc/tables.php';

// Eliminar registro de WP_OPTIONS
wu_delete_options_db( get_options_wu_principal() );
wu_delete_options_db( get_options_images_from_categories() );
wu_delete_options_db( get_options_images_from_tags () );

// Eliminar transients del plugin
// Eliminar eventos cron del plugin
// ..etc., basado en lo que haya que eliminar


// Borrar tablas de la base de datos
// Borrar transients del plugin
// Borrar eventos Cron
// Borrar entradas y páginas
// Borrar tipos de contenido personalizados (CPTs)
// Borrar user meta
// Borrar post meta
//      Limitar el borrado de metas a un CPT
