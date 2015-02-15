<?php
 
class m150215_094902_auth_MllgMailerLog extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.*','0','D2mailer.MllgMailerLog',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.Create','0','D2mailer.MllgMailerLog module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.View','0','D2mailer.MllgMailerLog module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.Update','0','D2mailer.MllgMailerLog module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.Delete','0','D2mailer.MllgMailerLog module delete',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2mailer.MllgMailerLog.Menu','0','D2mailer.MllgMailerLog show menu',NULL,'N;');
                

        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.*';
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.Create';
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.View';
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.Update';
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.Delete';
            DELETE FROM `authitem` WHERE `name`= 'D2mailer.MllgMailerLog.Menu';

        ");
    }

    public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }
}


