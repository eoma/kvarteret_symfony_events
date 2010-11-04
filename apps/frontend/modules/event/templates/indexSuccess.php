<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
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
      <td><a href="<?php echo url_for('event/show?id='.$event->getId()) ?>"><?php echo $event->getTitle() ?></a></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php 
                if ( ! $event->getLocationId() ) 
                  echo $event->getCustomLocation();
                else 
                  echo '<a href="' . url_for('location/show?id=' . $event->getLocationId()) . '">' . $event->getRecurringLocation() . '</a>';
          ?></td>
      <td><?php echo $event->getLinkout() ?></td>
      <td><?php echo $event->getStartDate() . ' ' .$event->getStartTime()  ?></td>
      <td><?php echo $event->getEndDate() . ' ' . $event->getEndTime() ?></td>
      <td><a href="<?php echo url_for('category/show?id=' . $event->getCategoryId()) ?>"><?php echo $event->getCategory() ?></a></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event->getArrangerId()) ?>"><?php echo $event->getArranger() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
