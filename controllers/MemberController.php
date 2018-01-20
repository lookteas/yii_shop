<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/19
 * Time: 17:27
 */

namespace app\controllers;


class MemberController extends BaseController{
    public function actionAuth(){
        $this->layout = "lay02";
        return $this->render('auth');
    }
}