<?php

use backend\models\search\UserSearch;
use yii\bootstrap\Collapse;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel UserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>';print_r($this); die;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        echo Collapse::widget([
           'items' => [
               [
                   'label'  => 'Search',
                   'content'    =>  $this->render('_search', ['model' => $searchModel]),
               ]
           ] 
        ]);
    ?>
    
    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['attribute' => 'userIdLink', 'format' => 'raw'],
            ['attribute' => 'userLink', 'format' => 'raw'],
            ['attribute' => 'profileLink', 'format' => 'raw'],
            
             'email:email',
             'roleName',
             'statusName',
             'userTypeName',
             'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
