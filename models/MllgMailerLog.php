<?php

// auto-loading
Yii::setPathOfAlias('MllgMailerLog', dirname(__FILE__));
Yii::import('MllgMailerLog.*');

class MllgMailerLog extends BaseMllgMailerLog
{

    public $user_full_name;
    
    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
        );
    }
    
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels()
         , array(
            'user_full_name' => Yii::t('D2mailerModule.model', 'user_full_name'),
          ) 
        );
    }    

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
        
        $criteria->select = "*, concat(last_name,' ',first_name) user_full_name" ;
        $criteria->join = " 
            LEFT OUTER JOIN profiles p
              ON t.mllg_user_id = p.user_id
        ";      


        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
        ));
    }

}
