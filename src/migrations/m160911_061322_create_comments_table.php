<?php

use yii\db\Migration;

class m160911_061322_create_comments_table extends Migration
{
    public function up()
    {
        $columns = [
            'id' => $this->primaryKey(),
            'entity'=>$this->string(),
            'entity_id'=>$this->string(),
            'text'=>$this->string(),
            'user_id' => $this->string(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime()
        ];

        $config = include Yii::getAlias('@app').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'comment.php';


        if($config['nested']){
            $columns['parent_id'] = $this->string();
            $columns['depth'] = $this->integer();
        }

        $this->createTable('comments', $columns);
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
