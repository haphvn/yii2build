<?php

use backend\models\Faq;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Faq */
/* @var $form ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faq_question')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'faq_answer')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'faq_category_id')->textInput() ?>

    <?= $form->field($model, 'faq_is_featured')->dropDownList($model->faqIsFeaturedList, ['prompt' => 'Please choose one']) ?>

    <?= $form->field($model, 'faq_weight')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
