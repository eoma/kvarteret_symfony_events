<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $event['id'] ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $event['title'] ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $event['description'] ?></td>
    </tr>
    <tr>
      <th>Custom location:</th>
      <td><?php echo $event['customLocation'] ?></td>
    </tr>
    <tr>
      <th>Linkout:</th>
      <td><?php echo $event['linkout'] ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $event['startDate'] ?></td>
    </tr>
    <tr>
      <th>Start time:</th>
      <td><?php echo $event['startTime'] ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $event['endDate'] ?></td>
    </tr>
    <tr>
      <th>End time:</th>
      <td><?php echo $event['endTime'] ?></td>
    </tr>
    <tr>
      <th>Access level:</th>
      <td><?php echo $event['accessLevel'] ?></td>
    </tr>
    <tr>
      <th>Is accepted:</th>
      <td><?php echo $event['is_accepted'] ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $event['is_public'] ?></td>
    </tr>
    <tr>
      <th>Recurring location:</th>
      <!--<td><?php // if ($event['recurringLocation'] !== False) echo $event['recurringLocation']['name'] ?></td>-->
      <td><?php echo $event['recurringLocation']['name'] ?></td>
    </tr>
    <tr>
      <th>Category:</th>
      <td><?php echo $event['category']['name'] ?></td>
    </tr>
    <tr>
      <th>Arranger:</th>
      <td><?php echo $event['arranger']['name'] ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $event['created_at'] ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $event['updated_at'] ?></td>
    </tr>
  </tbody>
</table>

<hr />
<a href="<?php echo url_for('event/index') ?>">List</a>
