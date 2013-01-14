<?php
/**
 * SF_Model_Resource_Db_Table_Abstract
 * 
 * Provides some common db functionality that is shared
 * across our db-based resources.
 * 
 * @category   Storefront
 * @package    Storefront_Model_Resource
 * @copyright  Copyright (c) 2008 Keith Pope (http://www.thepopeisdead.com)
 * @license    http://www.thepopeisdead.com/license.txt     New BSD License
 */
abstract class SF_Model_Resource_Socket_Abstract implements SF_Model_Resource_Socket_Interface
{	
	protected $_port = null;
	protected $_host = null;
	
	public function __construct()
	{
		$this->init();
	}
	
	
	public function send($message) {
		if (empty($this->_port) || empty($this->_host)) {
			return false;
		}
		
		$socket = socket_create ( AF_INET, SOCK_STREAM, 0 ) or
		die ( "error: could not create socket\n" ); // Creating a TCP socket
	
		socket_connect ( $socket, $this->_host, $this->_port ) or
		die ( "error: could not connect to host\n" ); // Connecting to to server
	
		socket_write ( $socket, $message . "\n", strlen ( $message ) + 1 ) or
		die ( "error: failed to write to socket\n" ); //writing message
	
		$reply = socket_read ( $socket, 10000, PHP_NORMAL_READ ) or 		// Reading the reply
		die ( "error: failed to read from socket\n" );
	
		socket_close($socket);
	
		return trim($reply);
	}
}
