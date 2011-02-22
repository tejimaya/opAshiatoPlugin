<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opAshiatoPluginAshiatoActions
 *
 * @package    OpenPNE
 * @subpackage action
 * @author     Shingo Yamada <s.yamada@tejimaya.com>
 */

abstract class opAshiatoPluginAshiatoActions extends sfActions
{
 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */
  public function executeList($request)
  {
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());

    $this->forward404Unless($this->id === $this->getUser()->getMemberId());
    $this->pager = Doctrine::getTable('Ashiato')->getAshiatoListPager(
      $this->id,
      $request->getParameter('page'),
      sfConfig::get('mod_ashiato_max_ashiato')
    );

    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }

    $this->count = (int)$this->getUser()->getMember()->getConfig('op_ashiato_count');
    if (!$this->count)
    {
      $this->count = Doctrine::getTable('Ashiato')->getAshiatoMemberListCount($this->id);
    }

    return sfView::SUCCESS;
  }
}
