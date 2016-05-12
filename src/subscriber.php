<?php
/** CONCEPT FOR A SUBSCRIBER OBJECT */
namespace calderawp\convertKit;


class subscriber {

	protected $email;

	protected $first_name;

	protected $fields;

	protected $tags;

	protected $courses;

	protected $forms;



	public function __set( $property, $value ){
		if( method_exists( $this, $property . '_set'  ) ){
			return call_user_func( $property . '_set', $value );
		}elseif( ! is_string( $value ) || ! is_numeric( $value ) ){
			return false;
		}elseif ( property_exists( $this, $property ) ){
			$this->$property = $value;
			return true;
		}else{
			return false;
		}

	}

	public function __get( $property ){
		if( property_exists( $this, $property ) ){
			return $this->$property;
		}
	}

	public function to_array(){
		return get_object_vars(  $this );
	}

	protected function email_set( $value ){
		if( is_email( $value ) ){
			$this->email = sanitize_email( $value );
		}

	}

	protected function id_prepare( $property, $values ){
		$the_values = [];
		foreach( $values as $value ){
			$v = absint( $value );
			if( 0 != $v ){
				$the_values[]= $value;
			}

		}

		if( ! empty( $the_values ) ){
			$this->$property = implode( ',', $the_values );
		}
	}

	protected function tags_set( $value ){
		if( is_array( $value ) ){
			$this->id_prepare( 'tags', $value );
		}elseif( is_numeric( $value ) || is_string( $value ) ){
			$this->tags = $value;
		}else{
			return false;
		}
	}

	protected function forms_set( $value ){
		if( is_array( $value ) ){
			$this->id_prepare( 'forms', $value );
		}elseif( is_numeric( $value ) || is_string( $value ) ){
			$this->forms = $value;
		}else{
			return false;
		}
	}

	protected function courses_set( $value ){
		if( is_array( $value ) ){
			$this->id_prepare( 'courses', $value );
		}elseif( is_numeric( $value ) || is_string( $value ) ){
			$this->forms = $value;
		}else{
			return false;
		}
	}

}
