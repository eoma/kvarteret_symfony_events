<?php slot('title', $location->getName() . ' - ' . __('Location')) ?>
<h1><?php echo $location->getName() ?></h1>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Id') ?>:</th>
      <td><?php echo $location->getId() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Name') ?>:</th>
      <td><?php echo $location->getName() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Description') ?>:</th>
      <td><?php echo $location->getDescription() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Created at') ?>:</th>
      <td><?php echo $location->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Updated at') ?>:</th>
      <td><?php echo $location->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('location/index') ?>"><?php echo __('Back to list') ?></a>

<h2><?php echo __('Events scheduled for %1%', array('%1%' => $location->getName())) ?></h2>
<table>
  <thead>
    <tr>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Start') ?></th>
      <th><?php echo __('End') ?></th>
      <th><?php echo __('Arranger') ?></th>
      <th><?php echo __('Categories') ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/show?id=' . $event->getId()) ?>"><?php echo $event->getTitle() ?></a></td>
      <td><?php echo $event->getDescription() ?></td>
      <td><?php echo $event->getStartDate() . ' ' . $event->getStartTime() ?></td>
      <td><?php echo $event->getEndDate() . ' ' . $event->getEndTime() ?></td>
      <td><a href="<?php echo url_for('arranger/show?id=' . $event->getArrangerId()) ?>"><?php echo $event->getArranger() ?></a></td>
      <td><?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . ' '; } ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
