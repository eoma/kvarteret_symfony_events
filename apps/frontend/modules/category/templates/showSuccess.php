<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $category['id'] ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $category['name'] ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $category['created_at'] ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $category['updated_at'] ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('category/index') ?>">List</a>

<h2>Events scheduled for <?php echo $category['name'] ?></h2>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Start</th>
      <th>End</th>
      <th>Arranger</th>
      <th>Location</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id=' . $event['id']) ?>"><?php echo $event['title'] ?></a></td>
      <td><?php echo $event['description'] ?></td>
      <td><?php echo $event['startDate'] . ' ' . $event['startTime'] ?></td>
      <td><?php echo $event['endDate'] . ' ' . $event['endTime'] ?></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event['arranger_id']) ?>"><?php echo $event['arranger']['name'] ?></a></td>
      <td>
      <?php if (!$event['location_id']): ?>
        <?php echo $event['customLocation'] ?>
      <?php else: ?>
        <a href="<?php echo url_for('location/show?id=' . $event['location_id']) ?>"><?php echo $event['recurringLocation']['name'] ?></a>
      <?php endif ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
