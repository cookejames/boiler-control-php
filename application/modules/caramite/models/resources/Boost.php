<?php
class Caramite_Resource_Boost extends SF_Model_Resource_Socket_Abstract
{
	protected $_port;
	protected $_host;
	
	public function init() 
	{
		$this->_port = Zend_Registry::getInstance()->constants->SERVER_PORT;
		$this->_host = Zend_Registry::getInstance()->constants->SERVER_HOST;
	}

	public function setBoostHeating($time)
	{
		return $this->send("boost:heating $time");
	}
}