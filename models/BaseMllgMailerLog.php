<?php

/**
 * This is the model base class for the table "mllg_mailer_log".
 *
 * Columns in table "mllg_mailer_log" available as properties of the model:
 * @property string $mllg_id
 * @property string $mllg_model_name
 * @property string $mllg_model_id
 * @property integer $mllg_user_id
 * @property string $mllg_datetime
 * @property string $mllg_to
 * @property string $mllg_subject
 * @property string $mllg_text
 * @property string $mllg_text_format
 * @property string $mllg_status
 *
 * There are no model relations.
 */
abstract class BaseMllgMailerLog extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const MLLG_TEXT_FORMAT_TEXTHTML = 'text/html';
    const MLLG_TEXT_FORMAT_TEXT = 'text';
    const MLLG_STATUS_SENT = 'SENT';
    const MLLG_STATUS_ERROR = 'ERROR';
    
    var $enum_labels = false;  

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'mllg_mailer_log';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('mllg_datetime, mllg_to', 'required'),
                array('mllg_model_name, mllg_model_id, mllg_user_id, mllg_subject, mllg_text, mllg_text_format, mllg_status', 'default', 'setOnEmpty' => true, 'value' => null),
                array('mllg_user_id', 'numerical', 'integerOnly' => true),
                array('mllg_model_name', 'length', 'max' => 50),
                array('mllg_model_id', 'length', 'max' => 20),
                array('mllg_to', 'length', 'max' => 256),
                array('mllg_subject, mllg_text', 'safe'),
                array('mllg_text_format', 'in', 'range' => array(self::MLLG_TEXT_FORMAT_TEXTHTML, self::MLLG_TEXT_FORMAT_TEXT)),
                array('mllg_status', 'in', 'range' => array(self::MLLG_STATUS_SENT, self::MLLG_STATUS_ERROR)),
                array('mllg_id, mllg_model_name, mllg_model_id, mllg_user_id, mllg_datetime, mllg_to, mllg_subject, mllg_text, mllg_text_format, mllg_status', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->mllg_model_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'mllg_id' => Yii::t('D2mailerModule.model', 'Mllg'),
            'mllg_model_name' => Yii::t('D2mailerModule.model', 'Mllg Model Name'),
            'mllg_model_id' => Yii::t('D2mailerModule.model', 'Mllg Model'),
            'mllg_user_id' => Yii::t('D2mailerModule.model', 'Mllg User'),
            'mllg_datetime' => Yii::t('D2mailerModule.model', 'Mllg Datetime'),
            'mllg_to' => Yii::t('D2mailerModule.model', 'Mllg To'),
            'mllg_subject' => Yii::t('D2mailerModule.model', 'Mllg Subject'),
            'mllg_text' => Yii::t('D2mailerModule.model', 'Mllg Text'),
            'mllg_text_format' => Yii::t('D2mailerModule.model', 'Mllg Text Format'),
            'mllg_status' => Yii::t('D2mailerModule.model', 'Mllg Status'),
        );
    }

    public function enumLabels()
    {
        if($this->enum_labels){
            return $this->enum_labels;
        }    
        $this->enum_labels =  array(
           'mllg_text_format' => array(
               self::MLLG_TEXT_FORMAT_TEXTHTML => Yii::t('D2mailerModule.model', 'MLLG_TEXT_FORMAT_TEXTHTML'),
               self::MLLG_TEXT_FORMAT_TEXT => Yii::t('D2mailerModule.model', 'MLLG_TEXT_FORMAT_TEXT'),
           ),
           'mllg_status' => array(
               self::MLLG_STATUS_SENT => Yii::t('D2mailerModule.model', 'MLLG_STATUS_SENT'),
               self::MLLG_STATUS_ERROR => Yii::t('D2mailerModule.model', 'MLLG_STATUS_ERROR'),
           ),
            );
        return $this->enum_labels;
    }

    public function getEnumFieldLabels($column){

        $aLabels = $this->enumLabels();
        return $aLabels[$column];
    }

    public function getEnumLabel($column,$value){

        $aLabels = $this->enumLabels();

        if(!isset($aLabels[$column])){
            return $value;
        }

        if(!isset($aLabels[$column][$value])){
            return $value;
        }

        return $aLabels[$column][$value];
    }

    public function getEnumColumnLabel($column){
        return $this->getEnumLabel($column,$this->$column);
    }
    

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.mllg_id', $this->mllg_id, true);
        $criteria->compare('t.mllg_model_name', $this->mllg_model_name, true);
        $criteria->compare('t.mllg_model_id', $this->mllg_model_id, true);
        $criteria->compare('t.mllg_user_id', $this->mllg_user_id);
        $criteria->compare('t.mllg_datetime', $this->mllg_datetime, true);
        $criteria->compare('t.mllg_to', $this->mllg_to, true);
        $criteria->compare('t.mllg_subject', $this->mllg_subject, true);
        $criteria->compare('t.mllg_text', $this->mllg_text, true);
        $criteria->compare('t.mllg_text_format', $this->mllg_text_format);
        $criteria->compare('t.mllg_status', $this->mllg_status);


        return $criteria;

    }

}
