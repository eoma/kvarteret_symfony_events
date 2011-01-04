<?php slot('title', __('Festival list')) ?>
<h1><?php echo __('Festival list') ?></h1>

<table>
  <tbody>
    <?php foreach ($pager->getResults() as $festival): ?>
    <tr class="<?php echo HtmlList::Alternate('odd','even'); ?>">
      <td>
        <?php echo link_to($festival['title'], 'festival/show?id=' . $festival['id']) ?><br />
        <span><?php if (strlen($festival['leadParagraph']) > 100) { echo substr($festival['leadParagraph'], 0, 97) . '...'; } else { echo $festival['leadParagraph']; } ?></span><br />
        <?php echo __('Main location') ?>:
        <?php 
        if ( ! $festival['location_id'] ) {
          echo $festival['customLocation'];
        } else {
          echo link_to($festival['commonLocation']['name'], 'location/show?id=' . $festival['location_id']);
        }
        ?><br />
        <?php echo __('When?') ?>: <?php include_partial('event/startEndDateTime', array('event' => $festival)) ?><br />
        <?php echo __('Arrangers') ?>: <?php foreach ($festival['arrangers'] as $a) { echo link_to($a['name'], 'arranger/show?id=' . $a['id']) . ' '; } ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
