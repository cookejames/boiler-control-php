<?php
/**
 * Converts time of day in minutes to a string
 * @author james
 *
 */
class Zend_View_Helper_Time extends Zend_View_Helper_Abstract
{       
	private $_minsInHour = 60;
	
    public function time($minutes)
    {
		$hour = (int)($minutes / $this->_minsInHour);
		$mins = $minutes % $this->_minsInHour;
		return str_pad($hour, 2, "0", STR_PAD_LEFT) . ":" . str_pad($mins, 2, "0", STR_PAD_LEFT);
    }
}
