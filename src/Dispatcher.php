<?php

/**
 * @ Lamosty.com 2015
 */

namespace Lamosty\WP_Plugin_Stack;

final class Dispatcher {
	protected $callbacks = array();
	protected $is_pending = array();
	protected $is_handled = array();
	protected $is_dispatching = false;
	protected $pending_payload = null;

	protected $last_ID = 1;
	protected $prefix = "ID_";

	public function __constructor() {
	}

	public function register( $callback ) {
		$id                     = $this->prefix . $this->last_ID ++;
		$this->callbacks[ $id ] = $callback;

		return $id;
	}

	public function wait_for( $ids ) {
		$ids_len = count( $ids );

		for ( $i = 0; $i < $ids_len; $i ++ ) {
			$id = $ids[ $i ];

			if ( $this->is_pending[ $id ] ) {
				continue;
			}

			$this->invoke_callback( $id );
		}
	}

	public function dispatch( $payload ) {
		$this->start_dispatching( $payload );

		$stored_exc = null;

		try {
			foreach ( $this->callbacks as $id => $callback ) {
				if ( $this->is_pending[ $id ] ) {
					continue;
				}
				$this->invoke_callback( $id );
			}
		} catch ( Exception $exc ) {
			$stored_exc = $exc;
		}

		if ( $stored_exc ) {
			throw( $stored_exc );
		} else {
			$this->stop_dispatching();
		}
	}

	private function invoke_callback( $id ) {
		$this->is_pending[ $id ] = true;

		call_user_func( $this->callbacks[ $id ], $this->pending_payload );

		$this->is_handled[ $id ] = true;
	}

	public function is_dispatching() {
		return $this->is_dispatching;
	}

	private function start_dispatching( $payload ) {
		foreach ( $this->callbacks as $id => $callback ) {
			$this->is_pending[ $id ] = false;
			$this->is_handled[ $id ] = false;
		}

		$this->pending_payload = $payload;
		$this->is_dispatching  = true;
	}

	private function stop_dispatching() {
		$this->pending_payload = null;
		$this->is_dispatching  = false;
	}

}