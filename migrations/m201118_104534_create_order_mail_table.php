<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_mail}}`.
 */
class m201118_104534_create_order_mail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%order_mail}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%order_mail}}');
    }
}
