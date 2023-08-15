<?php

namespace saltw;

// if ( ! current_user_can ('manage_options') ) {
//     wp_die (__ ('TU No tienes suficientes permisos para acceder a esta página.') );
// }

/**
	* Salida HTML de la página de Thumbnails del Plugin
	*
	* @since 4.0.0
*/
function do_page_Thumbnails()
{
    ?>
    <article class="wu-admin-cli thumbnails wrap">
        <header class="wu-admin-header">
            <h2 class="wu-title">Título del Submenú 1</h2>
            <span class="cta">Subtítulo del Submenu</span>
        </header>

        <!-- <form method="POST" action="?page=<= __NAMESPACE__ . '-thumbnails'?>"> -->
        <form method="POST" class="thumbnails" action="options.php">

        <?php
            // settings_fields( 'options_' . PLUGIN_NAME . '_thumbnails' );
            settings_fields( WU_GROUP_PAGE_1 );

            // do_settings_sections( __NAMESPACE__ . '-thumbnails' );
            do_settings_sections( WU_MENU_PAGE_1 );

            // Add the submit button to serialize the options
            submit_button();

        ?>
            <!-- <input name="submit" class="button button-primary" type="submit" value="<php esc_attr_e( 'Save' ); ?>" /> -->
        </form>
    </article>

<?php } ?>


<?php

function do_page_Thumbnails_ul()
{
    echo '<h1>Contenido del Submenú 1</h1>';

    echo do_page_Thumbnails_list();


} ?>


<?php

function do_page_Thumbnails_list()
{

    $taxonomy = 'category';

    $terms = get_terms( array(
        // 'taxonomy'   => 'post_tag',
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ) );

    $output = NULL;

    if ( !empty( $terms ) )
    {
    	$output = '<ul style="margin-left: 1em;">';
    	foreach( $terms as $category )
        {
            $archive_post_id = NULL;
    		if( $category->parent == 0 )
            {
    			$output.= '<li>'
                    . '<strong style="border-bottom: 1px solid;">'
                        . esc_attr( $category->name ) . '</strong>'
                    . '<strong> Cat ID: </strong>' . esc_attr( $category->term_id);

    	        $li = '<ul style="margin: 1em;">';

    			foreach( $terms as $subcategory )
                {
    				if( $subcategory->parent == $category->term_id )
                    {
$li .= '<li>'
        . '<strong style="border-bottom: 1px solid;">'
            . esc_html( $subcategory->name )
        . '</strong>'

        . '<ul style="margin-left: 1em">'

            . '<li>'
                . '<strong>Cat ID: </strong>'
                . '<span>' . esc_html( $subcategory->term_id) . '</span>'
            . '</li>'

            . '<li>'
                . '<strong>Slug: </strong>'
                . '<span>' . esc_html( $subcategory->slug ) . '</span>'
            . '</li>'
        . '</ul>'
    .'</li>';
    				}
    			}
                $li .= '</ul>';

    			$output .= $li . '</li>';
    		}
    	}

    	$output.='</ul>';

    }

    return $output;
}

function do_page_Thumbnails_list_morto()
{

    $taxonomy = 'category';

    $terms = get_terms( array(
        // 'taxonomy'   => 'post_tag',
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ) );

    $output = NULL;

    if ( !empty( $terms ) )
    {
    	$output = '<ul style="margin-left: 1em;">';
    	foreach( $terms as $category )
        {
            $archive_post_id = NULL;
    		if( $category->parent == 0 )
            {
                $archive_post_id = do_strong_id(
                    get_ID_page_archive_taxonomy_slug ( $category->slug )
                );
$cat = get_term_by('slug', $category->slug, 'category');
$category_archive_page_id = get_term_meta( $cat->term_id );

                $pre = '<pre>'
                    . the_claves_arreglo($category_archive_page_id, 'Array')
                    . '</pre>';

    			$output.= '<li>'
                    . '<strong>' . esc_attr( $category->name ) . '</strong>'
                    . $archive_post_id
                    . $pre
                    . '<strong> Cat ID: </strong>' . esc_attr( $category->term_id);

    	        $li = '<ul style="margin: 1em;">';

    			foreach( $terms as $subcategory )
                {
    				if( $subcategory->parent == $category->term_id )
                    {
                        $archive_post_id = do_strong_id(
                            get_ID_page_archive_taxonomy_id ( $subcategory->term_id)
                        );
$li .= '<li>'
        . '<strong style="border-bottom: 1px solid;">'
            . esc_html( $subcategory->name )
        . '</strong>'
        . '<ul style="margin-left: 1em">'

            . '<li>'
                . '<strong>Cat ID: </strong>'
                . '<span>' . esc_html( $subcategory->term_id) . '</span>'
                . $archive_post_id
            . '</li>'

            . '<li>'
                . '<strong>Slug: </strong>'
                . '<span>' . esc_html( $subcategory->slug ) . '</span>'
            . '</li>'
        . '</ul>'
    .'</li>';
    				}
    			}
                $li .= '</ul>';

    			$output .= $li . '</li>';
    		}
    	}

    	$output.='</ul>';

    }

    return $output;
}
