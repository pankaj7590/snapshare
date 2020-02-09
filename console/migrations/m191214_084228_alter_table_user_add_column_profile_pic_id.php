<?php

use yii\db\Migration;

/**
 * Class m191214_084228_alter_table_user_add_column_profile_pic_id
 */
class m191214_084228_alter_table_user_add_column_profile_pic_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('user', 'profile_pic_id', $this->integer()->after('id'));
		$this->addForeignKey('fk_user_media_profile_pic', 'user', 'profile_pic_id', 'media', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191214_084228_alter_table_user_add_column_profile_pic_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191214_084228_alter_table_user_add_column_profile_pic_id cannot be reverted.\n";

        return false;
    }
    */
}
