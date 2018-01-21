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
     * Notes:后台管理员修改密码
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

        //如果已经登录状态
        if(!(Yii::$app->session['adminuser'])){

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

        }

        $model->adminuser = $adminuser;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->changepass($post)){
                $this->setTips('info','密码修改成功');
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

    /**
     * Notes:添加后台管理员
     * create_User: tenger
     *
     * @return string
     */
    public function actionManageadd(){
        $this->layout = 'lay03';
        $model = new Admin();
        //处理提交过来的数据
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            //验证数据，并更新

            if($model->userreg($post)){
                $this->setTips('success','添加成功~');
            } else {
                $this->setTips('error','添加失败~');
            }
        }
        return $this->render('useradd', ['model' => $model]);

    }

    /**
     * Notes:删除后台管理员
     * create_User: tenger
     */
    public function actionDeluser(){
        //接收相关参数
        $admin_id = (int)Yii::$app->request->get('adminid');
        if(empty($admin_id)){
            $this->redirect(['manage/managers']);
        }
        //删除对应管理员
        $model = new Admin();
        if($model->deleteAll('adminid = :id', [':id' => $admin_id])){
            $this->setTips('success', '删除成功~');
            $this->redirect(['manage/managers']);
        }else{
            $this->setTips('error', '删除失败~');
        }
    }

    public function actionChangemail(){
        $this->layout = 'lay03';
        $model = Admin::find()->where('adminuser = :user', [':user' => Yii::$app->session['admin']['adminuser']])->one();

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->changemail($post)){
                $this->setTips('success','修改成功~');
            }else{
                $this->setTips('error','修改失败~');
            }
        }

        $model->adminpass = '';
        return $this->render('changemail',['model' => $model]);
    }

}