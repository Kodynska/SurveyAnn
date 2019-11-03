<?php

use yii\db\Migration;

/**
 * Class m191029_182011_result
 */
class m191029_182011_result extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = '';

        $this->createTable(
            '{{%result}}',
            [
                'id' => $this->primaryKey(11)->comment('Record ID'),
                'email' => $this->string(255)->notNull()->comment('Email'),
                'name' => $this->string(255)->notNull()->comment('Name'),
                'comment' => $this->string(500)->notNull()->comment('Comment'),
                'survey_id' => $this->integer(11)->null()->defaultValue(null)->comment('Survey ID'),
                'user_id' => $this->integer(11)->null()->defaultValue(null)->comment('User ID'),
                'rate' => $this->integer(11)->notNull()->comment('Rate'),
//                'created_at' => $this->integer(11)->null()->defaultValue(null)->comment('Unix timestamp when record was created'),
//                'updated_at' => $this->integer(11)->null()->defaultValue(null)->comment('Unix timestamp when record was updated'),
                'created_at'=> $this->date()->null()->defaultValue(null),
                'updated_at'=> $this->date()->null()->defaultValue(null),

            ], $tableOptions
        );
        $this->createIndex('FK_result_survey_id', '{{%result}}', 'survey_id', false);
        $this->createIndex('FK_result_user_id', '{{%result}}', 'user_id', false);


    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('FK_result_user_id', '{{%result}}');
        $this->dropIndex('FK_result_survey_id', '{{%result}}');
        $this->dropTable('{{%result}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_182011_result cannot be reverted.\n";

        return false;
    }
    */
}
