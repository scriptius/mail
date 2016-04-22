<?php

use yii\db\Migration;

class m160421_191401_CreateTableMailShedule extends Migration
{
    public function up()
    {
        $this->createTable('MailShedule',
            [
                'id' => $this->primaryKey(),
                'userId' => $this->integer(),
                'templates' => $this->string(),
                'text' => $this->text()
            ]);

    }

    public function down()
    {
       $this->dropTable('MailShedule');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
