<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m221106_132910_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'name' => $this->string(255)->notNull(),
            'url' => $this->string(255)->notNull(),
            'type' => $this->string(16)->null(),
            'extension' => $this->string(16)->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB');

        $this->createIndex('files_user_id', 'files', 'user_id');

        $this->addForeignKey(
            'fk_files_user_id',
            'files',
            'user_id',
            'users',
            'id',
            'SET NULL',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
