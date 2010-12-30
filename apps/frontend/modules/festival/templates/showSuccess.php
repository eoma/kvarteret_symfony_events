<?php
use_helper('I18N', 'Date');
?>

<div id="eventData">
  <p>
    <b>Where?</b> 
    <?php 
      if (!$festival['location_id']) {
        echo $festival['customLocation']; 
      } else {
        echo link_to($festival['commonLocation']['name'], 'location/show?id='. $festival['location_id']);
      } 
     ?>
  </p>
  <p>
    <b>When?</b> 
    <?php 
    if ($festival['startDate'] == $festival['endDate']):
    ?>
    <?php echo format_date($festival['startDate']) ?> from <? echo $festival['startTime'] ?> to <?php echo $festival['endTime'] ?>
    <?php else: ?>
    from <?php echo format_date($festival['startDate']) . ' ' . $festival['startTime'] ?> to <?php echo format_date($festival['endDate']) . ' ' . $festival['endTime'] ?>
    <?php endif ?>
  </p>
  <p>
    <b>Who?</b>
  </p>
  <?php
  if (count($festival['arrangers']) > 0) {
    echo "<ul>\n";

    foreach ($festival['arrangers'] as $arranger) {
      echo "<li>" . link_to($arranger['name'], 'arranger/show?id=' . $arranger['id']) . "</li>\n";
    }

    echo "</ul>";
  }
  ?>
  <p>
    <small>Created at <?php echo format_datetime($festival['created_at']) ?>. Updated at <?php echo format_datetime($festival['updated_at']) ?>.</small>
  </p>
  <p>
    <?php echo link_to('Back to list', 'festival/index') ?>
  </p>
</div>

<div id="eventContent">
  <h2><?php echo $festival['title'] ?></h2>

 <?echo $festival->getRaw('leadParagraph'); ?>
 <?echo $festival->getRaw('description'); ?>

  <?php if (!empty($festival['linkout'])): ?>
  <p>Read more <a href="<?php echo $festival['linkout'] ?>">here</a></p>
  <?php endif ?>

  <h2>Events at this festival</h2>

  <?php if (count($events) > 0): ?>
  <table>
    <tbody>
      <?php foreach ($events as $event): ?>
      <tr>
        <td>
          <?php echo link_to($event['title'], 'event/show?id=' . $event['id']) ?><br />
          <?php include_partial('event/startEndDateTime', array('event' => $event)) ?><br />
          Location: <?php include_partial('event/location', array('event' => $event)) ?><br />
          Categories: <?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . " "; } ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
  <p>No events at this festival</p>
  <?php endif ?>
</div>





