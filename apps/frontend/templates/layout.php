<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="menu">
      <ul>
        <li><?php echo link_to('Main', '@homepage') ?></li>
        <li><?php echo link_to('Locations', 'location/index') ?></li>
        <li><?php echo link_to('Arrangers', 'arranger/index') ?></li>
        <li><?php echo link_to('Categories', 'category/index') ?></li>
      </ul>
    </div>
    <div id="content">
      <?php echo $sf_content ?>
    </div>

    <!-- Start include javascript -->
    <?php include_javascripts() ?>
    <!-- End include javascript -->
  </body>
</html>
