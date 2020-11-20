<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m201118_104441_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'name' => $this->string(),
            'note' => $this->text()->notNull(),
            'phone' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%order}}');
    }
}
