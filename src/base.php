<?php

namespace calderawp\convertKit;

/**
 * Class base
 *
 * Base class for requests to ConvertKit API
 *
 * @package calderawp\convertKit
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @copyright 2016 CalderaWP LLC
 */
abstract class base {

	/**
	 * API Key
	 *
	 * @var String
	 */
	protected $api_key;

	/**
	 * @var int
	 */
	protected $api_version  = 3;

	/**
	 * @var string
	 */
	protected $api_url_base = 'https://api.convertkit.com/';


	/**
	 * Constructor
	 *
	 * @since 0.0.1
	 *
	 * @param String $api_key ConvertKit API Key
	 */
	public function __construct($api_key) {
		$this->api_key = $api_key;
	}

	/**
	 * Make a request to the ConvertKit API
	 *
	 * @since 1.3.6
	 *
	 * @param  string $request Request string
	 * @param  string $method  HTTP Method
	 * @param  array  $args    Request arguments
	 *
	 * @return object|string          Response object or fail message
	 */
	public function make_request($request, $method = 'GET', $args = array()) {
		$url = $this->build_request_url($request, $args);
		$results = wp_remote_request( $url, array( 'method' => $method ) );

		if( ! is_wp_error( $results ) ) {
			if( 200 == wp_remote_retrieve_response_code( $results ) ) {
				$results = wp_remote_retrieve_body( $results );
				return json_decode( $results );
			}else{
				$body = wp_remote_retrieve_body( $results );
				if( isset( $body['message'])){
					return $body[ 'message' ];
				}else{
					return wp_remote_retrieve_response_code( $results );
				}

			}

		}

	}

	/**
	 * Merge default request arguments with those of this request
	 *
	 * @since 0.1.0
	 *
	 * @param  array  $args Request arguments
	 * @return array        Request arguments
	 */
	public function filter_request_arguments($args = array()) {
		return array_merge($args, array('api_key' => $this->api_key ) );
	}

	/**
	 * Build the full request URL
	 *
	 * @since 0.1.0
	 *
	 * @param  string $request Request path
	 * @param  array  $args    Request arguments
	 * @return string          Request URL
	 */
	public function build_request_url($request, array $args) {
		return $this->api_url_base . 'v3/' . $request . '?' . http_build_query($this->filter_request_arguments($args));
	}

	/**
	 * Search in response object by name
	 *
	 * @since 0.1.0
	 *
	 * @param $list
	 * @param $name
	 * @param $property
	 *
	 * @return bool
	 */
	protected function find_by_name( $list, $name, $property ){
		if( is_object( $list ) && property_exists( $list, $property ) ){
			foreach( $list->$property as $item ){
				if( $name == $item->name ) {
					return $item;
				}
			}
		}

		return false;

	}
}
