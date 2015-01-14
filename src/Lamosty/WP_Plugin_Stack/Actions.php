<?php

/**
 * @ Lamosty.com 2015
 */

namespace Lamosty\WP_Plugin_Stack;

abstract class Actions {
	protected $id = null;
	protected $dispatcher = null;

	public function __construct( Dispatcher $dispatcher ) {
		$this->dispatcher = $dispatcher;
	}

	abstract public function init_wp_actions();

	final public function id() {
		return $this->id;
	}
}