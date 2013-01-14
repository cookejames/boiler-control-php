<?php
class Api_SocketsController extends Zend_Controller_Action
{
	protected $_model;
	
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$this->_model = new Caramite_Model_Boost();
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
			$output['Result'] = $this->_model->setBoostHeating("60");
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
}