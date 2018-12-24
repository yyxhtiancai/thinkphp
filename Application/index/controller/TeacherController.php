<?php
namespace app\index\controller;
//use think\Db;
use app\common\model\Teacher;
//use think\Controller;
use think\Request;
use think\Validate;
use think\Route;
/**
 * 教师管理
 */
class TeacherController extends ValidateController
{
    /*public function echopr($data){
		echo '<pre>';print_r($data);
	}*/
	
	public function index()
    {
		// 验证用户是否登录
        //$teacherId = session('teacherId');
        
		
		$Request_arr = Request::instance()->get();
        
		try {
			//Route::rule('teacher/:id','index/teacher/index');
			// $Teacher 首写字母大写，说明它是一个对象，更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
			$Teacher = new Teacher; 
			if(!empty($Request_arr)){
				if(!empty($Request_arr['name'])){
					$Teacher->where('name', 'like', '%' .$Request_arr['name']. '%');
				}
			}
			// $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
			$teachers = $Teacher->paginate(1, false, [
                'query'=>$Request_arr,
                ]);
			//echo '<pre>';
			//print_r($teachers);exit;
			// 向V层传数据
			$this->assign('teachers', $teachers);

			// 取回打包后的数据
			$htmls = $this->fetch('index');

			// 将数据返回给用户
        return $htmls;
		} catch (\Exception $e) {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下代码的注释去掉。
            // throw $e;
            return '系统错误' . $e->getMessage();
        }
        // 获取第0个数据
        /*$teacher = $teachers[0];

        // 调用上述对象的getData()方法
        var_dump($teacher->getData('name'));
        echo $teacher->getData('name');
        return $teacher->getData('name');*/
    }
	
	public function insert()
    {
        $message = '';  // 提示信息
		try {
			$postData = Request::instance()->post();    

			// 实例化Teacher空对象
			$Teacher = new Teacher();

			// 为对象赋值
			$Teacher->name = $postData['name'];
			$Teacher->username = $postData['username'];
			$Teacher->sex = $postData['sex'];
			$Teacher->email = $postData['email'];

			// 新增对象至数据表
			$result = $Teacher->validate(true)->save($Teacher->getData());

			// 反馈结果
			if (false === $result)
			{
				$message = '新增失败:' . $Teacher->getError();
			} else {
				return $this->success('新增成功。新增ID为:' . $Teacher->id, 'index');
				
			}
		} catch (\Exception $e) {
            // 发生异常
            $message = $e->getMessage();
        }
		return $this->error($message, 'index');
		/*$validate = new Validate([
			'name'  => 'require|max:25',
			'email' => 'email'
		]);
		$data = [
			'name'  => 'thinkphp',
			'email' => 'thinkphp@qq.com'
		];
		if (!$validate->check($data)) {
			dump($validate->getError());
		}
		exit;
		
		//var_dump($_POST);
		//$post = Request::instance()->filter('htmlspecialchars');
		$postData = Request::instance()->post();;
		//$post = input('post.');
		// 实例化Teacher空对象
        $Teacher = new Teacher();
        
        // 为对象赋值
        $Teacher->name = $postData['name'];
        $Teacher->username = $postData['username'];
        $Teacher->sex = $postData['sex'];
        $Teacher->email = $postData['email'];
		//var_dump($Teacher);exit;
        // 新增对象至数据表
        $Teacher->save();

        // 反馈结果
        return  '新增成功。新增ID为:' . $Teacher->id;*/
		/*var_dump($_POST);exit;
		// 新建测试数据
        $teacher = array(); // 这种写法也可以 $teacher = [];
        $teacher['name'] = '王五';
        $teacher['username'] = 'wangwu';
        $teacher['sex'] = '1';
        $teacher['email'] = 'wangwu@yunzhi.club';
        $Teacher = new Teacher();
        $state = $Teacher->data($teacher)->save();
        var_dump($state);
        // 引用teacher数据表对应的模型
        // 向teacher表中插入数据并判断是否插入成功*/
    }
	
	public function add()
    {
        try {
			$htmls = $this->fetch();
			return $htmls;
		} catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }
	
	 public function delete()
    {
        try {
			//echo $_SERVER['HTTP_REFERER'];exit;
			// 获取pathinfo传入的ID值.
			$id = Request::instance()->param('id/d'); // “/d”表示将数值转化为“整形”

			if (is_null($id) || 0 === $id) {
				return $this->error('未获取到ID信息');
			}

			// 获取要删除的对象
			$Teacher = Teacher::get($id);

			// 要删除的对象不存在
			if (is_null($Teacher)) {
				return $this->error('不存在id为' . $id . '的教师，删除失败');
			}

			// 删除对象
			if (!$Teacher->delete()) {
				return $this->error('删除失败:' . $Teacher->getError());
			}

			// 进行跳转
			return $this->success('删除成功', url('index'));
		} catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
		// 获取要删除的对象
        //$Teacher = Teacher::get(5);
		//is_null($Teacher)?return 
		//if(!is_null($Teacher)){
		//	return $Teacher->delete()?'删除成功':'删除失败';
		//}
		//$Teacher::destory();
		//return '删除失败';
        // 要删除的对象存在
        /*if (!is_null($Teacher)) {
            // 删除对象
            if ($Teacher->delete()) {
                return '删除成功';
            } else {
                return '删除失败';
            }

        // 要删除的对象不存在
        } else {
            return '删除失败';
        }*/
    }
	
	public function edit()
    {
        try {
			$request = Request::instance();
			// 获取传入ID
			$id = $request->param('id/d');
			//var_dump();exit;
			// 在Teacher表模型中获取当前记录
			$Teacher = Teacher::get($id);
			if(!$Teacher){
				return $this->error('系统未找到ID为' . $id . '的记录', url('index'));
			}
			// 将数据传给V层
			$this->assign('Teacher', $Teacher);

			// 获取封装好的V层内容
			$htmls = $this->fetch();

			// 将封装好的V层内容返回给用户
			return $htmls;
			// 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
	
	public function update()
    {
			try {
			// 接收数据
			/*$teacher = Request::instance()->post();
			 // 将数据存入Teacher表
			$Teacher = new Teacher();
			$state = $Teacher->validate(true)->isUpdate(true)->update($teacher);
			// 依据状态定制提示信息
			$state?$this->success('修改成功','index'):$this->error($Teacher->getError(),'index');*/
			$instance = Request::instance();
			$id = $instance->post('id/d');
			// 获取当前对象
			$Teacher = Teacher::get($id);
			if(null !== $Teacher){
				$Teacher->name = $instance->post('name');
				$Teacher->username = $instance->post('username');
				$Teacher->sex = $instance->post('sex/d');
				$Teacher->email = $instance->post('email');
				$result = $Teacher->validate(true)->save();
				if(!$result) return $this->error($Teacher->getError(),'index');
			}else{
				throw new \Exception("所更新的记录不存在", 1);  
			}
		} catch (\think\Exception\HttpResponseException $e) {
            throw $e;
			// 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
		return $this->success('修改成功','index');
    }
}
