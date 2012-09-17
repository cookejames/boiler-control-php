<?php
/**
 * Converts Java day of week to a string
 * @author james
 *
 */
class Zend_View_Helper_Day extends Zend_View_Helper_Abstract
{       
	
    public function day($day = null)
    {
    	if (is_null($day)) return $this;
    	
		switch ($day) {
			case 1: return "Sunday";
			case 2: return "Monday";
			case 3: return "Tuesday";
			case 4: return "Wednesday";
			case 5: return "Thursday";
			case 6: return "Friday";
			case 7: return "Saturday";
			default: return null;
		}
    }
    
    public function getArray() {
    	$days = array();
    	for($i = 1; $i <= 7; $i++) {
    		$days["$i"] = $this->Day($i);
    	}
    	return $days;
    }
}
