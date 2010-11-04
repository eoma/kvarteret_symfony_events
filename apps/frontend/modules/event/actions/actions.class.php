<?php

/**
 * event actions.
 *
 * @package    kvarteret_events
 * @subpackage event
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->events = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, a.name, l.name, c.name, u.name')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.recurringLocation l')
      ->leftJoin('e.category c')
      ->where('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->event = Doctrine_Core::getTable('event')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->event);
  }

}
