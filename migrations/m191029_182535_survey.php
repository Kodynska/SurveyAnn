<?php

use yii\db\Migration;

/**
 * Class m191029_182535_survey
 */
class m191029_182535_survey extends Migration
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
            '{{%survey}}',
            [
                'id' => $this->primaryKey(11)->comment('Record ID'),
                'title' => $this->string(255)->notNull()->comment('Title'),
            ], $tableOptions
        );

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%survey}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_182535_survey cannot be reverted.\n";

        return false;
    }
    */
}
