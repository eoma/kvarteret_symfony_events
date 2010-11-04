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
      <td><a href="<?php echo url_for('arranger/show?id='.$arranger->getId()) ?>"><?php echo $arranger->getId() ?></a></td>
      <td><?php echo $arranger->getName() ?></td>
      <td><?php echo $arranger->getDescription() ?></td>
      <td><?php echo $arranger->getCreatedAt() ?></td>
      <td><?php echo $arranger->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
