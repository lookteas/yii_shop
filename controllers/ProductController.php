<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/19
 * Time: 16:04
 */

namespace app\controllers;


class ProductController extends BaseController{
    public function actionIndex(){
        $this->layout = "lay02";
        return $this->render('index');
    }

    public function actionDetail(){
        $this->layout = "lay02";
        return $this->render('detail');
    }
}