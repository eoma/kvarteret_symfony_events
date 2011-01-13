<?php

/**
 * sfGuardUser module configuration.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id$
 */
class sfGuardUserGeneratorConfiguration extends BaseSfGuardUserGeneratorConfiguration
{

  protected $user = null;

  public function setUser(sfUser $user)
  {
    $this->user = $user;
  }

  public function getUser()
  {
    return $this->user;
  }

  public function getEditDisplay()
  {
    $fieldsets = parent::getEditDisplay();
    if (!$this->getUser()->hasCredential('admin'))
    {
      unset(
        $fieldsets['User'][3], // username field
        $fieldsets['Permissions and groups']   // field group
      );
    }

    return $fieldsets;
   }
 
  /*public function getNewDisplay()
  {
    ... // see getEditDisplay
  }*/
 
  public function getFormOptions()
  {
    return array('user' => $this->getUser());
  }

}
