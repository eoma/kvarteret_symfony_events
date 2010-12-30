<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $arranger['id'] ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $arranger['name'] ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $arranger['description'] ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $arranger['created_at'] ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $arranger['updated_at'] ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('arranger/index') ?>">List</a>

<h2>Events scheduled for <?php echo $arranger['name'] ?></h2>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Start</th>
      <th>End</th>
      <th>Categories</th>
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
      <td><?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . ' '; } ?></td>
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
