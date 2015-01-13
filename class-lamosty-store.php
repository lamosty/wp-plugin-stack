<?php

/**
 * @ Lamosty.com 2015
 */
abstract class Lamosty_Store {
	protected $id;
	protected $data = array();

	final public function id() {
		return $this->id;
	}

	final public function get_data() {
		return $this->data;
	}

	final public function get_single_data( $key ) {
		return $this->data[ $key ];
	}

	final protected function add_single_data( $key, $value ) {
		$this->data[ $key ] = $value;

		return true;
	}

	// TODO: Add add_data($values) which will add/overwrite the local array $data
}