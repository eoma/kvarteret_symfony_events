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

    // Set default start and end date to the next day
    $this->setDefault('startDate', date('Y-m-d', time() + 86400));
    $this->setDefault('startTime', '19:00');
    $this->setDefault('endDate', date('Y-m-d', time() + 86400));
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

    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'checkIfLocationIsSet')))
    );

    $this->widgetSchema['description'] = new sfWidgetFormCKEditor();
    $editor = $this->widgetSchema['description']->getEditor();
    $editor->config['toolbar'] = array(array('Source', 'RemoveFormat', '-', 'Copy', 'Cut', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'NumberedList','BulletedList','-','Outdent','Indent','Blockquote', '-', 'Image', 'Link', 'Unlink'));
    $editor->config['entities'] = false;
  }

  public function checkIfLocationIsSet ($validator, $values) {
    if (empty($values['customLocation']) && (empty($values['location_id']) || ($values['location_id'] == 0))) {
      $errorMsg = "You must specify either a custom location or a recurring location";

      $error = new sfValidatorError($validator, $errorMsg);
      throw new sfValidatorErrorSchema($validator, array(
        'customLocation' => $error,
	'location_id' => $error,
      ));
    }

    return $values;
  }

  public function checkStartAndEndDateTime($validator, $values) {
    $startDate = $values['startDate'];
    $startTime = $values['startTime'];
    $endDate = $values['endDate'];
    $endTime = $values['endTime'];

    $startTimestamp = strtotime($startDate . ' ' . $startTime);
    $endTimestamp = strtotime($endDate . ' ' . $endTime);

    if ($startTimestamp < time()) {
      $errorMsg = "You can't set start date and time to the past";

      $error = new sfValidatorError($validator, $errorMsg);
      throw new sfValidatorErrorSchema($validator, array(
        'startDate' => $error,
	'startTime' => $error,
      ));
    }

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
