<?php
/**
 * @ Lamosty.com 2015
 */

abstract class Lamosty_Store {

	protected $stores = array();

	public function __construct() {
	}

	final public function id() {
		return $this->id;
	}

	final public function compute_stores() {
		$actions_to_execute = apply_filters( 'lamosty-actions-' . $this->id(), '' );

		foreach ( $actions_to_execute as $action => $action_data ) {
			call_user_func( array( $this, $action ), $action_data );
		}
	}

	final public function get_stores() {
		return $this->stores;
	}

	final public function dispatch_stores() {
		add_filter( 'lamosty-stores-' . $this->id(), array( $this, 'get_stores' ) );
	}
}