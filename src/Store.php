<?php

/**
 * @ Lamosty.com 2015
 */

namespace Lamosty\WP_Plugin_Stack;

abstract class Store {
	protected $id;
	protected $data = array();

	final public function id() {
		return $this->id;
	}

	final public function get_all() {
		return $this->data;
	}

	final public function get( $key ) {
		return $this->data[ $key ];
	}

	final public function add( $key, $value ) {
		$this->data[ $key ] = $value;

		return true;
	}

	/**
	 * Add/replace new data in array("key" => "value") format, performs shallow merge
	 * @param array $new_data
	 *
	 * @return bool
	 */

	final public function merge( array $new_data ) {
		array_merge( $this->data, $new_data );

		return true;
	}
}