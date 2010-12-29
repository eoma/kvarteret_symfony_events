<?php

require_once dirname(__FILE__).'/../lib/festivalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/festivalGeneratorHelper.class.php';

/**
 * festival actions.
 *
 * @package    kvarteret_events
 * @subpackage festival
 * @author     Endre Oma
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class festivalActions extends autoFestivalActions
{

  public function preExecute() {
    parent::preExecute();

    $this->configuration->setUser($this->getUser());
  }

  public function executeShow (sfWebRequest $request)
  {
    $this->festival = $this->getRoute()->getObject();
  }

}
