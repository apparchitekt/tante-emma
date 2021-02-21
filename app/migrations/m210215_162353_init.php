<?php

use yii\db\Migration;

/**
 * Class m210215_162353_init
 */
class m210215_162353_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(55),
            'password' => $this->string(255),
            'auth_key' => $this->string(255),
            'access_token' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
        $this->dropTable('entries');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210215_162353_init cannot be reverted.\n";

        return false;
    }
    */
}
