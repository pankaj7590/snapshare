<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\InvitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invitations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invitation-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create Invitation', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'user_invitation_id',
                'album_id',
                'media_id',
                'status',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
