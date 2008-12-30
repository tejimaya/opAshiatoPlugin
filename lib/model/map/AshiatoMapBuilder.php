<?php



class AshiatoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.opAshiatoPlugin.lib.model.map.AshiatoMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(AshiatoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(AshiatoPeer::TABLE_NAME);
		$tMap->setPhpName('Ashiato');
		$tMap->setClassname('Ashiato');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addForeignKey('MEMBER_ID_FROM', 'MemberIdFrom', 'INTEGER', 'member', 'ID', true, null);

		$tMap->addForeignKey('MEMBER_ID_TO', 'MemberIdTo', 'INTEGER', 'member', 'ID', true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} 
} 