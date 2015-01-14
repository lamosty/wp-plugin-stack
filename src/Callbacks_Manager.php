<?php
/**
 * @ Lamosty.com 2015
 */

namespace Lamosty\WP_Plugin_Stack;

abstract class Callbacks_Manager {
	protected $stores_dispatch_tokens = array();
	protected $dispatcher;

	public function __construct(Dispatcher $dispatcher, Plugin $lamosty_plugin) {
		$this->dispatcher = $dispatcher;
		$this->lamosty_plugin = $lamosty_plugin;
	}

	protected function get_view($view_id) {
		return $this->lamosty_plugin->get_view($view_id);
	}

	protected function register_callback($store_id, $callback) {
		$this->get_store( $store_id );
		$this->stores_dispatch_tokens[ $store_id ] = $this->dispatcher->register($callback);
	}

	protected function get_store_dispatch_token($store_id) {
		if (!array_key_exists($store_id, $this->stores_dispatch_tokens)) {
			throw new \Exception('Store with specified $store_id does not have registered callback on it. Register it first.');
		}

		return $this->stores_dispatch_tokens[$store_id];
	}

	protected function get_store( $store_id ) {
		return $this->lamosty_plugin->get_store($store_id);

	}
}