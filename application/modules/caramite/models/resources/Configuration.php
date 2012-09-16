<?php
class Caramite_Resource_Configuration extends SF_Model_Resource_Db_Table_Abstract
{
	protected $_name = 'configuration';
	protected $_primary = 'key';
	protected $_rowClass = 'Caramite_Resource_Configuration_Item';

	public function getConfigurations()
	{
		$select = $this->select();
		$select->order(array('key ASC'));
		return $this->fetchAll($select);
	}
	
	public function getConfigurationByKey($key)
	{
		$select = $this->select();
		$select->where("`key`=?",$key);
		return $this->fetchRow($select);
	}
	
	public function deleteConfiguration($key)
	{
		$where = $this->getAdapter()->quoteInto("`key` = ?", $key);
		return $this->delete($where);
	}
}