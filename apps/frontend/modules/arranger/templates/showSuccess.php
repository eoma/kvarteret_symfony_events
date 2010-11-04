<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $arranger->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $arranger->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $arranger->getDescription() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $arranger->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $arranger->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('arranger/index') ?>">List</a>

<h2>Events scheduled for <?php echo $arranger->getName() ?></h2>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Start</th>
      <th>End</th>
      <th>Category</th>
      <th>Location</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id=' . $event->getId()) ?>"><?php echo $event->getTitle() ?></a></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php echo $event->getStartDate() . ' ' . $event->getStartTime() ?></td>
      <td><?php echo $event->getEndDate() . ' ' . $event->getEndTime() ?></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event->getCategoryId()) ?>"><?php echo $event->getCategory() ?></a></td>
      <td>
      <?php if (!$event->getLocationId()): ?>
        <?php echo $event->getCustomLocation() ?>
      <?php else: ?>
        <a href="<?php echo url_for('location/show?id=' . $event->getLocationId()) ?>"><?php echo $event->getRecurringLocation() ?></a>
      <?php endif ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
