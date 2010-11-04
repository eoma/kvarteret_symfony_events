<?php

/**
 * event form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventForm extends BaseeventForm
{
  public function configure()
  {

    unset(
      $this['created_at'], $this['updated_at']
    );

    $this->setDefault('startDate', date('Y-m-d'));
    $this->setDefault('endDate', date('Y-m-d'));

  }
}
