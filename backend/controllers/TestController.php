<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use backend\models\search\FaqSearch;
use backend\models\Faq;
use yii\data\Pagination;

/**
 * Description of TestController
 *
 * @author Ha Pham
 */
class TestController extends \yii\web\Controller {
    public function behaviors() {
        return [
            'verbs' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ]
        ];
    }
    
    public function actionIndex() {
//        $searchModel = new FaqSearch();
//        
//        $provider = $searchModel->featuredProvider();
//        
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'provider' => $provider,
//        ]);
        $query = Faq::find()->where(['faq_is_featured' => 1]);
        $query->orderBy(['faq_weight' => SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $countQuery->count()
        ]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages
        ]);
    }
}
