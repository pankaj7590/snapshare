<?php

use yii\db\Migration;

/**
 * Class m191017_105632_create_table_album
 */
class m191017_105632_create_table_album extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%album}}', [
            'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'slug' => $this->string()->notNull(),
            'link_shared' => $this->smallInteger()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_album_user_created_by', 'album', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_album_user_updated_by', 'album', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_105632_create_table_album cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_105632_create_table_album cannot be reverted.\n";

        return false;
    }
    */
}
