<?php

/**
 * ashiato actions.
 *
 * @package    OpenPNE
 * @subpackage ashiato
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
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
    $this->pager = AshiatoPeer::getAshiatoMemberListPager($this->id, $request->getParameter('page', 1), sfConfig::get('mod_ashiato_max_ashiato'));
    if (!$this->pager->getNbResults())
    {
      return sfView::ERROR;
    }

    $this->count = AshiatoPeer::getAshiatoMemberListCount($this->id);

    return sfView::SUCCESS;
  }
}
