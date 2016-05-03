<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestController
 *
 * @author Ha Pham
 */

namespace frontend\controllers;

class TestController extends \yii\web\Controller {
    public function actionIndex() {
//        return $this->render('index');
        \Yii::$app->mycomponent->blastOff();
    }
}
