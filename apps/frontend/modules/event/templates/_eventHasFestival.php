<?php
use_helper('Date');
if ( ! is_null($event['festival']) ) {
  echo 'Part of ' . link_to($event['festival']['title'] . ' ' . format_date($event['festival']['startDate']), 'festival/show?id=' . $event['festival_id']) . '.<br />';
}
