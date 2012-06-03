<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 *
 * @since      File available since Release 1.1.1
 */

/**
 * opRemoveAshiato
 *
 * @package    OpenPNE
 * @subpackage opAshiatoPlugin
 * @author     Hidenori Goto <hidenorigoto@gmail.com>
 * @since      Class available since Release 1.1.1
 */
class opRemoveAshiato
{
  static public function listenToPreActionEventRetriveMemberById($arguments)
  {
    $request = $arguments['actionInstance']->getRequest();
    if (!$request->isMethod('post'))
    {
      return;
    }

    $targetMemberId = $request->getParameter('id');
    Doctrine::getTable('Ashiato')->removeAshiatoForDeletedMember($targetMemberId);
  }
}
