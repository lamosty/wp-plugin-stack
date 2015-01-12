<?php

/**
 * @ Lamosty.com 2015
 */
abstract class Lamosty_Actions {
	protected $id = null;
	protected $dispatcher = null;

	public function __construct( Lamosty_Dispatcher $dispatcher ) {
		$this->dispatcher = $dispatcher;
	}

	abstract public function init_actions();

	final public function id() {
		return $this->id;
	}
}