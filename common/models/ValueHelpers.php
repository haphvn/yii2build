<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValueHelpers
 *
 * @author Ha Pham
 */

namespace common\models;

use backend\models\Role;
use backend\models\Status;
use common\models\User;
use Yii;

class ValueHelpers {

    public static function roleMatch($role_name) {
        $userHasRoleName = Yii::$app->user->identity->role->role_name;
        return $userHasRoleName == $role_name ? true : false;
    }

    public static function getUsersRoleValue($userId = null) {
        if ($userId == null) {
            $userRoleValue = Yii::$app->user->identity->role->role_value;
            return isset($userRoleValue) ? $userRoleValue : false;
        } else {
            $user = User::findOne($userId);
            $userRoleValue = $user->role->role_value;
            return isset($userRoleValue) ? $userRoleValue : false;
        }
    }

    public static function getRoleValue($role_name) {
        $role = Role::find('role_value')
                ->where(['role_name' => $role_name])
                ->one();
        return isset($role->role_value) ? $role->role_value : false;
    }

    public static function isRoleNameValid($role_name) {
        $role = Role::find('role_name')
                ->where(['role_name' => $role_name])
                ->one();
        return isset($role->role_name) ? $role->role_name : false;
    }

    public static function statusMatch($status_name) {
        $userHasStatusName = Yii::$app->user->identity->status->status_name;
        return $userHasStatusName == $status_name ? true : false;
    }

    public static function getStatusId($status_name) {
        $status = Status::find('id')
                ->where(['status_name' => $status_name])
                ->one();
        return isset($status->id) ? $status->id : false;
    }

    public static function userTypeMatch($user_type_name) {
        $userHasUserTypeName = Yii::$app->user->identity->userType->user_type_name;
        return $userHasUserTypeName == $user_type_name ? true : false;
    }

}
