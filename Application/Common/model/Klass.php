<?php
namespace app\common\model;
use think\Model;
class Klass extends Model
{
	private $Teacher;
	
	/**
     * 获取对应的教师（辅导员）信息
     * @return Teacher 教师
     * @author panjie <panjie@yunzhiclub.com>
     */
    public function getTeacher()
    {
        if(is_null($this->Teacher)){
			$teacherId = $this->getData('teacher_id');
			$this->Teacher = Teacher::get($teacherId);
		}
		return $this->Teacher;
    }
	
	/**
     * 获取对应的教师（辅导员）信息
     * @return Teacher 教师
     * @author <panjie@yunzhiclub.com> http://www.mengyunzhi.com
     */
    public function Teacher()
    {
        //echo '<pre>';
		//print_r($this->belongsTo('teacher'));exit;
		return $this->belongsTo('teacher');
    }
}