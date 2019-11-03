<?php

use yii\db\Migration;

/**
 * Class m191102_140807_rates
 */
class m191102_140807_rates extends Migration
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
            '{{%rates}}',
            [
                'id' => $this->primaryKey(11)->comment('Record ID'),
                'text' => $this->string(255)->notNull()->comment('Text'),
                'survey_id' => $this->integer(11)->notNull()->comment('Survey ID'),

            ], $tableOptions
        );
        $this->createIndex('FK_rates_survey_id', '{{%rates}}', 'survey_id', false);


    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('FK_rates_survey_id', '{{%rates}}');
        $this->dropTable('{{%rates}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191102_140807_rates cannot be reverted.\n";

        return false;
    }
    */
}
