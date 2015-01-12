<?php
/**
 * @ Lamosty.com 2015
 */

function lamosty_load_lamosty_plugin_stack() {
	foreach ( array( 'actions', 'plugin', 'store', 'views', 'dispatcher', 'callbacks-manager' ) as $lamosty_abstract_class ) {
		require_once( "class-lamosty-{$lamosty_abstract_class}.php" );
	}
}

lamosty_load_lamosty_plugin_stack();
