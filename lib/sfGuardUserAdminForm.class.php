<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {

    if (!$this->getOption('user')->hasCredential('admin'))
    {
      unset($this['username'], $this['is_super_admin'], $this['is_active'], $this['groups_list'], $this['permissions_list']);
    }

  }
}
