<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_book}}`.
 */
class m201118_104451_create_order_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%order_book}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'qty' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%order_book}}');
    }
}
