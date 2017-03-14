<?php


namespace calderawp\convertKit;

/**
 * Class sequences
 *
 * Manage sequences
 *
 * @package calderawp\convertKit
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @copyright 2016 CalderaWP LLC
 */
class sequences extends base implements the_interface {

	/**
	 * Get all sequences
	 *
	 * @since 0.1.0
	 *
	 * @return object|string
	 */
	public function get_all() {
		return $this->make_request(  'sequences' );
	}

	/**
	 * Find a sequence by name
	 *
	 * @since 0.1.0
	 *
	 * @param string $name Name of sequence
	 *
	 * @return object|string
	 */
	public function get( $name ) {
		$sequences = $this->get_all();
		return $this->find_by_name( $sequences, $name, 'courses'  );
	}

	/**
	 * Add a subscriber to a tag
	 *
	 * @since 0.1.0
	 *
	 * @param int $id The sequence ID
	 * @param array $args Subscriber arguments
	 *
	 * @return object|string
	 */
	public function add( $id, array $args ){
		return $this->make_request( sprintf('courses/%s/subscribe', $id ), 'POST', $args);
	}

	/**
	 * Get all subscribers to a sequence
	 *
	 * @since 0.1.0
	 *
	 * @param int $id The sequence ID
	 *
	 * @return object|string
	 */
	public function subscribers( $id ) {
		return $this->make_request( sprintf( 'courses/%s/subscriptions', $id ) );
	}

	/**
	 * Remove a subscriber from a sequence
	 *
	 * @since 0.1.0
	 *
	 * @param int $id Sequence ID
	 * @param string $email Email to unsubscribe
	 *
	 * @return object|string
	 */
	public function remove( $id, $email ){
		return $this->make_request(sprintf( 'courses/%s/unsubscribe', $id ), 'POST', array( 'email' => $email ) );
	}


}
