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

}
