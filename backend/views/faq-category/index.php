<?php

use backend\models\search\FaqCategorySearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel FaqCategorySearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Faq Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
//        echo Collapse::widget([
//           'items' => [
//               [
//                   'label'  => 'Search',
//                   'content'    =>  $this->render('_search', ['model', $searchModel]),
//               ],
//            ] 
//        ]);
    ?>
    
    <p>
        <?= Html::a('Create Faq Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'faq_category_name',
            'faq_category_weight',
            'faq_category_is_featured',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
