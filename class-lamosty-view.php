<?php
/**
 * @ Lamosty.com 2015
 */

abstract class Lamosty_View {

	public function __construct() {
	}

	final public function id() {
		return $this->id;
	}

	final public function render_views() {
		$views_to_render = apply_filters( 'lamosty-stores-' . $this->id, '' );

		foreach ( $views_to_render as $view => $view_data ) {
			call_user_func( array( $this, $view ), $view_data );
		}
	}
}