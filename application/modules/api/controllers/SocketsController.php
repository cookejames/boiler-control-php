<?php
class Api_SocketsController extends Zend_Controller_Action
{
	protected $_model;
	
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}

	public function boostAction()
	{
		
		$data = $this->_getParam('toggle');
		$key = "";
	
		$output = array();
		if (is_null($data)) { //must have data
			$output['Result'] = "ERROR";
			$output['Message'] = "Toggle must be specified";
		} else if ($this->_request->getMethod() != "POST") { //must be post not get
			$output['Result'] = "ERROR";
			$output['Message'] = "Incorrect request method";
		} else if ($data == "heating") {
			$message = "boost heating 60";
			$output['Result'] = $this->socketTest($message);
		} else if ($data == "water") {
			$output['Result'] = "ERROR";
			$output['Message'] = "EMPTY FOR NOW";
		} else {
			$output['Result'] = "ERROR";
			$output['Message'] = "Invalid toggle item";
		}
		$json = Zend_Json::encode($output);
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}
	
	private function socketTest($message) {
		$PORT = 20000; // the port on which we are connecting to the "remote"
		               // machine
		$HOST = "192.168.11.110"; // the ip of the remote machine (in this case it's
		                     // the same machine)
		
		$sock = socket_create ( AF_INET, SOCK_STREAM, 0 ) or 		// Creating a TCP socket
		die ( "error: could not create socket\n" );
		
		$succ = socket_connect ( $sock, $HOST, $PORT ) or 		// Connecting to to server
		                                            // using that socket
		die ( "error: could not connect to host\n" );
		
		socket_write ( $sock, $message . "\n", strlen ( $message ) + 1 ) or 		// Writing the text
		                                                     // to the socket
		die ( "error: failed to write to socket\n" );
		
		$reply = socket_read ( $sock, 10000, PHP_NORMAL_READ ) or 		// Reading the reply
		                                                    // from socket
		die ( "error: failed to read from socket\n" );
		
		return $reply;
	}
}