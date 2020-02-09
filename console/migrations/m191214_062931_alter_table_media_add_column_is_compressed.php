<?php

use yii\db\Migration;

/**
 * Class m191214_062931_alter_table_media_add_column_is_compressed
 */
class m191214_062931_alter_table_media_add_column_is_compressed extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('media', 'is_compressed', $this->smallInteger()->after('link_shared')->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191214_062931_alter_table_media_add_column_is_compressed cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191214_062931_alter_table_media_add_column_is_compressed cannot be reverted.\n";

        return false;
    }
    */
}
