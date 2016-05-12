<?php

namespace calderawp\convertKit;

/**
 * Class forms
 *
 * Manage forms
 *
 * @package calderawp\convertKit
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @copyright 2016 CalderaWP LLC
 */
class forms extends base implements the_interface{

	/**
	 * Get all forms
	 *
	 * @since 0.1.0
	 *
	 * @return object|string
	 */
	public function get_all() {
		return $this->make_request( 'forms' );
	}

	/**
	 * Find a form by name
	 *
	 * @since 0.1.0
	 *
	 * @param string $name Name of sequence
	 *
	 * @return object|string
	 */
	public function get( $name ){
		$forms = $this->get_all();

		return $this->find_by_name( $forms, $name, 'forms'  );
	}

	/**
	 * Add a subscriber to a form
	 *
	 * @since 0.1.0
	 *
	 * @param int $id The form ID
	 * @param array $args Subscriber arguments
	 *
	 * @return object|string
	 */
	public function add( $id, array $args ){
		return $this->make_request( sprintf('forms/%d/subscribe', $id ), 'POST', $args );
	}

	/**
	 * Get all subscribers to a form
	 *
	 * @since 0.1.0
	 *
	 * @param int $id The form ID
	 *
	 * @return object|string
	 */
	public function subscribers( $id ) {
		return $this->make_request( sprintf( 'forms/%d/subscriptions', $id ) );
	}

	/**
	 * Remove a subscriber from a form
	 *
	 * @since 0.1.0
	 *
	 * @param int $id Form ID
	 * @param string $email Email to unsubscribe
	 *
	 * @return object|string
	 */
	public function remove( $id, $email ){
		return $this->make_request( sprintf( 'forms/%d/unsubscribe', $id, 'POST', array( 'email' => $email ) ) );
	}


}
