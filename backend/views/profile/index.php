<?php

use backend\models\search\ProfileSearch;
use yii\bootstrap\Collapse;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ProfileSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        echo Collapse::widget([
           'items' => [
               [
                   'label'  => 'Search',
                   'content'    =>  $this->render('_search', ['model', $searchModel]),
               ]
           ] 
        ]);
    ?>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            ['attribute' => 'userLink', 'format' => 'raw'],
            ['attribute' => 'profileLink', 'format' => 'raw'],
            'first_name',
            'last_name',
            'birthdate',
            'genderName',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
