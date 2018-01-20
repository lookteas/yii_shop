<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/19
 * Time: 17:01
 */

namespace app\controllers;


class OrderController extends BaseController{

    public function actionIndex(){
        $this->layout = "lay02";
       return $this->render('index');
    }

    public function actionCheck(){
        $this->layout = "lay02";
        return $this->render('check');
    }
}