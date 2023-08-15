<?php

namespace saltw;

if ( ! defined( 'ABSPATH' ) ) { exit; }

function get_plugin_tables ()
{
	$tables = array(
		'example',
        'thumbnails',
		'pepe'
	);

	return $tables;
}


function sabrinsky_create_table ( $table )
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
	$table_schema = NULL;

	if ( $table == 'example' )
    {
        $table_name = $wpdb->prefix . __NAMESPACE__ . '_' . $table;

        $table_schema = "CREATE TABLE IF NOT EXISTS $table_name (
            id int(9) unsigned NOT NULL AUTO_INCREMENT,

	        nome varchar(32) NOT NULL,
	        slogan varchar(132) DEFAULT NULL,
	        descricion varchar(256) DEFAULT NULL,
	        logo varchar(256) DEFAULT NULL,
	        tfno varchar(9) DEFAULT NULL,
	        email varchar(132) DEFAULT NULL,
	        web varchar(255) DEFAULT NULL,
            url varchar(255) DEFAULT '' NOT NULL,
	        data_actualizacion timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
	        data_alta timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
            accessed datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	        estado_id int(11) DEFAULT '1' NOT NULL,
	        etiquetas varchar(256) DEFAULT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
    }

	if ( $table == 'thumbnails' )
    {
        $table_name = $wpdb->prefix . __NAMESPACE__ . '_' . $table;

        $table_schema = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
			taxonomy_slug varchar(25) NOT NULL,
			page_id bigint(20) unsigned NOT NULL,
			type varchar(8) NOT NULL DEFAULT 'Category',
			thumb_id bigint(20) unsigned NOT NULL DEFAULT '0',
            PRIMARY KEY (id)
        ) $charset_collate;";
    }

    // if ( isset ( $table_schema ) )
    if ( $table_schema != NULL )
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $table_schema );
    }
}


function sabrinsky_drop_tables ( $modules = array() )
{
    global $wpdb;

    foreach ( $modules as $table )
    {
        $table_name = $wpdb->prefix . __NAMESPACE__ . '_' . $table;

        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    }
}
