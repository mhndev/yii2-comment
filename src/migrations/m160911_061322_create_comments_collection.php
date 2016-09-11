<?php

use yii\db\Migration;

class m160911_061322_create_comments_collection extends Migration
{
    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'entity'=>$this->string(),
            'entity_id'=>$this->string(),
            'text'=>$this->string(),
            'writer'=>$this->string(),

            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime()
        ]);
    }

    public function down()
    {
        $this->dropTable('comments');
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
