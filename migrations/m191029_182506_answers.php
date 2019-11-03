<?php

use yii\db\Migration;

/**
 * Class m191029_182506_answers
 */
class m191029_182506_answers extends Migration
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
            '{{%answers}}',
            [
                'id' => $this->primaryKey(11)->comment('Record ID'),
                'title' => $this->string(255)->notNull()->comment('Title'),
                'result_id' => $this->integer(11)->notNull()->comment('Question ID'),
                'rates_id' => $this->integer(11)->notNull()->comment('Question ID'),

            ], $tableOptions
        );
        $this->createIndex('FK_answers_result_id', '{{%answers}}', 'result_id', false);
        $this->createIndex('FK_answers_rates_id', '{{%answers}}', 'rates_id', false);


    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('FK_answers_rates_id', '{{%answers}}');
        $this->dropIndex('FK_answers_result_id', '{{%answers}}');
        $this->dropTable('{{%answers}}');

        return true;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_182506_answers cannot be reverted.\n";

        return false;
    }
    */
}
