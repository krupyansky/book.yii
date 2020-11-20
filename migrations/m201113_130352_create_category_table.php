<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m201113_130352_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parentID' => $this->integer()->defaultValue(0)->notNull(),
            'title' => $this->string()->notNull(),
        ]);

        $this->insert('{{%category}}', [
            'parentID' => 0,
            'title' => 'Новинки',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->delete('{{%category}}', ['id' => 1]);
        $this->dropTable('{{%category}}');
    }
}
