<?php

namespace yuncms\credit\migrations;

use yii\db\Migration;

/**
 * Class M170822043347Add_credit_field
 */
class M170822043347Add_credit_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_extend}}', 'credits', $this->integer()->unsigned()->defaultValue(0)->comment('积分'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_extend}}', 'credits');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170822043347Add_credit_field cannot be reverted.\n";

        return false;
    }
    */
}
