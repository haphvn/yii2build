<?php

use backend\models\UserType;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model UserType */

$this->title = 'Update User Type: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
