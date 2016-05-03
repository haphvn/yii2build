<?php

use backend\models\MarketingImage;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model MarketingImage */

$this->title = 'Create Marketing Image';
$this->params['breadcrumbs'][] = ['label' => 'Marketing Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
