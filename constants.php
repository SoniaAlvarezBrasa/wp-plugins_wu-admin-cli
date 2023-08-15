<?php

namespace saltw;

// TODO cambiar WUCLI_PLUGIN_NAME
define( 'PLUGIN_NAME', 'wu_admin_cli' );

// Admin menu pages
define( 'WU_TEXTDOMAIN', 'wu_textdomain');
define( 'WU_MENU_PARENT', __NAMESPACE__ . '_principal' );
define( 'WU_MENU_PAGE_1', __NAMESPACE__ . '_page_1' );
define( 'WU_GROUP_PRINCIPAL', 'options_' . PLUGIN_NAME . '_principal' );
define( 'WU_GROUP_PAGE_1', 'options_' . PLUGIN_NAME . '_page_1' );

// Prefix table options
define( 'WP_PREFIX_OPTIONS_MENU_PARENT', 'cia_');
define( 'WP_PREFIX_OPTIONS_PAGE_1', 'aaa_');

// Específicas
define( 'WU_CATEGORY_DEFAULT_SLUG', 'sin-categoria' );
