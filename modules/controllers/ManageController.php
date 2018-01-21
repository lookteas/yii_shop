<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 23:36
 */

namespace app\modules\controllers;
use app\modules\models\Admin;
use Yii;

class ManageController extends BaseController{

    public function actionIndex(){
        return $this->render('mailchangepass');
    }

    /**
     * Notes:修改密码邮件通知
     * create_User: tenger
     *
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionMailChange(){
        return $this->render('mailchangepass');
//        return $this->render('mailchangepass',['model' => $model]);
        $time = Yii::$app->request->get('timestamp');   //获取时间
        $adminuser = Yii::$app->request->get('adminuser');  //获取用户名
        $token = Yii::$app->request->get('token');  //获取秘钥
        $model = new Admin();
        //创建用户对应的token
        $mytoken = $model->createToken($adminuser,$time);

        //秘钥不相等，不能继续操作
        if($token != $mytoken){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        //如果超时，也不能操作
        if(time() - $time > 300){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }

        $model->adminuser = $adminuser;

    }
}