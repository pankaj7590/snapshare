<?php

use yii\db\Migration;

/**
 * Class m191020_175627_alter_table_album_add_column_cover_image_alter_table_media_remove_column_is_cover
 */
class m191020_175627_alter_table_album_add_column_cover_image_alter_table_media_remove_column_is_cover extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('album', 'cover_image_id', 'integer after id');
		$this->addForeignKey('fk_album_media', 'album', 'cover_image_id', 'media', 'id', 'SET NULL', 'SET NULL');
		
		$this->dropColumn('media', 'is_cover');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191020_175627_alter_table_album_add_column_cover_image_alter_table_media_remove_column_is_cover cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_175627_alter_table_album_add_column_cover_image_alter_table_media_remove_column_is_cover cannot be reverted.\n";

        return false;
    }
    */
}
