<?php

use backend\models\FaqCategory;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model FaqCategory */

$this->title = 'Update Faq Category: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faq Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faq-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
