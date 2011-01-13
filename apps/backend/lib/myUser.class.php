<?php

class myUser extends sfGuardSecurityUser
{

  private $arrangerIds = null;

  // Taken from http://halestock.wordpress.com/2010/02/08/symfony-understanding-permissionscredentials-with-sfdoctrineguardplugin/#comment-26

  public function hasCredential($credentials, $useAnd = true)
  {
    return ( parent::hasCredential($credentials, $useAnd) || self::hasPermission($credentials, $useAnd) );
  }

  public function hasPermission($permissions, $useAnd = true)
  {
    if (!is_array($permissions))
    {
      return parent::hasPermission($permissions);
    }

    // now we assume that $permissions is an array
    $test = false;

    foreach ($permissions as $permission)
    {
      // recursively check the permission with a switched AND/OR mode
      $test = self::hasPermission($permission,$useAnd ? false : true);

      if ($useAnd)
      {
        $test = $test ? false : true;
      }

      if ($test) // either passed one in OR mode or failed one in AND mode
      {
        break; // the matter is settled
      }
    }

    if ($useAnd) // in AND mode we succeed if $test is false
    {
      $test = $test ? false : true;
    }

    return $test;
  }
}
