<?php
class Api_DaysController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}

	public function listAction() 
	{
		$days = array();
		for($i = 1; $i <= 7; $i++) {
			$days[] = array("DisplayText" => $this->view->Day($i), "Value" => $i);
		}
		
		$jTableResult['Result'] = "OK";
		$jTableResult['Options'] = $days;
		$json = Zend_Json::encode($jTableResult);
		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody($json);
	}
}