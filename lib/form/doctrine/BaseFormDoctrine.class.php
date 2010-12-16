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

  protected function CKEditorToolbarBasic () {
    return array(array('Source', 'RemoveFormat', '-', 'Copy', 'Cut', 'Paste', 'PasteText', 'PasteFromWord'));
  }

  protected function CKEditorToolbarCommon () {
    return array(array('Source', 'RemoveFormat', '-', 'Copy', 'Cut', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'NumberedList','BulletedList','-','Outdent','Indent','Blockquote', '-', 'Image', 'Link', 'Unlink'));
  }


  public function setup()
  {
  }
}
