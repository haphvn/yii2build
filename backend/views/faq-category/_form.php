<?php

use backend\models\FaqCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model FaqCategory */
/* @var $form ActiveForm */
?>

<div class="faq-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faq_category_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'faq_category_weight')->textInput() ?>

    <?= $form->field($model, 'faq_category_is_featured')->dropDownList($model->faqCategoryIsFeaturedList, ['prompt' => 'Please choose one']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
