<?php

/**
 * location actions.
 *
 * @package    kvarteret_events
 * @subpackage location
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->locations = Doctrine_Core::getTable('location')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->location = Doctrine_Core::getTable('location')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->location);
    $this->events = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, a.name, c.name')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.category c')
      ->where('e.location_id = ?', $request->getParameter('id'))
      ->andWhere('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->limit(20)
      ->offset(0)
      ->execute();
    //$this->events = $this->location->getEvents();
  }
}
