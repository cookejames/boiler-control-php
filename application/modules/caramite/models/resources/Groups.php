<?php
class Caramite_Resource_Groups extends SF_Model_Resource_Db_Table_Abstract
{
	protected $_name = 'schedule_groups';
	protected $_primary = 'id';
	protected $_rowClass = 'Caramite_Resource_Groups_Item';
	protected $_nameColumn = "name";

// 	protected $_referenceMap = array(
// 			'Project' => array(
// 					'columns' 		=> 'project',
// 					'refTableClass' => 'Caramite_Resource_Projects',
// 					'refColumns' 	=> 'id'
// 			),
// 	);
	
	public function getGroups()
	{
		$select = $this->select();
		$select->order(array($this->_nameColumn . ' ASC'));
		return $this->fetchAll($select);
	}
	
	public function getGroupByName($name)
	{
		$select = $this->select();
		$select->where("name=?",$name);
		return $this->fetchRow($select);
	}
	
	public function getGroupById($id)
	{
		$select = $this->select();
		$select->where("id=?",$id);
		return $this->fetchRow($select);
	}
	
	public function deleteGroup($id)
	{
		$where = $this->getAdapter()->quoteInto("`id` = ?", $id);
		return $this->delete($where);
	}
}