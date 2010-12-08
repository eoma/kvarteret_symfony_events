<?php

/**
 * requirementPhotography form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class requirementPhotographyForm extends BaserequirementPhotographyForm
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

    $meetAt = array( 'date' => date('Y-m-d', time() + 86400), 'time' => '19:00' );
    $meetAt = $this->getOption( 'meetAt', $meetAt );

    $this->setDefault('meetAtDate', $meetAt['date']);
    $this->setDefault('meetAtTime', $meetAt['time']);

  }
}
