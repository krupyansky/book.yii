<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m201113_130824_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%author}}');
    }
}
