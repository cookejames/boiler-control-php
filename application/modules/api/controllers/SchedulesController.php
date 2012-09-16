<?php
class Api_SchedulesController extends Zend_Rest_Controller
{
	protected $_model;
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$this->_model = new Caramite_Model_Schedules();
	}
	
	public function indexAction()
	{
		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody("From indexAction()");
	}
	
	public function putAction()
	{
		$action = $this->_getParam("schedule");
		switch ($action) {
			case "put": break;
			case "get": return $this->getAction();
			case "delete": return $this->deleteAction();
		}
		$params = $this->_getAllParams();
		unset($params['schedule']);
		unset($params['module']);
		unset($params['controller']);
		unset($params['action']);
		
		$error = "Save failed";
		$result = false;
		try {
			$result = $this->_model->saveSchedule($params);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		if ($result) {
			$schedule = $this->_model->getScheduleById($result);
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			if (!isset($params['id'])) { //only return record for new entry
				$jTableResult['Record'] = $schedule->toArray();
			}
			$json = Zend_Json::encode($jTableResult);
			$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
		} else {
			$jTableResult['Result'] = "ERROR";
			$jTableResult['Message'] = $error;
			$json = Zend_Json::encode($jTableResult);
			$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
		}

	}

	public function getAction() 
	{
		$group = $this->_getParam("group");
		$schedules = null;
		if (empty($group)){
			$schedules = $this->_model->getSchedules();
		} else {
			$schedules = $this->_model->getSchedulesByGroup($group);
		}
		
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $schedules->toArray();
		$json = Zend_Json::encode($jTableResult);
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}

	public function postAction() 
	{
		$this->getResponse()
		->setHttpResponseCode(201)
		->appendBody("From putAction()");
	}

	public function deleteAction() 
	{
		$id = $this->_getParam('id');
		$this->_model->deleteSchedule($id);
		$jTableResult['Result'] = "OK";
		$json = Zend_Json::encode($jTableResult);
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}
}