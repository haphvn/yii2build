<?php

use backend\models\search\FaqSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel FaqSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
//        echo Collapse::widget([
//           'items' => [
//               [
//                   'label'  => 'Search',
//                   'content'    =>  $this->render('_search', ['model', $searchModel]),
//               ]
//           ] 
//        ]);
    ?>

    <p>
        <?= Html::a('Create Faq', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'faq_question',
            'faq_answer',
            ['attribute' => 'faqCategoryName', 'format' => 'raw'],
             'faq_weight',
            'faq_is_featured',
            ['attribute' => 'Rating', 'value' => function($model){
                return $model->getFaqRatings($model->id);
            }],
//            ['attribute' => 'faqIsFeaturedName', 'format' => 'raw'],
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </span>', $url.'/'.$model->slug);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
