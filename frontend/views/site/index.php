<?php

use yii\authclient\widgets\AuthChoice;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
        if (Yii::$app->user->isGuest) {
            echo AuthChoice::widget([
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => false,
            ]);
        }
        ?>
        <h1>Yii 2 Start <i class="fa fa-plug"></i> </h1><br />

        <?php
        if (!Yii::$app->user->isGuest) {
            echo '<p class="lead">Use this  Yii 2  Template to start  Projects.</p>';
        } else {
            echo '<h4>' . Html::a('<i class="fa fa-facebook"></i> Sign Up or Sign In', ['auth', 'authclient' => 'facebook'], ['class' => 'btn btn-primary']) . '</h4>';
        }
        ?>
        <br/>
    </div>

    <!--    --><?//= FaqWidget::widget(); ?>

</div>
