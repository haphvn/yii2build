<?php

use backend\models\MarketingImage;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model MarketingImage */
/* @var $form ActiveForm */
?>

<div class="marketing-image-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php // $form->field($model, 'marketing_image_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketing_image_name')->textInput(['maxlength' => 45]) ?>
    
    <?= $form->field($model, 'marketing_image_caption_title') ?>

    <?= $form->field($model, 'marketing_image_caption') ?>

    <?= $form->field($model, 'marketing_image_is_featured')->dropDownList($model->marketingImageIsFeaturedList, ['prompt' => 'Please Choose One']) ?>

    <?= $form->field($model, 'marketing_image_is_active')->dropDownList($model->marketingImageIsActiveList, ['prompt' => 'Please Choose One']) ?>

    <?= $form->field($model, 'marketing_image_weight') ?>

    <?= $form->field($model, 'status_id')->dropDownList($model->statusList) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
