<?php

namespace saltw;

if ( ! defined( 'ABSPATH' ) ) { exit; }


// -----------------------------------------------------------------------
// 		--- Eliminar todos los registros de la table options.php ---
// -----------------------------------------------------------------------

//  --- Borrar los datos de los registros en la tabla PREFIX_options
//  Durante las pruebas delete_option NO elimina los registros con valor vacío

function wu_delete_options_db( $options )
{
	// Dar valor a todos los registros
	$default_value = "--";
	foreach ($options as $option)
	{
      	update_option( $option['id'], $default_value );
	}

	// Eliminar los registros
    foreach ($options as $option)
    {
        if ( get_option($option['id'] ) )
        {
            delete_option($option['id']);
        }
    }
}
