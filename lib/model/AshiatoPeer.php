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
    $c = new Criteria();
    $c->add(AshiatoPeer::MEMBER_ID_TO, $memberId);
    
    $pager = new sfPropelPager('Ashiato', $size);
    $pager->setPeerMethod('doSelectJoinMemberRelatedByMemberIdFrom');
    $pager->setCriteria($c);
    
    $pager->setPage($page);
    $pager->init();

    return $pager;
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
    $wait = date('Y-m-d H:i:s', strtotime('-' . sfConfig::get('update_span_minute')));
    $c->add(AshiatoPeer::MEMBER_ID_FROM, $memberIdFrom);
    $c->add(AshiatoPeer::MEMBER_ID_TO, $memberIdTo);
    $c->add(AshiatoPeer::UPDATED_AT, $wait, Criteria::LESS_THAN);
    if(self::doSelectOne($c)){
      return false;
    }

    $ashiato = new Ashiato();
    $ashiato->setMemberIdFrom($memberIdFrom);
    $ashiato->setMemberIdTo($memberIdTo);
    $ashiato->save();
    return $ashiato->getID();

  }

}