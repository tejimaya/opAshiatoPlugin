<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PluginAshiatoTable
 * 
 * @package    opAshiatoPlugin
 * @subpackage Ashiato
 * @author     Shingo Yamada <s.yamada@tejimaya.com>
 */
class PluginAshiatoTable extends Doctrine_Table
{
  public function getAshiatoListPager($memberId, $page = 1, $size = 20)
  {
    $day_list = array();
    $q = $this->createQuery()
      ->select('id, r_date')
      ->where('member_id_to = ?', $memberId)
      ->groupBy('r_date DESC')
      ->limit($size);

    foreach ($q->execute(array(), Doctrine::HYDRATE_NONE) as $day)
    {
      $day_list[] = $day[1];
    }

    $q = $this->createQuery()
      ->select('*')
      ->addSelect('MAX(updated_at) as max_updated_at')
      ->where('member_id_to = ?', $memberId)
      ->andWhereIn('r_date', $day_list)
      ->groupBy('member_id_from')
      ->addGroupBy('r_date')
      ->orderBy('max_updated_at DESC');

    $pager = new opNonCountQueryPager('Ashiato', $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public function getAshiatoMemberListCount($memberId)
  {
    $q = $this->createQuery()
      ->where('member_id_to = ?', $memberId);

    return $q->count();
  }

  public function setAshiatoMember($memberIdTo, $memberIdFrom)
  {
    if ($memberIdTo == $memberIdFrom) {
      return false;
    }

    $wait = date('Y-m-d H:i:s', strtotime('-' . sfConfig::get('app_update_span_minute') . 'minute'));
    $q = Doctrine_Query::create()
      ->select('id')
      ->from('ashiato')
      ->where('member_id_to = ?', $memberIdTo)
      ->andwhere('member_id_from = ?', $memberIdFrom)
      ->andWhere('updated_at > ?', $wait)
      ->limit(1);
    if (count($q->execute(array(), Doctrine::HYDRATE_NONE)))
    {
      return false;
    }

    $ashiato = new Ashiato();
    $ashiato->setMemberIdFrom($memberIdFrom);
    $ashiato->setMemberIdTo($memberIdTo);
    $ashiato->setRDate(date('Y-m-d'));
    $ashiato->save();

    return $ashiato->getID();
  }
  
  public function removeAshiatoForDeletedMember($memberIdFrom)
  {
    $this->_conn->execute('SET FOREIGN_KEY_CHECKS = 0');

    $q = Doctrine_Query::create()
      ->update('ashiato')
      ->where('member_id_from = ?', $memberIdFrom)
      ->set('member_id_from', 'null');
    $q->execute(array(), Doctrine::HYDRATE_NONE);

    $q = Doctrine_Query::create()
      ->update('ashiato')
      ->where('member_id_to = ?', $memberIdFrom)
      ->set('member_id_to', 'null');
    $q->execute(array(), Doctrine::HYDRATE_NONE);

    $q = Doctrine_Query::create()
      ->delete()
      ->from('ashiato')
      ->where('member_id_from is null')
      ->andWhere('member_id_to is null');    
    $q->execute(array(), Doctrine::HYDRATE_NONE);

    $this->_conn->execute('SET FOREIGN_KEY_CHECKS = 1');
  }
}
