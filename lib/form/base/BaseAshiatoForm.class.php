<?php

/**
 * Ashiato form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseAshiatoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'member_id_from' => new sfWidgetFormPropelChoice(array('model' => 'Member', 'add_empty' => false)),
      'member_id_to'   => new sfWidgetFormPropelChoice(array('model' => 'Member', 'add_empty' => false)),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Ashiato', 'column' => 'id', 'required' => false)),
      'member_id_from' => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id')),
      'member_id_to'   => new sfValidatorPropelChoice(array('model' => 'Member', 'column' => 'id')),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ashiato[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ashiato';
  }


}
