<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/19
 * Time: 15:43
 */

namespace app\controllers;

class IndexController extends BaseController {

    public function actionIndex(){
        $this->layout = "lay01";
        return $this->render('index');
    }
}