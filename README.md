Require
-------


* SwiftMailer
* yii-user



/config/main.php
----------------

add under module: 

        'd2mailer' => array(
            'class' => 'vendor.dbrisinajumi.d2mailer.D2mailerModule',
            'fromEmail' => 'uldis@weberp.lv',
            'fromName' => 'Uldis Nelsons',
            'smtp_host' => 'smtp.apollo.lv',
            'smtp_port' => 25,
            'smtp_username' => 'username', //optional
            'smtp_password' => 'password', //optional
        ),         

        
Usage
------

        $user_id = 1;
        $subject = 'Subject';
        $message = 'Message';

        Yii::import('vendor.dbrisinajumi.d2mailer.components.*');
        $d2mailer = new d2mailer();     
        if($d2mailer->sendMailToUser($user_id,$subject,$message) === false){
            echo '     ' . $d2mailer->error;
        }                
