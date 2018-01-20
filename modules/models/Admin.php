<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 18:07
 */

namespace app\modules\models;


class Admin extends Base{
    public $remember = true;

    public static function tableName(){
        return "{{%admin}}" ;
}

    public function dologin(){}
}