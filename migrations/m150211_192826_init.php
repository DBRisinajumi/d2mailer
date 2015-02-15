<?php

class m150211_192826_init extends EDbMigration {

    public function up() {
        $this->execute("
            CREATE TABLE `mllg_mailer_log`(  
              `mllg_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `mllg_model_name` VARCHAR(50),
              `mllg_model_id` BIGINT UNSIGNED,
              `mllg_user_id` INT,
              `mllg_datetime` DATETIME NOT NULL,
              `mllg_to` VARCHAR(256) NOT NULL,
              `mllg_subject` TEXT,
              `mllg_text` TEXT,
              `mllg_text_format` ENUM('text/html','text') NULL,
              `mllg_status` ENUM('SENT','ERROR'), 
              PRIMARY KEY (`mllg_id`),
              INDEX (`mllg_model_name`(4), `mllg_model_id`),
              INDEX (`mllg_user_id`)
            ) ENGINE=INNODB CHARSET=utf8;

              ");
    }

    public function down() {
        $this->execute("
            DROP TABLE `mllg_mailer_log`;
              ");
    }

    /*
      // Use safeUp/safeDown to do migration with transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
