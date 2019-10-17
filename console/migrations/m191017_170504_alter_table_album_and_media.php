<?php

use yii\db\Migration;

/**
 * Class m191017_170504_alter_table_album_and_media
 */
class m191017_170504_alter_table_album_and_media extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->dropColumn('album', 'link_shared');
		$this->addColumn('album', 'is_link_shared', 'smallint default 0 after id');
		$this->addColumn('media', 'album_id', 'integer after id');
		
		$this->addForeignKey('fk_media_album', 'media', 'album_id', 'album', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_170504_alter_table_album_and_media cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_170504_alter_table_album_and_media cannot be reverted.\n";

        return false;
    }
    */
}
