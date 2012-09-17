<?php
class Api_ConfigurationController extends Zend_Controller_Action
{
	protected $_model;
	
	public function init()
	{
		$this->_model = new Caramite_Model_Configuration();
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function statusAction()
	{
		$get = $this->_getParam('get');
		$key = "";
	
		$output = array();
		
		if (is_null($get)) {
			$output['Result'] = "ERROR";
			$output['Message'] = "Get must be specified";
		} 
		
		if ($get == "heating") {
			$output['Result'] = "OK";
			$output['Record'] = $this->_model->getConfigurationByKey("heatingStatus")->value;
		} else if ($get == "water") {
			$output['Result'] = "OK";
			$output['Record'] = $this->_model->getConfigurationByKey("waterStatus")->value;
		} else {
			$output['Result'] = "ERROR";
			$output['Message'] = "Invalid status choice";
		}
		$json = Zend_Json::encode($output);
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}
	
	public function boostAction()
	{
		$get = $this->_getParam('toggle');
		$key = "";
	
		$output = array();
	
		if (is_null($get)) {
			$output['Result'] = "ERROR";
			$output['Message'] = "Toggle must be specified";
		}
	
		if ($get == "heating") {
			$output['Result'] = "OK";
			$this->_model->setConfiguration("toggleHeating", "true", "boolean");
		} else if ($get == "water") {
			$output['Result'] = "OK";
			$this->_model->setConfiguration("toggleWater", "true", "boolean");
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