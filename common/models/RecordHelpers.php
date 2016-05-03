<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecordHelpers
 *
 * @author Ha Pham
 */

namespace common\models;

use Yii;

class RecordHelpers {

    public static function userHas($model_name) {
        $connection = Yii::$app->db;

        $userid = Yii::$app->user->identity->id;
        $sql = "select id from $model_name where user_id=:userid";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $result = $command->queryOne();

        if ($result == null) {
            return false;
        } else {
            return $result['id'];
        }
    }

    public static function getMessageSubject($id)
    {
        // to do code here
    }
}
