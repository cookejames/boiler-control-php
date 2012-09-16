<?php
class Caramite_Model_Configuration extends SF_Model_Abstract
{	
	
	public function getConfigurations()
	{
		return $this->getResource('Configuration')->getConfigurations();
	}
	
	public function getConfigurationByKey($key)
	{
		return $this->getResource('Configuration')->getConfigurationByKey($key);
	}
	
	public function deleteConfiguration($key) {
		return $this->getResource('Configuration')->deleteConfiguration($key);
	}
	
	public function setConfiguration($key, $value, $type) 
	{
		$data = array('key' => $key, 'value' => $value, 'type' => $type);
		return $this->saveRow($data);
	}
	
	private function saveRow(array $data, array $defaults = array()) 
	{	
		// apply any defaults
		foreach ($defaults as $col => $value) {
			$data[$col] = $value;
		}
		
		$row = null;
		if (array_key_exists("key", $data)) {
			$row = $this->getConfigurationByKey($data["key"]);
		}
		if (!is_null($row)) {
			return $this->getResource('Configuration')->saveRow($data, $row);
		}
		
		return $this->getResource('Configuration')->saveRow($data);
	}
}