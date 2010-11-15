<?php

/**
 * event form.
 *
 * @package    kvarteret_events
 * @subpackage form
 * @author     Endre Oma
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eventForm extends BaseeventForm
{
  public function configure()
  {

    unset(
      $this['created_at'], $this['updated_at']
    );

    $years = range(date('Y'), date('Y') + 3);
    $this->widgetSchema['startDate'] = new sfWidgetFormDate(array(
      'format' => '%year%-%month%-%day%',
      'years' => array_combine($years, $years),
    ));

    $this->widgetSchema['endDate'] = new sfWidgetFormDate(array(
      'format' => '%year%-%month%-%day%',
      'years' => array_combine($years, $years),
    ));

    $this->setDefault('startDate', date('Y-m-d'));
    $this->setDefault('startTime', '19:00');
    $this->setDefault('endDate', date('Y-m-d'));
    $this->setDefault('endTime', '21:00');

    // Add a date validator, require that end date and time is at least 
    // bigger than start date and time
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkStartAndEndDateTime')))
    );

    $this->setWidget('location_id', new sfWidgetFormDoctrineChoiceNestedSet(array(
      'model'     => 'location',
      'add_empty' => true,
    )));

    $this->widgetSchema['description'] = new sfWidgetFormCKEditor();
    $editor = $this->widgetSchema['description']->getEditor();
    $editor->config['toolbar'] = array(array('Source', 'RemoveFormat', '-', 'Copy', 'Cut', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'NumberedList','BulletedList','-','Outdent','Indent','Blockquote', '-', 'Image', 'Link', 'Unlink'));
    $editor->config['entities'] = false;
  }

  public function checkStartAndEndDateTime($validator, $values) {
    $startDate = $values['startDate'];
    $startTime = $values['startTime'];
    $endDate = $values['endDate'];
    $endTime = $values['endTime'];

    $startTimestamp = strptime($startDate . ' ' . $startTime, '%Y-%m-%d %H:%M');
    $endTimestamp = strptime($endDate . ' ' . $endTime, '%Y-%m-%d %H:%M');

    if ($endTimestamp < $startTimestamp) {
      $errorMsg = "End date and time must be later than start date and time";

      $error = new sfValidatorError($validator, $errorMsg);
      throw new sfValidatorErrorSchema($validator, array(
        'endDate' => $error,
	'endTime' => $error,
      ));
    }

    return $values;
  }
}
