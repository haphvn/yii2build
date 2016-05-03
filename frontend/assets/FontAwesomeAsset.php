<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\assets;

/**
 * Description of FontAwesomeAsset
 *
 * @author Ha Pham
 */

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle {
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    
    public $css = [
        'css/font-awesome.min.css',
    ];
    
    public function init() {
        $this->publishOptions = [
            'forceCopy' => YII_DEBUG,
            'beforeCopy' => __NAMESPACE__.'\FontAwesomeAsset::filterFolders'
        ];
                
        parent::init();
    }
    
    public static function filterFolders($from, $to)
    {
        $validFilesAndFolders = [
            'css',
            'fonts',
            'font-awesome.css',
            'font-awesome.min.css',
            'FontAwesome.otf',
            'fontawesome-webfont.eot',
            'fontawesome-webfont.svg',
            'fontawesome-webfont.ttf',
            'fontawesome-webfont.woff',
        ];
        
        $pathItems = array_reverse(explode(DIRECTORY_SEPARATOR, $from));
        
        if (in_array($pathItems[0], $validFilesAndFolders)) {
            return true;
        } else {
            return false;
        }
    }
}
