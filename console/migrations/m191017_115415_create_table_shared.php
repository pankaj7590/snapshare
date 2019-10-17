<?php

use yii\db\Migration;

/**
 * Class m191017_115415_create_table_shared
 */
class m191017_115415_create_table_shared extends Migration
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

        $this->createTable('{{%shared}}', [
            'id' => $this->primaryKey(),
			'shared_with' => $this->integer()->notNull(),
			'album_id' => $this->integer(),
			'media_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_shared_shared_with', 'shared', 'shared_with', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_shared_album', 'shared', 'album_id', 'album', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_shared_media', 'shared', 'media_id', 'media', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_shared_user_created_by', 'shared', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_shared_user_updated_by', 'shared', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_115415_create_table_shared cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_115415_create_table_shared cannot be reverted.\n";

        return false;
    }
    */
}
