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
	 * Last response returned by WordPress HTTP API
	 *
	 * @var array|\WP_Error
	 */
	protected $last_response;

	/**
	 * @var string
	 */
	protected $secret_key;

	/**
	 * Constructor
	 *
	 * @since 0.0.1
	 *
	 * @param String $api_key ConvertKit API Key
	 */
	public function __construct($api_key, $secret = '' ) {
		$this->api_key = $api_key;
		$this->secret_key = $secret;
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

		$this->last_response = $results;
		if( ! is_wp_error( $results ) ) {
			if( 200 == wp_remote_retrieve_response_code( $results ) ) {
				$results = wp_remote_retrieve_body( $results );
				return json_decode( $results );
			}else{
				$body = wp_remote_retrieve_body( $results );
				if( is_string( $body ) && is_object( $json = json_decode( $body ) ) ){
					$body = (array) $json;
				}

				if( isset( $body['error'] ) && ! empty( $body[ 'error' ] ) ){
					return $body[ 'error' ];
				}elseif( isset( $body['message'] ) && ! empty( $body[ 'message' ] ) ){
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
		$args = array_merge($args, array('api_key' => $this->api_key ) );
		if( ! empty( $this->secret_key ) ){
			$args[ 'api_secret' ] = $this->secret_key;
		}

		return $args;
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

	/**
	 * Get the last response returned by WordPress HTTP API
	 *
	 * @since 0.1.0
	 *
	 * @return array|\WP_Error
	 */
	public function get_last_response(){
		return $this->last_response;
	}
}
