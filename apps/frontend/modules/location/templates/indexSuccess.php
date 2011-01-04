<?php use_helper('HtmlList') ?>

<?php echo slot('title', __('Location list')) ?>
<h1><?php echo __('Location list') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $location): ?>
    <tr class="<?php echo HtmlList::Alternate('odd','even'); ?>">
      <td>
        <?php echo link_to($location['name'], 'location/show?id=' . $location['id']) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
  <?php include_partial('global/pager', array('route' => 'locations/index', 'pager' => $pager)) ?>
<?php endif ?>
