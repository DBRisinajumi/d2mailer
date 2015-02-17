<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class d2mailer {

    /**
     * settings from module
     */
    public $fromEmail;
    public $fromName;
    public $smtp_host;
    public $smtp_port;
    public $error = false;
    
    public $logging = false;
    public $logging_model_name = false;
    public $logging_model_id = false;
    

    public function __construct() {
        
        /**
         * load config from module
         */
        $module = Yii::app()->getModule('d2mailer');
        $this->fromEmail = $module->fromEmail;
        $this->fromName = $module->fromName;
        $this->smtp_host = $module->smtp_host;
        $this->smtp_port = $module->smtp_port;
        $this->logging = $module->logging;
        
    
        if (class_exists('Swift', false)) {
            return true;
        }
        require_once(Yii::getPathOfAlias('swiftMailer') .'/classes/Swift.php');
        Yii::registerAutoloader(array('Swift','autoload'));
        require_once(Yii::getPathOfAlias('swiftMailer') .'/swift_init.php');
        return true;


    }
    
    public function isConcole() {
        return (get_class(Yii::app()) == 'CConsoleApplication');
    }

    public function setLogModel($model){
        if(!$model){
            return false;
        }
        $this->logging_model_name = get_class($model);
        $this->logging_model_id = $model->primaryKey;
    }

    

    /**
     * send email to user by smtp
     * @param int $user_id
     * @param string $subject
     * @param string $message
     * @param string $from_email
     * @param string $from_name
     * @return boolean/string false on error, string on success
     */
    public function sendMailToUser($user_id, $subject, $message, $from_email = false, $from_name = false) {

        $this->error = false;
        
        if(!$from_email){
            $from_email = $this->fromEmail;
        }

        if(!$from_name){
            $from_name = $this->fromName;
        }
        
        $user = User::model()->findbyPk($user_id);


        $user_full_name = $user->profile->first_name . ' ' . $user->profile->last_name;
        
        //validate
        if (empty($user->email)) {
            $this->error = Yii::t('D2mailerModule.errors', 'User don\'t have email: ')
                    . $user_full_name;
            return false;
        }

        //create message
        //Yii::import('vendor.swiftmailer.swiftmailer.lib.classes.Swift.*');
        $swiftMessage = Swift_Message::newInstance($subject);
        $swiftMessage->setBody($message, 'text/html');
        $swiftMessage->setFrom($from_email, $from_name);
        $swiftMessage->setTo($user->email, $user_full_name);

        if($this->logging && $this->logging_model_name && $this->logging_model_id){
            $mllg = new MllgMailerLog();
            $mllg->mllg_model_name = $this->logging_model_name;
            $mllg->mllg_model_id = $this->logging_model_id;
            $mllg->mllg_datetime = new CDbExpression('NOW()');
            if(!$this->isConcole()){
                $mllg->mllg_user_id = Yii::app()->user->id;
            }
            $mllg->mllg_to = $user->email;
            $mllg->mllg_subject = $subject;
            $mllg->mllg_text = $message;
            $mllg->mllg_text_format = MllgMailerLog::MLLG_TEXT_FORMAT_TEXTHTML;
            $mllg->mllg_status = MllgMailerLog::MLLG_STATUS_SENT;            
        }         
        
        /** 
         * Create the Mailer and Send
         * @link http://swiftmailer.org/docs/sending.html
         */
        
        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance($this->smtp_host, $this->smtp_port);
  
        //create Mauler and send
        if(!Swift_Mailer::newInstance($transport)->send($swiftMessage)){
            $this->error = Yii::t('D2personModule.model', 'Can not send email to ')
                    . $user_full_name . ' '
                    . $user->email;
            if($this->logging && $this->logging_model_name && $this->logging_model_id){
                $mllg->mllg_status = MllgMailerLog::MLLG_STATUS_ERROR;            
                $mllg->save();
            }                    
            return false;
        }

        if($this->logging && $this->logging_model_name && $this->logging_model_id){
            $mllg->mllg_status = MllgMailerLog::MLLG_STATUS_SENT;            
            $mllg->save();
        }                         
        
        return $user_full_name . ' ' . $user->email;
    }

}
