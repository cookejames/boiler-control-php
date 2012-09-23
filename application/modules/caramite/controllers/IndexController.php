<?php
/**
 * Caramite_IndexController
 * 
 * @category   Caramite
 * @package    Caramite_Controller
 * @copyright  Copyright (c) 2010 Cooke IT Ltd
 * @license    tbd
 */
class Caramite_IndexController extends Zend_Controller_Action
{ 
    public function indexAction()
    {    	
    	$this->view->headScript()->appendFile('/js/clock.js');
    	$this->view->headScript()->appendFile('/js/checkStatus.js');
    	$this->view->headTitle('Schedules');
    	
    	$_model = new Caramite_Model_Configuration();
    	$this->view->holidayFrom = strftime("%A %d %B %H:%M", (int) ($_model->getConfigurationByKey("holidayFrom")->value / 1000));
    	$this->view->holidayTo = strftime("%A %d %B %H:%M", (int) ($_model->getConfigurationByKey("holidayUntil")->value / 1000));
    }
}