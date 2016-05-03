<?php
/**
 * Created by PhpStorm.
 * User: Ha Pham
 * Date: 10/08/2015
 * Time: 4:28 CH
 */
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>
