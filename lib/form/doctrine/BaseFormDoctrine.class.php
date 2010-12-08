<?php

/**
 * Project form base class.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{

  /**
   * Removes the timestamp fields in the form
   */
  protected function removeTimestamps () 
  {
    unset(
      $this['created_at'],
      $this['updated_at']
    );
  }

  public function setup()
  {
  }
}
