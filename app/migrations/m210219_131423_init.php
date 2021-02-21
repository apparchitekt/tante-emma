<?php

use yii\db\Migration;

/**
 * Class m210219_131423_init
 */
class m210219_131423_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('entries', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'stores' => $this->text(),
            'week' => $this->integer(24),
            'link' => $this->string(255),
            'images' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210219_131423_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210219_131423_init cannot be reverted.\n";

        return false;
    }
    */
}
