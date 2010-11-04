<?php

/**
 * arranger form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arrangerForm extends BasearrangerForm
{
  public function configure()
  {

    unset(
      $this['created_at'], $this['updated_at']
    );

  }
}
