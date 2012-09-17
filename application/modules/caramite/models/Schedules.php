<?php
class Caramite_Model_Schedules extends SF_Model_Abstract
{	
	
	public function getScheduleById($id)
	{
		return $this->getResource('Schedules')->getScheduleById($id);
	}
	
	public function getSchedulesByGroup($group)
	{
		return $this->getResource('Schedules')->getSchedulesByGroup($group);
	}
	
	public function setGroupEnabled($group, $value)
	{
		return $this->getResource('Schedules')->setGroupEnabled($group, $value);
	}
	
	public function getSchedules()
	{
		return $this->getResource('Schedules')->getSchedules();
	}
	
	public function getSchedulesByDay($day)
	{
		return $this->getResource('Schedules')->getSchedulesByDay($day);
	}
	
	public function deleteSchedule($id) {
		return $this->getResource('Schedules')->deleteSchedule($id);
	}
	
	public function saveSchedule(array $data) 
	{
		//Set some defaults
		$defaults = array("heatingOn" => 0, "waterOn" => 0, "enabled" => 0);
		return $this->saveRow($data, $defaults);
	}
	
	private function saveRow(array $data, array $defaults = array()) 
	{
		foreach ($data as $item) {
			if (!is_numeric($item)) {
				return false;
			}
		}
		
		if (!array_key_exists("hourOn", $data) || !array_key_exists("minuteOn", $data) ||
				!array_key_exists("hourOff", $data) || !array_key_exists("minuteOff", $data)) {
			return false;
		}
		
		$minuteOn = $data['hourOn'] * 60 + $data['minuteOn'];
		$minuteOff = $data['hourOff'] * 60 + $data['minuteOff'];
		
		if ($minuteOff <= $minuteOn) {
			throw new Exception("Off time must be after the on time");
		}
		
		// apply any defaults
		foreach ($defaults as $col => $value) {
			if (!key_exists($col, $data)) {
				$data[$col] = $value;
			}
		}
		
		$row = null;
		if (array_key_exists("id", $data)) {
			$row = $this->getScheduleById($data["id"]);
		}
		if (!is_null($row)) {
			return $this->getResource('Schedules')->saveRow($data, $row);
		}
		
		return $this->getResource('Schedules')->saveRow($data);
	}
}