<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201116_144533_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()
        ]);
        
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'password' => '$2y$13$ALA8H05sXv6Ds9lLZTGt6eKXjd3SuIYfg.lKNhNQ0MZ4wdckH9s16',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->delete('{{%user}}', ['id' => 1]);
        $this->dropTable('{{%user}}');
    }
}
