<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/19
 * Time: 16:56
 */

namespace app\controllers;


class CartController extends BaseController{
    public function actionIndex(){
        $this->layout = "lay02";
        return $this->render('index');
    }
}