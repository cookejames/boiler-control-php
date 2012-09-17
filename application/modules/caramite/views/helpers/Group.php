<?php
/**
 * Converts Java day of week to a string
 * @author james
 *
 */
class Zend_View_Helper_Group extends Zend_View_Helper_Abstract
{       
	private $_model;
	
    public function group($id = null)
    {
    	$this->_model = new Caramite_Model_Groups();
    	if (is_null($id)) return $this;
    	
		return $this->_model->getGroupById($id);
    }
    
    public function getGroups() {
    	return $this->_model->getGroups();
    }
}
