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
            ['adminuser','required','message'=>'用户名不能为空'],
            ['adminpass','required','message'=>'密码不能为空'],
            ['remember','boolean'],
            ['adminpass','validatePass'],
        ];
    }

    public function validatePass(){
        //如果没有错误则查询数据库
        if(!$this->hasErrors()){
            $data = self::find()->where('adminuser= :user and adminpass = :pass',[':user'=>$this->adminuser,':pass'=>$this->adminpass])->one();
            if(is_null($data)){
                $this->addError('adminpass','用户名或密码错误~');
            }
        }
    }
    public function login($data){
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
}