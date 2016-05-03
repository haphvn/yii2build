<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Featured Questions</h3>
        </div>
        
        <?php
//            $data = $provider->getModels();
//            $questions = ArrayHelper::map($data, 'faq_question', 'id');
//            foreach ($questions as $question => $id) {
//                $url = Url::to(['faq/view', 'id' => $id]);
//                $options = [];
//                echo '<div class="panel-body">'.Html::a($question, $url, $options).'</div>';
//            }
            foreach ($models as $model) {
                $url = Url::to(['faq/view', 'id' => $model->id]);
                $options = [];
                echo '<div class="panel-body">'.Html::a($model->faq_question, $url, $options).'</div>';
            }
            
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
    </div>

</div>
