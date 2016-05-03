<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model User */
/* @var $form ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->dropDownList($model->roleList, ['prompt' => 'Please Choose One']); ?>

    <?= $form->field($model, 'status_id')->dropDownList($model->statusList, ['prompt' => 'Please Choose One']); ?>

    <?= $form->field($model, 'user_type_id')->dropDownList($model->userTypeList, ['prompt' => 'Please Choose One']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
