<h1><?php echo __('Events List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Lead paragraph') ?></th>
      <th><?php echo __('Location') ?></th>
      <th><?php echo __('Linkout') ?></th>
      <th><?php echo __('Start') ?></th>
      <th><?php echo __('End') ?></th>
      <th><?php echo __('Categories') ?></th>
      <th><?php echo __('Arranger') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><?php echo link_to($event['title'], 'event/show?id=' . $event['id']) ?></td>
      <td><?php echo $event->getRaw('leadParagraph') ?></td>
      <td><?php 
                if ( ! $event['location_id'] ) 
                  echo $event['customLocation'];
                else 
                  echo link_to($event['recurringLocation']['name'], 'location/show?id=' . $event['location_id']);
          ?></td>
      <td><?php echo $event['linkout'] ?></td>
      <td><?php echo $event['startDate'] . ' ' .$event['startTime']  ?></td>
      <td><?php echo $event['endDate'] . ' ' . $event['endTime'] ?></td>
      <td><?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . ' '; } ?></td>
      <td><?php echo link_to($event['arranger']['name'], 'arranger/show?id=' . $event['arranger_id']) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
