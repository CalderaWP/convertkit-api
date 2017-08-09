<?php


namespace calderawp\convertKit;


/**
 * Class subscribers
 * @package calderawp\convertKit
 */
class subscribers extends base{

	/**
	 * Find subscriber by allowed fields
	 *
	 * @param array $args Fields to search by
	 *
	 * @return object|string
	 */
	public function find( array $args ){
		return $this->make_request( '/subscribers', 'GET', $args );
	}


	/**
	 * Find subscriber by email
	 *
	 * @param string $email Email to search by
	 *
	 * @return object|string
	 */
	public function by_email( $email ){
		return $this->make_request( '/subscribers', 'GET', [ 'email_address' => $email ] );
	}

	/**
	 * Find subscriber by their ID
	 *
	 * @param int $id
	 *
	 * @return object|string
	 */
	public function subscriber( $id ){
		return $this->make_request( '/subscribers/' . $id );

	}

	/**
	 * Update subscriber by their ID
	 *
	 * @param int $id
	 * @param array $args New values
	 *
	 * @return object|string
	 */
	public function update( $id, array $args ){
		return $this->make_request( '/subscribers/' . $id, 'PUT', $args );
	}

}
