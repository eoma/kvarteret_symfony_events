<?php 
use_helper('Date');
?>

<div id="eventData">
  <p>
    <b><?php echo __('Where?') ?></b> 
    <?php 
      if (!$event['location_id']) {
        echo $event['customLocation']; 
       } else {
        echo link_to($event['recurringLocation']['name'], 'location/show/?id='. $event['location_id']);
      } 
     ?>
  </p>
  <p>
    <b><?php echo __('When?') ?></b> 
    <?php 
    if ($event['startDate'] == $event['endDate']):
    ?>
    <?php echo __('%1% from %2% to %3%',  array('%1%' => format_date($event['startDate']), '%2%' => $event['startTime'], '%3%' => $event['endTime'])) ?>
    <?php else: ?>
    <?php echo __('from %1% to %2%', array('%1%' => format_date($event['startDate']) . ' ' . $event['startTime'], '%2%' => format_date($event['endDate']) . ' ' . $event['endTime'])) ?>
    <?php endif ?>
  </p>
  <p>
    <b><?php echo __('Who?') ?></b> <?php echo link_to($event['arranger']['name'], 'arranger/show/?id=' . $event['arranger_id']) ?>
  </p>
  <p>
    <b><?php echo __('What?') ?></b> <?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . ' '; } ?>
  </p>
  <p>
    <small><?php echo __('Created at %1%. Updated at %2%.', array('%1%' => format_datetime($event['created_at']), '%2%' => format_datetime($event['updated_at']))) ?></small>
  </p>
</div>

<div id="eventContent">
  <h2><?php echo $event['title'] ?></h2>

 <?echo $event->getRaw('leadParagraph'); ?>
 <?echo $event->getRaw('description'); ?>

  <?php if (!empty($event['linkout'])): ?>
  <p><?php echo __('Read more <a href="%1%">here</a>', array('%1%' => $events['linkout'])) ?></p>
  <?php endif ?>

</div>
