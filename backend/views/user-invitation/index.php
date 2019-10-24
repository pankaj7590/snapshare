<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserInvitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Invitations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invitation-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create User Invitation', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'user_id',
                'email:email',
                'invitation_token',
                'is_accepted',
                // 'status',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
