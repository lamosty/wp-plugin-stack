<?php
/**
 * @ Lamosty.com 2015
 */

abstract class Lamosty_Action {

	protected $actions = array();

	public function __construct() {
	}

	final public function id() {
		return $this->id;
	}

	final public function dispatch_actions() {
		add_filter( 'lamosty-actions-' . $this->id(), array( $this, 'get_actions' ) );
	}

	final public function get_actions() {
		return $this->actions;
	}
}