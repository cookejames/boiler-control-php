<?php
class Caramite_Model_Boost extends SF_Model_Abstract
{	
	public function setBoostHeating($time)
	{
		return $this->getResource('Boost')->setBoostHeating($time);
	}
}