<?php

use yii\debug\models\search\Profile;
use yii\web\Controller;

namespace frontend\controllers;

class UpgradeController extends Controller
{
    public function actionIndex()
    {
        $name = Profile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        return $this->render('index', ['name' => $name]);
    }

}
