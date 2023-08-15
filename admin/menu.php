<?php

namespace saltw;

if ( ! defined( 'ABSPATH' ) ) { exit; }

function add_menu_principal ()
{
	add_menu_page(
		// $parent_slug [string]     Required
		// 'edit.php?post_type=team_member',

		// $page_title [string]      Required
		'WebUsable | Ajustes Generales',
		// $menu_title [string]      Required
		'WebUsable',
		// $capability [string]      Required
		'manage_options',
		// $menu_slug  [string]      Required
		WU_MENU_PARENT,
		// $function   [callable]    Default = ''
		__NAMESPACE__ . '\do_page_Principal'
		// $icon_url   [string]      Default = ''
        // 'dashicons-database-add',
		// $position   [int]         Default = null
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\add_menu_principal' );


function add_menu_subpage_1()
{
	add_submenu_page(
		// $parent_slug [string]     Required
		WU_MENU_PARENT,
		// $page_title [string]      Required
		'WebUsable | Imágenes de categorías',
		// $menu_title [string]      Required
		'Imágenes',
		// $capability [string]      Required
		'manage_options',
		// $menu_slug  [string]      Required
		WU_MENU_PAGE_1,
		// $function   [callable]    Default = ''
		__NAMESPACE__ . '\do_page_Thumbnails'
		// $position   [int]         Default = null
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\add_menu_subpage_1' );
