<h1><?php echo __('Locations List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Created at') ?></th>
      <th><?php echo __('Updated at') ?></th>
      <th><?php echo __('Root') ?></th>
      <th><?php echo __('Lft') ?></th>
      <th><?php echo __('Rgt') ?></th>
      <th><?php echo __('Level') ?></th>
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
