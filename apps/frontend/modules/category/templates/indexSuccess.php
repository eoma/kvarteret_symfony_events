<?php slot('title', __('Category list')) ?>
<h1><?php echo __('Category list') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Created at') ?></th>
      <th><?php echo __('Updated at') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorys as $category): ?>
    <tr>
      <td><a href="<?php echo url_for('category/show?id='.$category['id']) ?>"><?php echo $category['name'] ?></a></td>
      <td><?php echo $category['created_at'] ?></td>
      <td><?php echo $category['updated_at'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
