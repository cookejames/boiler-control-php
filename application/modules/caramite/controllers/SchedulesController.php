<?php
/**
 * Caramite_SchedulesController
 * 
 * @category   Caramite
 * @package    Caramite_Controller
 * @copyright  Copyright (c) 2010 Cooke IT Ltd
 * @license    tbd
 */
class Caramite_SchedulesController extends Zend_Controller_Action
{ 
    public function indexAction()
    {    	
    	$this->view->headScript()->appendFile('/js/clock.js');
    	$this->view->headScript()->appendFile('/js/checkStatus.js');
    	$this->view->headTitle('Schedules');
    }
}