<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 17:21
 */

namespace app\modules\controllers;

use app\modules\models\Admin;

class PublicController extends BaseController{
    public function actionLogin(){
        $admin = new Admin();
        return $this->render('login',['model'=>$admin]);
    }
}