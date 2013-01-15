<?php
class Api_HeatingController extends Zend_Controller_Action
{
	protected $_model;
	
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$this->_model = new Caramite_Model_Heating();
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
			$output = $this->_model->setBoostHeating("60");
		} else if ($data == "water") {
			$output = $this->_model->setBoostWater("60");
		} else {
			$output['Result'] = "ERROR";
			$output['Message'] = "Invalid toggle item";
		}
		$json = "";
		if (is_array($output)) {
			$json = Zend_Json::encode($output);
		} else {
			$json = $output;
		}
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}
	
	public function statusAction()
	{
		$output = $this->_model->getStatus();

		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody($output);
	}
}