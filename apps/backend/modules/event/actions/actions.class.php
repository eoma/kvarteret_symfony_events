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
  public function executeCreate(sfWebRequest $request)
  {
	$this->form = $this->configuration->getForm(null, array('currentUser' => $this->getUser()));
    $this->event = $this->form->getObject();
    
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
}
