<?php
/**
 * Created by PhpStorm.
 * User: Ha Pham
 * Date: 10/08/2015
 * Time: 4:20 CH
 */

namespace frontend\models;

use yii\base\Model;

class EntryFrom extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}