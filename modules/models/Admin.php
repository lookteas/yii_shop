<?php
/**
 * Created by PhpStorm.
 * User: Tenger
 * Date: 2018/1/20
 * Time: 18:07
 */

namespace app\modules\models;

use Yii;

class Admin extends Base{
    public $remember = true;

    /**
     * Notes:
     * create_User: tenger
     *
     * @return string
     */
    public static function tableName(){
        return "{{%admin}}" ;
}

    public function rules(){
        return [
            ['adminuser','required','message'=>'用户名不能为空', 'on'=>['login','seekpass']],
            ['adminpass','required','message'=>'密码不能为空', 'on'=>['login']],
            ['remember','boolean', 'on'=>['login']],
            ['adminpass','validatePass', 'on'=>['login']],
            ['adminemail','required','message'=>'邮箱不能为空', 'on'=>['seekpass']],
            ['adminemail','email','message'=>'邮箱格式不正确', 'on'=>['seekpass']],
            ['adminemail','validateEmail', 'on'=>['seekpass']],
        ];
    }

    /**
     * Notes:用户密码验证
     * create_User: tenger
     */
    public function validatePass(){
        //如果没有错误则查询数据库
        if(!$this->hasErrors()){
            $data = self::find()->where('adminuser= :user and adminpass = :pass',[':user'=>$this->adminuser,':pass'=>$this->adminpass])->one();
            if(is_null($data)){
                $this->addError('adminpass','用户名或密码错误~');
            }
        }
    }

    /**
     * Notes:邮箱验证
     * create_User: tenger
     */
    public function validateEmail(){
        if(!$this->getErrors()){
            $data = self::find()->where('adminuser= :user and adminemail = :email',[':user'=>$this->adminuser,':email'=>$this->adminemail])->one();
            if(is_null($data)){
                $this->addError('adminemail','用户邮箱不一致~');
            }
        }
    }

    /**
     * Notes:用户登录验证
     * create_User: tenger
     * @param $data
     *
     * @return bool
     */
    public function login($data){
        $this->scenario = 'login';
        if($this->load($data) && $this->validate()){
            //判断是否有选中的登录状态
            $lifetime = $this->remember ? 86400 : 0;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin'] = [
                'adminuser' => $this->adminuser,
                'isLogin' => 1,
            ];

            //更新操作
            $this->updateAll([
                'logintime' => time(),
                'loginip' => ip2long(Yii::$app->request->userIP),
            ], 'adminuser = :user',[':user'=> $this->adminuser]);
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }

    /**
     * Notes:修改密码时邮件通知
     * create_User: tenger
     * @param $data
     *
     * @return bool
     */
    public function seekpass($data){
        $this->scenario = 'seekpass';
        if($this->load($data) && $this->validate()){
            //创建秘钥
            $time = time();
            $token = $this->createToken($data['Admin']['adminuser'],$time);
            //发送邮件
            $mailer = Yii::$app->mailer->compose('seekpass', [
                'adminuser'=>$data['Admin']['adminuser'],
                'time'=> $time,
                'token'=> $token,
            ]);
            $mailer->setFrom('tenger35@163.com');
            $mailer->setTo('tenger05@163.com');
            $mailer->setSubject('yii商城找回密码');
            if($mailer->send()){
                Yii::$app->getSession()->setFlash('success', '邮件发送成功');
                return true;
            }
        }
        return false;
    }

    /**
     * Notes:创建用户秘钥
     * create_User: tenger
     * @param $adminuser
     * @param $time
     *
     * @return string
     */
    public function createToken($adminuser, $time)
    {
        return md5(md5($adminuser).base64_encode(Yii::$app->request->userIP).md5($time));
        //md5(md5(用户名)+base64(登录ip)+md5(时间戳))
    }



}