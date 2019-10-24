<?php

use yii\db\Migration;

/**
 * Class m191024_030713_create_table_user_invitation_user_contact_and_invitation
 */
class m191024_030713_create_table_user_invitation_user_contact_and_invitation extends Migration
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

        $this->createTable('{{%user_invitation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'email' => $this->string()->notNull()->unique(),
			'invitation_token' => $this->string()->unique(),
            'is_accepted' => $this->smallInteger()->defaultValue(0),
            
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_user_invitation_user', 'user_invitation', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');



        $this->createTable('{{%user_contact}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull(),
            
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_user_contact_user', 'user_contact', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_user_contact_user_contact', 'user_contact', 'contact_id', 'user', 'id', 'CASCADE', 'CASCADE');
		
		
		
        $this->createTable('{{%invitation}}', [
            'id' => $this->primaryKey(),
            'user_invitation_id' => $this->integer()->notNull(),
            'album_id' => $this->integer(),
            'media_id' => $this->integer(),
            
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_invitation_user_invitation', 'invitation', 'user_invitation_id', 'user_invitation', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_invitation_album', 'invitation', 'album_id', 'album', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_invitation_media', 'invitation', 'media_id', 'media', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191024_030713_create_table_user_invitation_user_contact_and_invitation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191024_030713_create_table_user_invitation_user_contact_and_invitation cannot be reverted.\n";

        return false;
    }
    */
}
