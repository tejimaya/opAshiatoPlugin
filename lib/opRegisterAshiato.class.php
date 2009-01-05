<?php

/**
 * opRegisterAshiato
 *
 * @package    OpenPNE
 * @subpackage opAshiatoPlugin
 * @author     Satoru Yamane <yamane@icz.co.jp>
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 */
class opRegisterAshiato
{
  static public function listenToPostActionEventRetriveMemberById($arguments)
  {
    $id = $arguments['actionInstance']->getRequest()->getParameter('id');
    self::setAshiatoToId($arguments, $id);
  }

  static public function listenToPostActionEventRetriveMemberByMemberId($arguments)
  {
    $id = $arguments['actionInstance']->getRequest()->getParameter('member_id');
    self::setAshiatoToId($arguments, $id);
  }

  static public function listenToPostActionEventRetriveMemberByDiary($arguments)
  {
    $diary = $arguments['actionInstance']->getVar('diary');
    if ($diary)
    {
      self::setAshiatoToId($arguments, $diary->getMemberId());
    }
  }

  static public function setAshiatoToId($arguments, $id)
  {
    if (!$id || $arguments['result'] !== sfView::SUCCESS)
    {
      return false;
    }

    $memberIdTo = $id;
    $memberIdFrom = $arguments['actionInstance']->getUser()->getMemberId();
    AshiatoPeer::setAshiatoMember($memberIdTo, $memberIdFrom);
  }
}
