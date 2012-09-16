<?php
class Caramite_Model_Groups extends SF_Model_Abstract
{	
	
	public function getGroupById($id)
	{
		return $this->getResource('Groups')->getGroupById($id);
	}
	
	public function getGroups()
	{
		return $this->getResource('Groups')->getGroups();
	}
	
	public function getGroupByName($name)
	{
		return $this->getResource('Groups')->getGroupByName($name);
	}
	
	public function deleteGroup($id) {
		return $this->getResource('Groups')->deleteGroup($id);
	}
	
	public function saveGroup(array $data)
	{
		return $this->saveRow($data);
	}
	
	private function saveRow(array $data, array $defaults = array())
	{
		if (!array_key_exists("name", $data)) {
			return false;
		}
	
		// apply any defaults
		foreach ($defaults as $col => $value) {
			$data[$col] = $value;
		}
	
		$row = null;
		if (array_key_exists("id", $data)) {
			$row = $this->getGroupById($data["id"]);
		}
		if (!is_null($row)) {
			return $this->getResource('Groups')->saveRow($data, $row);
		}
	
		return $this->getResource('Groups')->saveRow($data);
	}
}