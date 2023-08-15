<?php

namespace saltw;

function do_strong_id ( $id, $title = 'Post ID ' )
{
    $strong = NULL;
    if( $id != NULL )
    {
        $strong = ' | <strong style="color:red;">' . $title . '</strong>' . $id;
    }

    return $strong;
}

function get_ID_page_archive_taxonomy_slug ( $category_slug )
{
    // Obtener la categoría por su slug
    $category = get_term_by('slug', $category_slug, 'category');
    $post_id = NULL;

    if ( $category )
    {
        // Obtener el ID de la página de archive de la categoría
        $category_archive_page_id = get_term_meta(
            $category->term_id, '_wp_page_for_posts', true
        );

        if ( $category_archive_page_id )
        {
            $post_id = $category_archive_page_id;
        }
        // else {
        //     echo 'No se encontró una página de archive para esta categoría.';
        // }
    }
    // else {
    //     echo 'La categoría no fue encontrada.';
    // }

    return $post_id;
}


function get_ID_page_archive_taxonomy( $args )
{
    // Buscar el post que tiene asignada la categoría como página de archive
    $defaults = array(
        'post_type' => 'post',
        'posts_per_page' => 1
    );

    $args = wp_parse_args( $args, $defaults );

    $archive_post_id = NULL;

    $query = new \WP_Query($args);

    if ( $query->have_posts() )
    {
        $query->the_post();

        $archive_post_id = get_the_ID();
    }
    else {
        // echo 'No se encontró una página de archive para esta categoría.';
    }

    // Restaurar la consulta original de WordPress
    wp_reset_postdata();

    return $archive_post_id;
}


function get_ID_page_archive_taxonomy_name ( $slug )
{
    // Buscar el post que tiene asignada la categoría como página de archive
    $args = array(
        'post_type' => 'post',
        'category_name' => $slug,
        // 'name' => $slug,
        'posts_per_page' => 1
    );

    $archive_post_id = NULL;

    $query = new \WP_Query($args);

    if ( $query->have_posts() )
    {
        $query->the_post();

        $archive_post_id = get_the_ID();
    }
    else {
        // echo 'No se encontró una página de archive para esta categoría.';
    }

    // Restaurar la consulta original de WordPress
    wp_reset_postdata();

    return $archive_post_id;
}


function get_ID_page_archive_taxonomy_id ( $cat_id )
{
    // Buscar el post que tiene asignada la categoría como página de archive
    $args = array(
        'post_type' => 'post',
        'cat' => $cat_id,
        'posts_per_page' => 1
    );

    $archive_post_id = NULL;

    $query = new \WP_Query($args);

    if ( $query->have_posts() )
    {
        $query->the_post();

        $archive_post_id = get_the_ID();
    }
    else {
        // echo 'No se encontró una página de archive para esta categoría.';
    }

    // Restaurar la consulta original de WordPress
    wp_reset_postdata();

    return $archive_post_id;
}
