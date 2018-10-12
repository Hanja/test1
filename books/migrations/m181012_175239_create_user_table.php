<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181012_175239_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'role' => $this->string()->defaultValue('user'),
        ]);
        $this->alterColumn('user', 'id', $this->integer().' NOT NULL AUTO_INCREMENT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
