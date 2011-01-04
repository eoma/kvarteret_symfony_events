<?php // This partial demands a list of events ?>
<?php use_helper('HtmlList') ?>

<table id="eventList">
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr class="<?php echo HtmlList::Alternate('odd','even'); ?>">
      <td>
        <?php echo link_to($event['title'], 'event/show?id=' . $event['id']) ?><br />
        <span>
          <?php 
          if (strlen($event['leadParagraph']) > 100) { 
            echo substr($event['leadParagraph'], 0, 97) . '...';
          } else {
            echo $event['leadParagraph'];
          }
          ?>
        </span><br />
        <?php echo __('When?') ?> <?php include_partial('event/startEndDateTime', array('event' => $event)) ?><br />
        <?php echo __('Location') ?>: <?php include_partial('event/location', array('event' => $event)) ?><br />
        <?php echo __('Arranger') ?>: <?php echo link_to($event['arranger']['name'], 'arranger/show?id=' . $event['arranger_id']) ?><br />
        <?php echo __('Categories') ?>: <?php foreach ($event['categories'] as $c) { echo link_to($c['name'], 'category/show?id=' . $c['id']) . " "; } ?>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
