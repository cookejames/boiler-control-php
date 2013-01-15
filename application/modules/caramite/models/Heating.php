<?php
class Caramite_Model_Heating extends SF_Model_Abstract
{	
	public function setBoostHeating($time)
	{
		return $this->getResource('Heating')->setBoostHeating($time);
	}
	
	public function setBoostWater($time)
	{
		return $this->getResource('Heating')->setBoostWater($time);
	}
	
	public function getStatus()
	{
		return $this->getResource('Heating')->getStatus();
	}
}