<?php

/**
 * Car Base Form.
 */
class BaseCarForm extends BaseFormMondongo
{
    /**
     * @see sfForm
     */
    public function setup()
    {
        $this->setWidgets(array(
            'make' => new sfWidgetFormInputText(array(), array()),
            'model' => new sfWidgetFormInputText(array(), array()),
            'created_at' => new sfWidgetFormDateTime(array(), array()),
            'updated_at' => new sfWidgetFormDateTime(array(), array()),
            'slug' => new sfWidgetFormInputText(array(), array()),

        ));

        $this->setValidators(array(
            'make' => new sfValidatorString(array(), array()),
            'model' => new sfValidatorString(array(), array()),
            'created_at' => new sfValidatorDateTime(array(), array()),
            'updated_at' => new sfValidatorDateTime(array(), array()),
            'slug' => new sfValidatorString(array(), array()),

        ));

        $this->widgetSchema->setNameFormat('car[%s]');
    }

    /**
     * @see sfMondongoForm
     */
    public function getModelName()
    {
        return 'Car';
    }
}