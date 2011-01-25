<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Event Admin Interface</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('admin.css') ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div id="menu">
          <ul>
            <?php if ($sf_user->isAuthenticated()): ?>
            <!-- only show the meny when authenticated -->
            <li>
              <?php echo link_to('Events', 'dak_event_admin') ?>
            </li>
            <li>
              <?php echo link_to('Festivals', 'dak_festival_admin') ?>
            </li>
            <li>
              <?php echo link_to('Categories', 'dak_category_admin') ?>
            </li>
            <li>
              <?php echo link_to('Arrangers', 'dak_arranger_admin') ?>
            </li>
            <li>
              <?php echo link_to('Locations', 'dak_location_admin') ?>
            </li>
            <li>
              <?php echo link_to('Location reservations', 'dak_location_reservation_admin') ?>
            </li>
            <li>
              <?php echo link_to('Pictures', 'dak_picture_admin') ?>
            </li>
            <li>
            <?php if ($sf_user->isSuperAdmin()): ?>
            <!-- If the user is a super admin we show the group and permission pages -->
            <li>
              <?php echo link_to('Users', 'sf_guard_user') ?>
            </li>
            <li>
              <?php echo link_to('Groups', 'sf_guard_group') ?>
            </li>
            <li>
              <?php echo link_to('Permissions', 'sf_guard_permission') ?>
            </li>
            <?php endif ?>
            <li>
              <?php echo link_to('Logout', 'sf_guard_signout') ?>
            </li>
            <?php endif ?> 
	    <li>
              <a href="<?php echo public_path('', true) ?>">Frontend</a>
            </li>
          </ul>
        </div>
      </div>
      <div id="content">
        <?php echo $sf_content ?>
      </div>
 
      <div id="footer">
        <img src="/images/jobeet-mini.png" />
        powered by <a href="http://www.symfony-project.org/">
        <img src="/images/symfony.gif" alt="symfony framework" /></a>
      </div>
    </div>
    <?php include_javascripts() ?>
  </body>
</html>
