<?php

/**
 * @ Lamosty.com 2015
 */

namespace Lamosty\WP_Plugin_Stack;

abstract class Plugin {
	protected $dispatcher = null;
	protected $views = array();
	protected $stores = array();

	protected $class_prefix = 'lamosty';

	public function get_view( $view_id ) {
		if ( ! array_key_exists( $view_id, $this->views ) ) {
			$view_class_name = $this->class_prefix . '_Views_' . $view_id;

			$this->views[ $view_id ] = new $view_class_name;
		}

		return $this->views[ $view_id ];
	}

	protected function __construct( $dispatcher, $file ) {
		$this->file       = $file;
		$this->dispatcher = $dispatcher;
	}

	public function get_store( $store_id ) {
		if ( ! array_key_exists( $store_id, $this->stores ) ) {
			$store_class_name = $this->class_prefix . '_Store_' . $store_id;

			$this->stores[ $store_id ] = new $store_class_name;
		}

		return $this->stores[ $store_id ];
	}

	public function get_include_class_path( $file ) {
		$includes_path = plugin_dir_path( $this->file ) . 'includes/';

		return $includes_path . $file;

	}
}
