<?php

use backend\models\UserType;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model UserType */
/* @var $form ActiveForm */
?>

<div class="user-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
