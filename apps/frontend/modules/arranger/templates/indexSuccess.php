<h1>Arrangers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($arrangers as $arranger): ?>
    <tr>
      <td><a href="<?php echo url_for('arranger/show?id='.$arranger['id']) ?>"><?php echo $arranger['id'] ?></a></td>
      <td><?php echo $arranger['name'] ?></td>
      <td><?php echo $arranger['description'] ?></td>
      <td><?php echo $arranger['created_at'] ?></td>
      <td><?php echo $arranger['updated_at'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
