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

	final public function get_all_data() {
		return $this->data;
	}

	final public function get_single_data( $key ) {
		return $this->data[ $key ];
	}

}