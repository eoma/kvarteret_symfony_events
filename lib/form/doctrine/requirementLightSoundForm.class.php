<?php

/**
 * requirementLightSound form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class requirementLightSoundForm extends BaserequirementLightSoundForm
{
  /**
   * @see locationReservationRequirementForm
   */
  public function configure()
  {
    $this->removeTimestamps();
    
    if ( $this->getOption( 'hideLocationReservation', false ) ) {
      // Unsetting the locationReservation_id. Remember to set correct value in doBind() of the "parent" form
      // using this form
      unset($this->widgetSchema['locationReservation_id']);
    }

    // It should be possible for parent forms to set default dates and times via the use of options
    $soundCheck = array( 'date' => date('Y-m-d', time() + 86400), 'time' => '19:00' );
    $soundCheck = $this->getOption( 'soundCheck', $soundCheck );

    $getIn = array( 'date' => date('Y-m-d', time() + 86400), 'time' => '19:00' );
    $getIn = $this->getOption( 'getIn', $getIn );

    $this->setDefault('soundCheckDate', $soundCheck['date']);
    $this->setDefault('soundCheckTime', $soundCheck['time']);
    $this->setDefault('getInDate', $getIn['date']);
    $this->setDefault('getInTime', $getIn['time']);
  }
}
