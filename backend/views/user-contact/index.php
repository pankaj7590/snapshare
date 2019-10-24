<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-contact-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create User Contact', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'contact_id',
                'status',
                'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
