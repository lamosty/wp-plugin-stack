<?php
/**
 * @ Lamosty.com 2015
 */

abstract class Lamosty_Plugin {

	protected $actions = array();
	protected $stores = array();
	protected $views = array();

	final public function run_all() {
		foreach( $this->actions as $action ) {
			$action->dispatch_actions();
		}

		foreach( $this->stores as $store ) {
			$store->compute_stores();
			$store->dispatch_stores();
		}

		foreach( $this->views as $view ) {
			$view->render_views();
		}
	}
}
