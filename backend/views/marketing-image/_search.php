<?php

use backend\models\search\MarketingImageSearch;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model MarketingImageSearch */
/* @var $form ActiveForm */
?>

<div class="marketing-image-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    
    <?= $form->field($model, 'marketing_image_caption_title') ?>

    <?= $form->field($model, 'marketing_image_path') ?>

    <?= $form->field($model, 'marketing_image_name') ?>

    <?= $form->field($model, 'marketing_image_caption') ?>

    <?= $form->field($model, 'marketing_image_is_featured') ?>

    <?php // echo $form->field($model, 'marketing_image_is_active') ?>

    <?php // echo $form->field($model, 'marketing_image_weight') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
