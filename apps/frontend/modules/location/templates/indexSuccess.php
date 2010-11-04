<h1>Locations List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Root</th>
      <th>Lft</th>
      <th>Rgt</th>
      <th>Level</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($locations as $location): ?>
    <tr>
      <td><a href="<?php echo url_for('location/show?id='.$location->getId()) ?>"><?php echo $location->getId() ?></a></td>
      <td><?php echo $location->getName() ?></td>
      <td><?php echo $location->getDescription() ?></td>
      <td><?php echo $location->getCreatedAt() ?></td>
      <td><?php echo $location->getUpdatedAt() ?></td>
      <td><?php echo $location->getRootId() ?></td>
      <td><?php echo $location->getLft() ?></td>
      <td><?php echo $location->getRgt() ?></td>
      <td><?php echo $location->getLevel() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
