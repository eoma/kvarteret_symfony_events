<h1><?php echo __('Arrangers List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Created at') ?></th>
      <th><?php echo __('Updated at') ?></th>
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
