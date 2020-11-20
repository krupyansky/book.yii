<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m201113_120404_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'isbn' => $this->string()->notNull()->unique(),
            'pageCount' => $this->integer()->defaultValue(0),
            'publishedDate' => $this->dateTime(),
            'thumbnailUrl' => $this->string(),
            'shortDescription' => $this->text(),
            'longDescription' => $this->text(),
            'status' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%book}}');
    }
}
