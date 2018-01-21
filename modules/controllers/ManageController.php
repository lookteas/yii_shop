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
use yii\data\Pagination;

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
    public function actionMailchangepass(){
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
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->changepass($post)){
                Yii::$app->session->setFlash('info','密码修改成功');
                $this->redirect(['public/login']);
            }
        }
        return $this->render('mailchangepass',['model' => $model]);

    }


    /**管理员展示
     * Notes:
     * create_User: tenger
     *
     * @return string
     */
    public function actionManagers(){
        $this->layout = 'lay03';
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manage'];
        $pager = new Pagination(
            [
                'totalCount' => $count,
                'pageSize' => $pageSize,
            ]
        );
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
       return $this->render('managers',['managers' => $managers, 'pager' => $pager]);
    }

    public function actionManageadd(){
        $this->layout = 'lay03';
        $model = new admin;
        //处理提交过来的数据
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //验证数据，并更新

            if($model->userreg($post)){
                Yii::$app->session->addFlash('info','添加成功~');
            } else {
                Yii::$app->session->addFlash('info','添加失败~');
            }
        }
        return $this->render('useradd', ['model' => $model]);

    }
}