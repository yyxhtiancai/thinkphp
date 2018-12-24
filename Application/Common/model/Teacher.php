<?php
namespace app\common\model;
use think\Model;
use think\Request;
class Teacher extends Model
{
    public function index()
    {
		return 'Teacher Model';
	}
	
	 /**
     * 用户登录
     * @param  string $username 用户名
     * @param  string $password 密码
     * @return bool  成功返回true，失败返回false。
     */
    static public function login($username, $password)
    {
        //var_dump($this);exit;
		$Teacher = self::get(['username'=>$username]);
		//var_dump($Teacher);exit;
		if(!is_null($Teacher) && $Teacher->checkPassword($password)){//$Teacher->getData('password')===$password
			session('teacherId', $Teacher->getData('id'));
			return true;
		}
		return false;
	}
	
	/**
     * 验证密码是否正确
     * @param  string $password 密码
     * @return bool           
     */
    public function checkPassword($password)
    {
        if($this->getData('password')===self::encryptPassword($password)){
			return true;
		}else{
			return false;
		}
    }
	
	/**
     * 注销
     * @return bool  成功true，失败false。
     * @author panjie
     */
    static public function logOut()
    {
        // 销毁session中数据
        session('teacherId', null);
        return true;
    }
	
	/**
     * 密码加密算法
     * @param    string                   $password 加密前密码
     * @return   string                             加密后密码
     * @author panjie@yunzhiclub.com http://www.mengyunzhi.com
     * @DateTime 2016-10-21T09:26:18+0800
     */
    private static function encryptPassword($password)
    {   
        // 实际的过程中，我还还可以借助其它字符串算法，来实现不同的加密。
        if(!is_string($password)){
			throw new \RuntimeException("传入变量类型非字符串，错误码2", 2);
		}
		return sha1(md5($password));
    }
	
	public static function islogin(){
		return session('teacherId')?true:false;
	}
}