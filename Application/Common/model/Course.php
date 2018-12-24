<?php
namespace app\common\model;
use think\Model;
class Course extends Model
{
	public function Klasses()
    {
        //echo '<pre>';
		//print_r($this->belongsToMany('Klass',  config('database.prefix') . 'klass_course'));exit;
		return $this->belongsToMany('Klass',  config('database.prefix') . 'klass_course','course_id');
    }
	
}