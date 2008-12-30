<?php


abstract class BaseAshiato extends BaseObject  implements Persistent {


  const PEER = 'AshiatoPeer';

	
	protected static $peer;

	
	protected $id;

	
	protected $member_id_from;

	
	protected $member_id_to;

	
	protected $updated_at;

	
	protected $aMemberRelatedByMemberIdFrom;

	
	protected $aMemberRelatedByMemberIdTo;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getId()
	{
		return $this->id;
	}

	
	public function getMemberIdFrom()
	{
		return $this->member_id_from;
	}

	
	public function getMemberIdTo()
	{
		return $this->member_id_to;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
									return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AshiatoPeer::ID;
		}

		return $this;
	} 
	
	public function setMemberIdFrom($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->member_id_from !== $v) {
			$this->member_id_from = $v;
			$this->modifiedColumns[] = AshiatoPeer::MEMBER_ID_FROM;
		}

		if ($this->aMemberRelatedByMemberIdFrom !== null && $this->aMemberRelatedByMemberIdFrom->getId() !== $v) {
			$this->aMemberRelatedByMemberIdFrom = null;
		}

		return $this;
	} 
	
	public function setMemberIdTo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->member_id_to !== $v) {
			$this->member_id_to = $v;
			$this->modifiedColumns[] = AshiatoPeer::MEMBER_ID_TO;
		}

		if ($this->aMemberRelatedByMemberIdTo !== null && $this->aMemberRelatedByMemberIdTo->getId() !== $v) {
			$this->aMemberRelatedByMemberIdTo = null;
		}

		return $this;
	} 
	
	public function setUpdatedAt($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			
			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AshiatoPeer::UPDATED_AT;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->member_id_from = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->member_id_to = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ashiato object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aMemberRelatedByMemberIdFrom !== null && $this->member_id_from !== $this->aMemberRelatedByMemberIdFrom->getId()) {
			$this->aMemberRelatedByMemberIdFrom = null;
		}
		if ($this->aMemberRelatedByMemberIdTo !== null && $this->member_id_to !== $this->aMemberRelatedByMemberIdTo->getId()) {
			$this->aMemberRelatedByMemberIdTo = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AshiatoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AshiatoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aMemberRelatedByMemberIdFrom = null;
			$this->aMemberRelatedByMemberIdTo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AshiatoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AshiatoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public function save(PropelPDO $con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(AshiatoPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AshiatoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			AshiatoPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aMemberRelatedByMemberIdFrom !== null) {
				if ($this->aMemberRelatedByMemberIdFrom->isModified() || $this->aMemberRelatedByMemberIdFrom->isNew()) {
					$affectedRows += $this->aMemberRelatedByMemberIdFrom->save($con);
				}
				$this->setMemberRelatedByMemberIdFrom($this->aMemberRelatedByMemberIdFrom);
			}

			if ($this->aMemberRelatedByMemberIdTo !== null) {
				if ($this->aMemberRelatedByMemberIdTo->isModified() || $this->aMemberRelatedByMemberIdTo->isNew()) {
					$affectedRows += $this->aMemberRelatedByMemberIdTo->save($con);
				}
				$this->setMemberRelatedByMemberIdTo($this->aMemberRelatedByMemberIdTo);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AshiatoPeer::ID;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AshiatoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AshiatoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aMemberRelatedByMemberIdFrom !== null) {
				if (!$this->aMemberRelatedByMemberIdFrom->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMemberRelatedByMemberIdFrom->getValidationFailures());
				}
			}

			if ($this->aMemberRelatedByMemberIdTo !== null) {
				if (!$this->aMemberRelatedByMemberIdTo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMemberRelatedByMemberIdTo->getValidationFailures());
				}
			}


			if (($retval = AshiatoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AshiatoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getMemberIdFrom();
				break;
			case 2:
				return $this->getMemberIdTo();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AshiatoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMemberIdFrom(),
			$keys[2] => $this->getMemberIdTo(),
			$keys[3] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AshiatoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setMemberIdFrom($value);
				break;
			case 2:
				$this->setMemberIdTo($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AshiatoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMemberIdFrom($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMemberIdTo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AshiatoPeer::DATABASE_NAME);

		if ($this->isColumnModified(AshiatoPeer::ID)) $criteria->add(AshiatoPeer::ID, $this->id);
		if ($this->isColumnModified(AshiatoPeer::MEMBER_ID_FROM)) $criteria->add(AshiatoPeer::MEMBER_ID_FROM, $this->member_id_from);
		if ($this->isColumnModified(AshiatoPeer::MEMBER_ID_TO)) $criteria->add(AshiatoPeer::MEMBER_ID_TO, $this->member_id_to);
		if ($this->isColumnModified(AshiatoPeer::UPDATED_AT)) $criteria->add(AshiatoPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AshiatoPeer::DATABASE_NAME);

		$criteria->add(AshiatoPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMemberIdFrom($this->member_id_from);

		$copyObj->setMemberIdTo($this->member_id_to);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AshiatoPeer();
		}
		return self::$peer;
	}

	
	public function setMemberRelatedByMemberIdFrom(Member $v = null)
	{
		if ($v === null) {
			$this->setMemberIdFrom(NULL);
		} else {
			$this->setMemberIdFrom($v->getId());
		}

		$this->aMemberRelatedByMemberIdFrom = $v;

						if ($v !== null) {
			$v->addAshiatoRelatedByMemberIdFrom($this);
		}

		return $this;
	}


	
	public function getMemberRelatedByMemberIdFrom(PropelPDO $con = null)
	{
		if ($this->aMemberRelatedByMemberIdFrom === null && ($this->member_id_from !== null)) {
			$c = new Criteria(MemberPeer::DATABASE_NAME);
			$c->add(MemberPeer::ID, $this->member_id_from);
			$this->aMemberRelatedByMemberIdFrom = MemberPeer::doSelectOne($c, $con);
			
		}
		return $this->aMemberRelatedByMemberIdFrom;
	}

	
	public function setMemberRelatedByMemberIdTo(Member $v = null)
	{
		if ($v === null) {
			$this->setMemberIdTo(NULL);
		} else {
			$this->setMemberIdTo($v->getId());
		}

		$this->aMemberRelatedByMemberIdTo = $v;

						if ($v !== null) {
			$v->addAshiatoRelatedByMemberIdTo($this);
		}

		return $this;
	}


	
	public function getMemberRelatedByMemberIdTo(PropelPDO $con = null)
	{
		if ($this->aMemberRelatedByMemberIdTo === null && ($this->member_id_to !== null)) {
			$c = new Criteria(MemberPeer::DATABASE_NAME);
			$c->add(MemberPeer::ID, $this->member_id_to);
			$this->aMemberRelatedByMemberIdTo = MemberPeer::doSelectOne($c, $con);
			
		}
		return $this->aMemberRelatedByMemberIdTo;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aMemberRelatedByMemberIdFrom = null;
			$this->aMemberRelatedByMemberIdTo = null;
	}

} 