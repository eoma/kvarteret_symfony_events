<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Lead paragraph</th>
      <th>Location</th>
      <th>Linkout</th>
      <th>Start</th>
      <th>End</th>
      <th>Category</th>
      <th>Arranger</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id='.$event['id']) ?>"><?php echo $event['title'] ?></a></td>
      <td><?php echo $event->getRaw('leadParagraph') ?></td>
      <td><?php 
                if ( ! $event['location_id'] ) 
                  echo $event['customLocation'];
                else 
                  echo '<a href="' . url_for('location/show?id=' . $event['location_id']) . '">' . $event['recurringLocation']['name'] . '</a>';
          ?></td>
      <td><?php echo $event['linkout'] ?></td>
      <td><?php echo $event['startDate'] . ' ' .$event['startTime']  ?></td>
      <td><?php echo $event['endDate'] . ' ' . $event['endTime'] ?></td>
      <td><a href="<?php echo url_for('category/show?id=' . $event['category_id']) ?>"><?php echo $event['category']['name'] ?></a></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event['arranger_id']) ?>"><?php echo $event['arranger']['name'] ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
