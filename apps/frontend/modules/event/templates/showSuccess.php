<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $event->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $event->getTitle() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $event->getDescription() ?></td>
    </tr>
    <tr>
      <th>Custom location:</th>
      <td><?php echo $event->getCustomLocation() ?></td>
    </tr>
    <tr>
      <th>Linkout:</th>
      <td><?php echo $event->getLinkout() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $event->getStartDate() ?></td>
    </tr>
    <tr>
      <th>Start time:</th>
      <td><?php echo $event->getStartTime() ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $event->getEndDate() ?></td>
    </tr>
    <tr>
      <th>End time:</th>
      <td><?php echo $event->getEndTime() ?></td>
    </tr>
    <tr>
      <th>Access level:</th>
      <td><?php echo $event->getAccessLevel() ?></td>
    </tr>
    <tr>
      <th>Is accepted:</th>
      <td><?php echo $event->getIsAccepted() ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $event->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Recurring location:</th>
      <td><?php echo $event->getRecurringLocation()->getName() ?></td>
    </tr>
    <tr>
      <th>Category:</th>
      <td><?php echo $event->getCategory()->getName() ?></td>
    </tr>
    <tr>
      <th>Arranger:</th>
      <td><?php echo $event->getArranger()->getName() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $event->getUser()->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $event->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $event->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />
<a href="<?php echo url_for('event/index') ?>">List</a>
