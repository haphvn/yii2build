<?php

use common\models\PermissionHelpers;
use frontend\models\Profile;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Profile */

$this->title = $model->user->username . "'s Profile";
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        // this is not necessary but in here example
        if (PermissionHelpers::userMustBeOwner('profile', $model->id)) {
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'first_name:ntext',
            'last_name:ntext',
            'birthdate',
            'gender_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
