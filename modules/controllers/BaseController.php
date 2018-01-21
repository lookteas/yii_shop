<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 17:27
 */

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;

class BaseController extends Controller{
    public $layout = false;

    /**
     * Notes:添加页面提示信息,存放与session中
     * create_User: tenger
     * @param $key
     * @param $value
     */
    public function setTips($key, $value){
        Yii::$app->session->setFlash($key, $value);
    }
}