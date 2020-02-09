<?php

use yii\db\Migration;

/**
 * Class m200208_073745_alter_table_user_add_column_disk_quota
 */
class m200208_073745_alter_table_user_add_column_disk_quota extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('user', 'disk_quota', 'integer default 5 after email');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200208_073745_alter_table_user_add_column_disk_quota cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200208_073745_alter_table_user_add_column_disk_quota cannot be reverted.\n";

        return false;
    }
    */
}
