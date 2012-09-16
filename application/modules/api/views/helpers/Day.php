<?php
/**
 * Converts Java day of week to a string
 * @author james
 *
 */
class Zend_View_Helper_Day extends Zend_View_Helper_Abstract
{       
	
    public function day($day)
    {
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
}
