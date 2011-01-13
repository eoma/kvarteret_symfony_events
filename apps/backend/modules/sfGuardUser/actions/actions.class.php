<?php

class sfGuardUserActions extends autoSfGuardUserActions
{

  public function preExecute() {
    parent::preExecute();

    $this->configuration->setUser($this->getUser());
  }

  public function getCredential()
  {
    $action = $this->getActionName();
    $user = $this->getUser();

    if (!$user->hasCredential('admin') && in_array($action, array('edit', 'update')))
    {
      $this->sf_guard_user = $this->getRoute()->getObject();

      if ($this->sf_guard_user->getId() == $user->getGuardUser()->getId()) {
        $this->getUser()->addCredential('owner');
      } else {
        $this->getUser()->removeCredential('owner');
      }
    }
 
    // the hijack is over, let the normal flow continue:
    return parent::getCredential();
  }

  protected function buildQuery()
  {
    $query = parent::buildQuery();
    // do what ever you like with the query like

    if ( $this->getUser()->isAuthenticated() && ! $this->getUser()->hasGroup('admin') ) {
      $query->andWhere( $query->getRootAlias() . '.id = ?', $this->getUser()->getGuardUser()->getId());
    }
    return $query;
  }

}
