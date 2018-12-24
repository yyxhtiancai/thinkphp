<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Teacher;
class ValidateController extends Controller
{
	public function __construct(){
		parent::__construct();
		if (!Teacher::islogin())
        {
            return $this->error('plz login first', url('Login/index'));
        }
	}
}