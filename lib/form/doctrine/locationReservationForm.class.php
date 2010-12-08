<?php

/**
 * locationReservation form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locationReservationForm extends BaselocationReservationForm
{

  protected $scheduledRequirementsForDeletion = array();

  public function configure()
  {

    $this->removeTimestamps();

    // Set default start and end date to the next day
    $this->setDefault('accessDate', date('Y-m-d', time() + 86400));
    $this->setDefault('accessTime', '19:00');
    $this->setDefault('startDate', date('Y-m-d', time() + 86400));
    $this->setDefault('startTime', '19:00');
    $this->setDefault('endDate', date('Y-m-d', time() + 86400));
    $this->setDefault('endTime', '21:00');

  }
}
