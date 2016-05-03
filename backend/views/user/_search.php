<?php

use backend\models\search\UserSearch;
use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model UserSearch */
/* @var $form ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'role_id')->dropDownList(User::getroleList(), ['prompt' => 'Please Choose One']); ?>

    <?php echo $form->field($model, 'status_id')->dropDownList(User::getuserTypeList(), ['prompt' => 'Please Choose One']); ?>

    <?php echo $form->field($model, 'user_type_id')->dropDownList($model->statusList, ['prompt' => 'Please Choose One']); ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
