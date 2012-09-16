<?php
class Api_GroupsController extends Zend_Rest_Controller
{
	private $_model;
	public function init()
	{
		$this->_model = new Caramite_Model_Groups();
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function indexAction()
	{
		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody("From indexAction()");
	}
	
	public function putAction()
	{
		$action = $this->_getParam("group");
		switch ($action) {
			case "put": break;
			case "get": return $this->getAction();
			case "delete": return $this->deleteAction();
		}
		$params = $this->_getAllParams();
		unset($params['schedule']);
		unset($params['module']);
		unset($params['controller']);
		unset($params['group']);
	
		$error = "Save failed";
		$result = false;
		try {
			$result = $this->_model->saveGroup($params);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		if ($result) {
			$group = $this->_model->getGroupById($result);
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			if (!isset($params['id'])) { //only return record for new entry
				$jTableResult['Record'] = $group->toArray();
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
		$jTableResult['Result'] = "OK";
		
		$displayas = $this->_getParam("display");
		if($displayas == "options") {
			$groups = $this->_model->getGroups();
			$array = array();
			foreach ($groups as $group) {
				$array[] = array("DisplayText" => $group->name, "Value" => $group->id);
			}
			$jTableResult['Options'] = $array;
		} else {
			$jTableResult['Records'] = $this->_model->getGroups()->toArray();
		}
		
		$json = Zend_Json::encode($jTableResult);
		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody($json);
	}
	

	public function postAction()
	{
		$this->getResponse()
		->setHttpResponseCode(201)
		->appendBody("From postAction()");
	}
	
	public function deleteAction()
	{
		$id = $this->_getParam('id');
		$this->_model->deleteGroup($id);
		$jTableResult['Result'] = "OK";
		$json = Zend_Json::encode($jTableResult);
		$this->getResponse()
		->setHttpResponseCode(200)
		->appendBody($json);
	}
}