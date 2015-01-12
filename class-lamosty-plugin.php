<?php

/**
 * @ Lamosty.com 2015
 */
abstract class Lamosty_Plugin {
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

		spl_autoload_register( array( $this, 'autoload' ) );
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

	protected function autoload( $class_name ) {
		$path = "";

		$class_name = strtolower( $class_name );

		$file_name = 'class-' . str_replace( '_', '-', $class_name ) . '.php';

		$class_prefix_len = strlen( $this->class_prefix );


		if ( strpos( $class_name, 'store' ) === $class_prefix_len + 1 ) {
			$path = $this->get_include_class_path( "stores/{$file_name}" );
		} elseif ( strpos( $class_name, 'view' ) === $class_prefix_len + 1 ) {
			$path = $this->get_include_class_path( "views/{$file_name}" );
		} elseif ( strpos( $class_name, 'action' ) === $class_prefix_len + 1 ) {
			$path = $this->get_include_class_path( "actions/{$file_name}" );
		} elseif ( strpos( $class_name, 'callbacks_manager' ) === $class_prefix_len + 1 ) {
			$path = $this->get_include_class_path( "callbacks-managers/{$file_name}" );
		}

		if ( $path && is_readable( $path ) ) {
			require_once( $path );

			return;
		}
	}

}
