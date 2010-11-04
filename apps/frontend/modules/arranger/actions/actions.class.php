<?php

/**
 * arranger actions.
 *
 * @package    kvarteret_events
 * @subpackage arranger
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arrangerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->arrangers = Doctrine_Core::getTable('arranger')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->arranger = Doctrine_Core::getTable('arranger')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->arranger);
    $this->events = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, c.name, l.name')
      ->leftJoin('e.category c')
      ->leftJoin('e.recurringLocation l')
      ->where('e.arranger_id = ?', $request->getParameter('id'))
      ->andWhere('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->limit(20)
      ->offset(0)
      ->execute();
  }
}
