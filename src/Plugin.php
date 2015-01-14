<?php namespace Lamosty\WP_Plugin_Stack;

/**
 * @ Lamosty.com 2015
 */

abstract class Plugin {
	protected $dispatcher = null;
	protected $views = array();
	protected $stores = array();

	/**
	 * Set to the namespace of class which extends this one
	 * @const $namespace
	 */
	protected $namespace;

	public function get_view( $view_id ) {
		if ( ! array_key_exists( $view_id, $this->views ) ) {
			$view_id         = ucfirst( $view_id );
			$view_class_name = $this->namespace . "\\Views\\{$view_id}_Views";

			$this->views[ $view_id ] = new $view_class_name;
		}

		return $this->views[ $view_id ];
	}

	protected function __construct( $dispatcher) {
		$this->dispatcher = $dispatcher;
	}

	public function get_store( $store_id ) {
		if ( ! array_key_exists( $store_id, $this->stores ) ) {
			$store_id         = ucfirst( $store_id );
			$store_class_name = $this->namespace . "\\Stores\\{$store_id}_Store";

			$this->stores[ $store_id ] = new $store_class_name;
		}

		return $this->stores[ $store_id ];
	}
}
