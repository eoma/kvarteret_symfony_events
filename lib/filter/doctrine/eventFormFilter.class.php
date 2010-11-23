<?php

/**
 * event filter form.
 *
 * @package    kvarteret_events
 * @subpackage filter
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventFormFilter extends BaseeventFormFilter
{
  public function configure()
  {
    if (!($this->getOption('currentUser')) instanceof sfGuardSecurityUser) {
      throw new InvalidArgumentException("You must pass a user object as an option to this form!");
    }

    if ( ! $this->getOption('currentUser')->hasGroup('admin') ) {
      // Widget arranger_is of type sfWidgetFormDoctrineChoice, which supports queries.
      // If the user is not an admin, we make sure to only use
      // the arrangers the user is limited to.
      $user = $this->getOption('currentUser')->getGuardUser();

      $this->widgetSchema['arranger_id']->setOption('query',
        Doctrine_Core::getTable('arranger')->createQuery('a')->select('a.*')->leftJoin('a.users u')->where('u.user_id = ?', $user->getId())
      );
    }

  }
}
