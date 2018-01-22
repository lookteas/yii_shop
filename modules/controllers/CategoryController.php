<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/22
 * Time: 17:41
 */

namespace app\modules\controllers;


use app\controllers\BaseController;
use Yii as Y;
class CategoryController extends BaseController{

    public $layout = 'lay03';
    public function actionList(){
        return $this->render('list');
    }

    public function actionAdd(){
        return $this->render('add');
    }
}