<?php

use yii\db\Migration;

/**
 * Class m191017_113839_alter_table_user_add_columns
 */
class m191017_113839_alter_table_user_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('user', 'slug', 'varchar(255) after username');
		$this->addColumn('user', 'is_admin_approved', 'smallint after email');
		$this->addColumn('user', 'created_by', 'integer after status');
		$this->addColumn('user', 'updated_by', 'integer after created_by');
		
		$this->addForeignKey('fk_user_user_created_by', 'user', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_user_user_updated_by', 'user', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_113839_alter_table_user_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_113839_alter_table_user_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
