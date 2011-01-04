<?php use_helper('HtmlList') ?>
<?php slot('title', __('Category list')) ?>
<h1><?php echo __('Category list') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $category): ?>
    <tr class="<?php echo HtmlList::Alternate('odd','even'); ?>">
      <td><a href="<?php echo url_for('category/show?id='.$category['id']) ?>"><?php echo $category['name'] ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
  <?php include_partial('global/pager', array('route' => 'category/index', 'pager' => $pager)) ?>
<?php endif ?>
