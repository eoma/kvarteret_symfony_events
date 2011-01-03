<?php slot('title', __('Festival list')) ?>
<h1><?php echo __('Festival list') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Lead paragraph') ?></th>
      <th><?php echo __('Location') ?></th>
      <th><?php echo __('Linkout') ?></th>
      <th><?php echo __('Start') ?></th>
      <th><?php echo __('End') ?></th>
      <th><?php echo __('Arrangers') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($festivals as $festival): ?>
    <tr>
      <td><?php echo link_to($festival['title'], 'festival/show?id=' . $festival['id']) ?></td>
      <td><?php echo $festival->getRaw('leadParagraph') ?></td>
      <td><?php 
                if ( ! $festival['location_id'] ) 
                  echo $festival['customLocation'];
                else 
                  echo link_to($festival['commonLocation']['name'], 'location/show?id=' . $festival['location_id']);
          ?></td>
      <td><?php echo $festival['linkout'] ?></td>
      <td><?php echo $festival['startDate'] . ' ' .$festival['startTime']  ?></td>
      <td><?php echo $festival['endDate'] . ' ' . $festival['endTime'] ?></td>
      <td><?php foreach ($festival['arrangers'] as $a) { echo link_to($a['name'], 'arranger/show?id=' . $a['id']) . ' '; } ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
