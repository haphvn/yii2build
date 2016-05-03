<?php

use backend\models\Status;
use yii\helpers\Html;
use yii\web\View;


/* @var $this View */
/* @var $model Status */

$this->title = 'Create Status';
$this->params['breadcrumbs'][] = ['label' => 'Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
