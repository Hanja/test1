<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m181012_174819_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book', [
            'name' => $this->primaryKey(),
            'author' => $this->string()->notNull(),
            'year' => $this->integer()->notNull(),
            'genre' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'page' => $this->integer()->notNull(),
        ]);
        $this->alterColumn('book', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
    }
}
