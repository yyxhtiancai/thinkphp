<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;
class LoginController extends Controller
{
    // 用户登录表单
    public function index()
    {
        return $this->fetch();
    }

	// 注销
    public function logOut()
    {
        if (Teacher::logOut()) {
            return $this->success('logout success', url('index'));
        } else {
            return $this->error('logout error', url('index'));
        }
    }

    // 处理用户提交的登录数据
    public function login()
    {
        // 接收post信息
        $postData = Request::instance()->post();
		if ($postData && Teacher::login($postData['username'],$postData['password'])) {
			// 用户名密码正确，将teacherId存session。
			return $this->success('login success', url('Teacher/index'));
		}
		return $this->error('password or name incrrect', url('index'));
        // 验证用户名是否存在
       // $map = array('username'  => $postData['username']);
        //$Teacher = Teacher::get($map)->getData();
		//echo '<pre>';/
		//print_r($Teacher);exit;
		//if(Teacher::login()){
			
		//}
        // $Teacher要么是一个对象，要么是null。
		//$user_data = $Teacher->getData();
		//echo '<pre>';
		//print_r($user);exit;
	   /*if (!is_null($Teacher) && $user_data['password'] === md5($postData['password'])) {
			// 用户名密码正确，将teacherId存session。
			session('teacherId', $user_data['id']);
			return $this->success('login success', url('Teacher/index'));
			// 用户名密码错误，跳转到登录界面。
			
		}
		return $this->error('password or name incrrect', url('index'));*/
	   /*if (!is_null($Teacher)) {
            $user_data = $Teacher->getData();
			//echo '<pre>';
			//print_r($Teacher);exit;
			// 验证密码是否正确
            if ($user_data['password'] !== md5($postData['password'])) {
                // 用户名密码错误，跳转到登录界面。
                return $this->error('password incrrect', url('index'));
            } else {
                // 用户名密码正确，将teacherId存session。
                session('teacherId', $user_data['id']);
                return $this->success('login success', url('Teacher/index'));
            }
            
        } else {
            // 用户名不存在，跳转到登录界面。
            return $this->error('username or password wrong', url('index'));
        }*/
    }
}