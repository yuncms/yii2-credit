<?php

namespace yuncms\credit\migrations;

use yii\db\Migration;

/**
 * Class M170822042533Create_credits_table
 */
class M170822042533Create_credits_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%credits}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'action' => $this->string(100)->notNull(),
            'model_id' => $this->integer(),
            'model_subject' => $this->string(),
            'credits' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('{{%credits_ibfk_1}}', '{{%credits}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%credits}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170822042533Create_credits_table cannot be reverted.\n";

        return false;
    }
    */
}
