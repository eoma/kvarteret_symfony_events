<h1>Festival List</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Lead paragraph</th>
      <th>Location</th>
      <th>Linkout</th>
      <th>Start</th>
      <th>End</th>
      <th>Arrangers</th>
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
