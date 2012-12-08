<?php

$backendRoute = public_path('', true) . '/backend.php';
if (sfConfig::get('app_applicationLinks_backend')) {
	$backendRoute = sfConfig::get('app_applicationLinks_backend');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?> - <?php echo __('Event Calendar') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php use_stylesheet('main.css', 'last') ?>
    <?php include_stylesheets() ?>
    <!-- Start include javascript -->
    <?php include_javascripts() ?>
    <!-- End include javascript -->
    <?php include_slot('feeds') ?>
  </head>
  <body>
    <div id="header">
      <div id="menu">
        <ul>
          <li><?php echo link_to(__('Main'), '@dak_event_index') ?></li>
          <li><?php echo link_to(__('Festivals'), '@dak_festival_index') ?></li>
          <li><?php echo link_to(__('Locations'), '@dak_location_index') ?></li>
          <li><?php echo link_to(__('Arrangers'), '@dak_arranger_index') ?></li>
          <li><?php echo link_to(__('Categories'), '@dak_category_index') ?></li>
          <li><?php echo link_to(__('API documentation'), 'dak_api') ?></li>
          <li><a href="<?php echo $backendRoute ?>">Backend</a></li>
        </ul>
      </div>
    </div>
    <div id="content">
      <?php echo $sf_content ?>
    </div>

    <div id="footer" style="clear: both">
      <ul>
        <li><?php echo link_to('View in english', '@dak_event_index?sf_culture=en') ?></li>
        <li><?php echo link_to('Vis på norsk', '@dak_event_index?sf_culture=no') ?></li>
      </ul>
    </div>
  </body>
</html>
