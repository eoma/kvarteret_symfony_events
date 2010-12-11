<?php

require_once dirname(__FILE__).'/../lib/eventGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/eventGeneratorHelper.class.php';

/**
 * event actions.
 *
 * @package    kvarteret_events
 * @subpackage event
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventActions extends autoEventActions
{

  public function preExecute() {
    parent::preExecute();

    $this->configuration->setUser($this->getUser());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(null, array('currentUser' => $this->getUser()));
    $this->event = $this->form->getObject();
    
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm(null, array('currentUser' => $this->getUser()));
    $this->event = $this->form->getObject();
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->event = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->event, array('currentUser' => $this->getUser()));
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->event = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->event, array('currentUser' => $this->getUser()));

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function buildQuery()
  {
    $query = parent::buildQuery();
    // do what ever you like with the query like

    if ( $this->getUser()->isAuthenticated() && ! $this->getUser()->hasGroup('admin') ) {
      $arrangerUsersRowBased = Doctrine_Core::getTable('arrangerUser')
                             ->createQuery('au')
                             ->select('au.arranger_id')
                             ->where('au.user_id = ?', $this->getUser()->getGuardUser()->getId())
                              ->fetchArray();

      $arrangerUsersColumnbased = array();
      foreach ($arrangerUsersRowBased as $v) {
        $arrangerUsersColumnBased[] = $v['arranger_id'];
      }

      if ( ! empty($arrangerUsersColumnsBased) ) {
        $query->andWhereIn('arranger_id', $arrangerUsersColumnBased);
      } else {
        // No events can be created with arranger_id set to null
        $query->andWhere('arranger_id is null');
      }
    }
    return $query;
  }


}
