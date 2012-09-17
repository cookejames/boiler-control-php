<?php
class Api_SchedulesController extends Zend_Controller_Action
{
	protected $_model;
	public function init()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$this->_model = new Caramite_Model_Schedules();
	}
	
	public function addAction()
	{
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
	
	public function multiaddAction()
	{
		$params = $this->_getAllParams();
		unset($params['schedule']);
		unset($params['module']);
		unset($params['controller']);
		unset($params['action']);
	
		$error = "Save failed";
		$result = false;
		try {
			$days = array();
			foreach ($params as $key => $value) {
				$pieces = explode("-", $key);
				if (count($pieces) == 2 && $pieces[0] == "day") {
					if ($value == 1) {
						$days[] = $pieces[1];
					}
					unset($params[$key]);
				}
			}
			if (count($days) > 0) {
				foreach ($days as $day) {
					$schedule = $params; //copy array
					$schedule["day"] = $day;
					$success = $this->_model->saveSchedule($schedule);
					$result = ($success) ? true : false;
				}
			}
			
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		if ($result) {
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
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

	public function listAction() 
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
	
	public function setenabledAction()
	{
		$group = $this->_getParam('group');
		$value = $this->_getParam('value');
	
		$output = array();
		if (is_null($group) || is_null($value)) {
			$output['Result'] = "ERROR";
			$output['Message'] = "Group and value must be specified";
		} else {
			$output['Result'] = "OK";
			$this->_model->setGroupEnabled($group, $value);
		}
	
		$json = Zend_Json::encode($output);
		$this->getResponse()
			->setHttpResponseCode(200)
			->appendBody($json);
	}
}