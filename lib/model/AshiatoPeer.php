<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class AshiatoPeer extends BaseAshiatoPeer
{
  public static function getAshiatoMemberListPager($memberId, $page = 1, $size = 30)
  {
    $date = array();
    $c = new Criteria();
    $c->clearSelectColumns()->addSelectColumn(AshiatoPeer::R_DATE);
    $c->add(AshiatoPeer::MEMBER_ID_TO, $memberId);
    $c->addDescendingOrderByColumn(AshiatoPeer::R_DATE);
    $c->setDistinct();
    $c->setLimit($size);
    $stmt = self::doSelectStmt($c);
    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
      $date[] = $row[0];
    }

    $c2 = new Criteria();
    $c2->clearSelectColumns();
    $c2->add(AshiatoPeer::MEMBER_ID_TO, $memberId);
    $c2->add(AshiatoPeer::R_DATE,$date,Criteria::IN);
    $c2->addGroupByColumn(AshiatoPeer::MEMBER_ID_FROM);
    $c2->addGroupByColumn(AshiatoPeer::R_DATE);
    $c2->addDescendingOrderByColumn(AshiatoPeer::UPDATED_AT);

    $pager = new sfPropelPager('Ashiato', $size);
    $pager->setPeerMethod('doSelectJoinMemberRelatedByMemberIdFrom');
    $pager->setCriteria($c2);
    
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public static function doSelectJoinMemberRelatedByMemberIdFrom(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {

    foreach (sfMixer::getCallables('BaseAshiatoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAshiatoPeer', $c, $con);
    }


    $c = clone $c;

    if ($c->getDbName() == Propel::getDefaultDB()) {
      $c->setDbName(self::DATABASE_NAME);
    }

    $c->addSelectColumn(AshiatoPeer::ID);
    $c->addSelectColumn(AshiatoPeer::MEMBER_ID_FROM);
    $c->addSelectColumn(AshiatoPeer::MEMBER_ID_TO);
    $c->addSelectColumn(AshiatoPeer::R_DATE);
    $c->addSelectColumn('MAX(' . AshiatoPeer::UPDATED_AT . ')');
    $startcol = (AshiatoPeer::NUM_COLUMNS - AshiatoPeer::NUM_LAZY_LOAD_COLUMNS);
    MemberPeer::addSelectColumns($c);

    $c->addJoin(array(AshiatoPeer::MEMBER_ID_FROM,), array(MemberPeer::ID,), $join_behavior);
    $stmt = BasePeer::doSelect($c, $con);
    $results = array();

    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
      $key1 = AshiatoPeer::getPrimaryKeyHashFromRow($row, 0);
      if (null !== ($obj1 = AshiatoPeer::getInstanceFromPool($key1))) {
                              } else {

        $omClass = AshiatoPeer::getOMClass();

        $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
        $obj1 = new $cls();
        $obj1->hydrate($row);
        AshiatoPeer::addInstanceToPool($obj1, $key1);
      } 
      $key2 = MemberPeer::getPrimaryKeyHashFromRow($row, $startcol);
      if ($key2 !== null) {
        $obj2 = MemberPeer::getInstanceFromPool($key2);
        if (!$obj2) {

          $omClass = MemberPeer::getOMClass();

          $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
          $obj2 = new $cls();
          $obj2->hydrate($row, $startcol);
          MemberPeer::addInstanceToPool($obj2, $key2);
        } 
                $obj2->addAshiatoRelatedByMemberIdFrom($obj1);

      } 
      $results[] = $obj1;
    }
    $stmt->closeCursor();
    return $results;
  }

  public static function getAshiatoMemberListCount($memberId)
  {
    $c = new Criteria();
    $c->add(AshiatoPeer::MEMBER_ID_TO, $memberId);
    return AshiatoPeer::doCount($c);
  }

  public static function setAshiatoMember($memberIdTo, $memberIdFrom)
  {
    if ($memberIdTo == $memberIdFrom) {
      return false;
    }
    //$this->ashiatoConfigUpdate_span->getValue()
    $c = new Criteria();
    $wait = date('Y-m-d H:i:s', strtotime('-' . sfConfig::get('app_update_span_minute') . 'minute'));
    $c->add(AshiatoPeer::MEMBER_ID_FROM, $memberIdFrom);
    $c->add(AshiatoPeer::MEMBER_ID_TO, $memberIdTo);
    $c->add(AshiatoPeer::UPDATED_AT, $wait, Criteria::GREATER_THAN);
    $stmt = self::doSelectStmt($c);

    if(self::doCount($c)){
      return false;
    }

    $ashiato = new Ashiato();
    $ashiato->setMemberIdFrom($memberIdFrom);
    $ashiato->setMemberIdTo($memberIdTo);
    $ashiato->setRDate(time());
    $ashiato->save();
    return $ashiato->getID();

  }

}
