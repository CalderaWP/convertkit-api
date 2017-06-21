<?php

namespace calderawp\convertKit;

/**
 * Class tags
 *
 * Manager tags
 *
 * @package calderawp\convertKit
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @copyright 2016 CalderaWP LLC
 */
class tags extends base {

	/**
	 * Get all tags
	 *
	 * @since 0.1.0
	 *
	 * @return object|string
	 */
	public function get_all(){
		return $this->make_request(  'tags' );
	}

	/**
	 * Get a tag by name
	 *
	 * @since 0.1.0
	 *
	 * @param string $name Get tag by name
	 *
	 * @return object|string
	 */
	public function get( $name ){
		
	}

	/**
	 * Get all subscribers to a tag
	 *
	 * @since 0.1.0
	 *
	 * @param $tag_id
	 *
	 * @return object|string
	 */
	public function subscribers( $tag_id ){
		return $this->make_request( sprintf( '%s/subscriptions/', $tag_id ) );
	}

	/**
	 * Add as subscriber to a tag
	 *
	 * @param int $tag_id Tag ID
	 * @param string $email Email address
	 * @param array $args Optional. Additional args for subscriber
	 *
	 * @return object|string
	 */
	public function subscribe(  $tag_id, $email, array $args = array() ){
		return $this->make_request(
			sprintf( 'tags/%d/subscribe', $tag_id ),
			'POST',
			wp_parse_args( $args, array( 'email' => $email )  )
		);
	}

	/**
	 * Remove a subscriber from a tag
	 *
	 * @since 0.1.0
	 *
	 * @param int $tag_id The tag ID
	 * @param int $subscriber_id The subscriber ID
	 *
	 * @return object|string
	 */
	public function unsubscribe( $tag_id, $subscriber_id ){
		return $this->make_request( sprintf( 'subscribers/%d/tags/%s', $subscriber_id, $tag_id ), 'DELETE' );
	}

}
