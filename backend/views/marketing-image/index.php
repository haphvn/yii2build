<?php

use backend\models\search\MarketingImageSearch;
use yii\bootstrap\Collapse;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel MarketingImageSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Marketing Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        echo Collapse::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => '<i class="fa fa-caret-square-o-down"></i> Search',
                    'content' => $this->render('_search', ['model' => $searchModel]),
                ],
            ]
        ]);
    ?>
    <p>
        <?= Html::a('Create Marketing Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'marketing_image_path',
            'marketing_image_name',
            'marketing_image_caption_title',
            'marketing_image_caption',
            ['attribute' => 'marketing_image_is_featured', 'format' => 'boolean'],
            ['attribute' => 'marketing_image_is_active', 'format' => 'boolean'],
            'marketing_image_weight',
            'statusName',
            // 'status_id',
            // 'created_at',
            // 'updated_at',
            'thumb:html',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
