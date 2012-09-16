<?php
class Caramite_SchedulesController extends Zend_Controller_Action
{
	protected $_model;
	
	public function init()
	{
		$this->_model = new Caramite_Model_Schedules();
	}
	
	public function setenabledAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
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
		
		echo Zend_Json::encode($output);
	}
}