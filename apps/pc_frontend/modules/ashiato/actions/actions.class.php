<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * ashiato actions.
 *
 * @package    OpenPNE
 * @subpackage ashiato
 * @author     Satoru Yamane <yamane@icz.co.jp>
 */
class ashiatoActions extends sfActions
{
 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */
  public function executeList($request)
  {
    $this->id = $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());
    $this->forward404Unless($this->id === $this->getUser()->getMemberId());

    $this->pager = AshiatoPeer::getAshiatoMemberListPager($this->id, $request->getParameter('page', 1), sfConfig::get('mod_ashiato_max_ashiato'));
    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }

    $this->count = AshiatoPeer::getAshiatoMemberListCount($this->id);

    return sfView::SUCCESS;
  }
}
