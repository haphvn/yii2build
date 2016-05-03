<?php

use backend\models\Role;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Role */

$this->title = 'Update Role: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
