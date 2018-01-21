<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 17:21
 */

namespace app\modules\controllers;

use app\modules\models\Admin;
use Yii;
class PublicController extends BaseController{
    /**
     * Notes:用户登录
     * create_User: tenger
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionLogin(){
        $admin = new Admin();
        //判断是否有post提交
            if(Yii::$app->request->isPost){
                //接收post参数
                $post = Yii::$app->request->post();
                if($admin->login($post)){

                    $this->redirect(['index/index']);
                    Yii::$app->end();
                }

            }
        return $this->render('login',['model'=>$admin]);
    }

    /**
     * Notes:用户注销
     * create_User: tenger
     * @throws \yii\base\ExitException
     */
    public function actionLogout(){
        Yii::$app->session->removeAll();
        if(Yii::$app->session['admin']['isLogin']){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        $this->goBack();
    }

    public function actionSeekpassword(){
        $admin = new Admin();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $admin->seekpass($post);
        }
        return $this->render('seekpsw',['model'=>$admin]);
    }
}