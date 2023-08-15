<?php

namespace saltw;

// Comprueba que tienes permisos para acceder a esta pagina

// if ( ! current_user_can ('manage_options') ) {
//     wp_die (__ ('TU No tienes suficientes permisos para acceder a esta página.') );
// }

// ------------------------------------------------
//		--- Sección Ajustes > Tab Principal ---
// ------------------------------------------------

//  ---------------------------------------------------------------------
//      --- Salida HTML de las páginas de configuración del Plugin ---
//  ---------------------------------------------------------------------

/**
	* Salida HTML de la página de Principal del Plugin
	*
	* @since 4.0.0
*/

function do_page_Principal()
{
    ?>
    <article class="wrap">
        <header class="wu-admin-header">
            <h2 class="wu-title">Título del plugin</h2>
            <span class="cta">Subtítulo del plugin</span>
        </header>

        <form method="POST" action="options.php">

        <?php
            settings_fields( WU_GROUP_PRINCIPAL );

            do_settings_sections( WU_MENU_PARENT );

            // Add the submit button to serialize the options
            submit_button();

        ?>
            <!-- <input name="submit" class="button button-primary" type="submit" value="<php esc_attr_e( 'Save' ); ?>" /> -->
        </form>
    </article>

<?php }
