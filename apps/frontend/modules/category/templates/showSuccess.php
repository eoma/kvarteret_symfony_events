<table>
  <tbody>
    <tr>
      <th><?php echo __('Id') ?>:</th>
      <td><?php echo $category['id'] ?></td>
    </tr>
    <tr>
      <th><?php echo __('Name') ?>:</th>
      <td><?php echo $category['name'] ?></td>
    </tr>
    <tr>
      <th><?php echo __('Created at') ?>:</th>
      <td><?php echo $category['created_at'] ?></td>
    </tr>
    <tr>
      <th><?php echo __('Updated at') ?>:</th>
      <td><?php echo $category['updated_at'] ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('category/index') ?>"><?php echo __('Back to list') ?></a>

<h2><?php echo __('Events scheduled for %1%', array('%1%' => $category['name'])) ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Start') ?></th>
      <th><?php echo __('End') ?></th>
      <th><?php echo __('Arranger') ?></th>
      <th><?php echo __('Location') ?></th>
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
