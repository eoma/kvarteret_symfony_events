<?php

/**
 * category actions.
 *
 * @package    kvarteret_events
 * @subpackage category
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->categorys = Doctrine_Core::getTable('category')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->category = Doctrine_Core::getTable('category')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->category);
    $this->events = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, a.name, l.name')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.recurringLocation l')
      ->where('e.category_id = ?', $request->getParameter('id'))
      ->andWhere('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->limit(20)
      ->offset(0)
      ->execute();
  }
}
