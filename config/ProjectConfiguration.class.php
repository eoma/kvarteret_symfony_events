<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

// Necessary as symfonys autoload methods don't 
if (!defined('HTMLPURIFIER_PREFIX')) {
    define('HTMLPURIFIER_PREFIX', realpath(dirname(__FILE__) . '/../lib/vendor/htmlpurifier/library'));
}

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineNestedSetPlugin');
    $this->enablePlugins('sfCKEditorPlugin');
  }
}
