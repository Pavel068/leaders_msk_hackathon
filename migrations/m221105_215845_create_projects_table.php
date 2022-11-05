<?php

use app\helpers\Status;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m221105_215845_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500)->notNull(),
            'description' => $this->text()->null(),
            'price' => $this->float()->null(),
            'location_text' => $this->string(255)->notNull(),
            'latitude' => $this->float()->null(),
            'longitude' => $this->float()->null(),
            'moderator_status' => $this->string(16)->null(),
            'moderator_status_setter_id' => $this->integer()->null(),
            'citizen_status' => $this->string(16)->null(),
            'citizen_status_setter_id' => $this->integer()->null(),
            'created_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
            'updated_at' => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB');

        $this->createIndex('projects_moderator_status_setter_id', 'projects', 'moderator_status_setter_id');
        $this->createIndex('projects_citizen_status_setter_id', 'projects', 'citizen_status_setter_id');

        $this->addForeignKey(
            'fk_projects_moderator_status_setter_id',
            'projects',
            'moderator_status_setter_id',
            'users',
            'id',
            'SET NULL',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk_projects_citizen_status_setter_id',
            'projects',
            'citizen_status_setter_id',
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
        $this->dropTable('{{%projects}}');
    }
}
