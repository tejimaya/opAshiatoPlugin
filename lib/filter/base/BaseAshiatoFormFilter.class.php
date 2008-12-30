<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Ashiato filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseAshiatoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'member_id_from' => new sfWidgetFormPropelChoice(array('model' => 'Member', 'add_empty' => true)),
      'member_id_to'   => new sfWidgetFormPropelChoice(array('model' => 'Member', 'add_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'member_id_from' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Member', 'column' => 'id')),
      'member_id_to'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Member', 'column' => 'id')),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('ashiato_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ashiato';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Text',
      'member_id_from' => 'ForeignKey',
      'member_id_to'   => 'ForeignKey',
      'updated_at'     => 'Date',
    );
  }
}
