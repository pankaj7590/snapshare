<?php
use yii\db\Migration;
use common\models\enums\UserRoles;

/**
 * Class m191214_073546_create_roles
 */
class m191214_073546_create_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$auth = Yii::$app->authManager;
		foreach(UserRoles::$roles as $role){
			$author = $auth->createRole($role);
			$auth->add($author);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191214_073546_create_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191214_073546_create_roles cannot be reverted.\n";

        return false;
    }
    */
}
