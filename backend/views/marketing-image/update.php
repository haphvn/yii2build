<?php

use backend\models\MarketingImage;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model MarketingImage */

$this->title = 'Update Marketing Image: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marketing Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="marketing-image-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <br>
    
    <div>
        <?php
            echo Html::img('/'.$model->marketing_image_path . '?' . 'time=' . time(), ['width' => '600px']);
        ?>
    </div>
    
    <br>
    
    <div>
        <?php
            echo Html::img('/'.$model->marketing_thumb_path . '?' . 'time=' . time());
        ?>
    </div>
    
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
