<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace components;

/**
 * Description of FaqWidget
 *
 * @author Ha Pham
 */

use backend\models\Faq;
use yii\base\Widget;
use yii\data\Pagination;

class FaqWidget extends Widget {
    public $models;
    public $pages;
    public $pageSize;

    public function init() {
        parent::init();
        
        if ($this->pageSize === NULL) {
            $this->pageSize = 2;
        }
        
        $query = Faq::find()->where(['faq_is_featured' => 1]);
        $query->orderBy(['faq_weight' => SORT_ASC]);
        $countQuery = clone $query;
        $this->pages = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $countQuery->count()
        ]);
        $this->models = $query->offset($this->pages->offset)
                ->limit($this->pages->limit)
                ->all();
    }
    
    public function run() {
        return $this->render('faq', [
            'models' => $this->models,
            'pages' => $this->pages,
        ]);
    }
}
