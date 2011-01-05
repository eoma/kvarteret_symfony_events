<?php

require_once dirname(__FILE__).'/../lib/arrangerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/arrangerGeneratorHelper.class.php';

/**
 * arranger actions.
 *
 * @package    kvarteret_events
 * @subpackage arranger
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arrangerActions extends autoArrangerActions
{

  public function preExecute() {
    parent::preExecute();

    $this->configuration->setUser($this->getUser());
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

      $arrangerUsersColumnBased = array();
      foreach ($arrangerUsersRowBased as $v) {
        $arrangerUsersColumnBased[] = $v['arranger_id'];
      }

      if ( count($arrangerUsersColumnBased) > 0 ) {
        $query->andWhereIn('id', $arrangerUsersColumnBased);
      } else {
        // No events can be created with id set to null
        $query->andWhere('id is null');
      }
    }
    return $query;
  }

}
