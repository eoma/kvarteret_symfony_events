<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $location->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $location->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $location->getDescription() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $location->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $location->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('location/index') ?>">List</a>

<h2>Events scheduled for <?php echo $location->getName() ?></h2>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Start</th>
      <th>End</th>
      <th>Arranger</th>
      <th>Category</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id=' . $event->getId()) ?>"><?php echo $event->getTitle() ?></a></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php echo $event->getStartDate() . ' ' . $event->getStartTime() ?></td>
      <td><?php echo $event->getEndDate() . ' ' . $event->getEndTime() ?></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event->getArrangerId()) ?>"><?php echo $event->getArranger() ?></a></td>
      <td><a href="<?php echo url_for('category/show?id=' . $event->getCategoryId()) ?>"><?php echo $event->getCategory() ?></a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
