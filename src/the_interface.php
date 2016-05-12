<?php
/**
 * @TODO What this does.
 *
 * @package   @TODO
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock
 */

namespace calderawp\convertKit;

/**
 * Interface the_interface
 *
 * Interface for collections
 *
 * @package calderawp\convertKit
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @copyright 2016 CalderaWP LLC
 */
interface the_interface {


	public function get_all();

	public function get( $name );

	public function add( $id, array  $args );

	public function subscribers( $id );

	public function remove( $id, $email );

}
