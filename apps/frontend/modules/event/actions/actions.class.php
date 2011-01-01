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

    if ( ! $request->getParameter('sf_culture') )
    {
      if ( $this->getUser()->isFirstRequest() )
      {
        $culture = $request->getPreferredCulture(array('en', 'no'));
        $this->getUser()->setCulture($culture);
        $this->getUser()->isFirstRequest(false);
      }
      else
      {
        $culture = $this->getUser()->getCulture();
      }
 
      $this->redirect('homepage_localized');
    }

    $this->events = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, a.name, l.name, c.name, u.name')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.recurringLocation l')
      ->leftJoin('e.categories c')
      ->where('e.startDate >= ? OR e.endDate >= ?', array(date('Y-m-d'), date('Y-m-d')))
      ->orderBy('e.startDate asc, e.startTime asc, e.title asc, c.name asc')
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    // Instead of using objects we'll be using associative arrays
    // because of performance on the public interface.
    $this->event = Doctrine_Core::getTable('event')
      ->createQuery('e')
      ->select('e.*, a.name, l.name, c.name, u.name')
      ->leftJoin('e.arranger a')
      ->leftJoin('e.recurringLocation l')
      ->leftJoin('e.categories c')
      ->where('e.id = ?', $request->getParameter('id'))
      ->orderBy('c.name asc')
      ->setHydrationMode(Doctrine_Core::HYDRATE_ARRAY)
      ->fetchOne();

    $this->forward404Unless($this->event);
  }

}
