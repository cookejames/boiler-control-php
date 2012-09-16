<?php
class Api_DaysController extends Zend_Rest_Controller
{
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function indexAction()
	{
		return $this->postAction();
	}
	
	public function putAction()
	{

	}

	public function getAction() 
	{
	}

	public function postAction() 
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

	public function deleteAction() 
	{

	}
}