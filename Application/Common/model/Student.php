<?php
namespace app\common\model;
use think\Model;    // 使用前进行声明
/**
 * Student 学生表
 */
class Student extends Model
{
    protected $dateFormat = 'Y年m月d日'; 
	
	
	public function Klass()
    {
        return $this->belongsTo('Klass');
    }
	
	/**
     * 自定义自转换字换
     * @var array
     */
    protected $type = [
        'create_time' => 'datetime',
    ];
	
	public function getSexAttr($value)
    {
        $status = [0=>'男',1=>'女'];
        return isset($status[$value])?$status[$value]:'';
    }
	
	public function getCreatetimeAttr($value)
    {
        return $value!==0?date('Y-m-d H:i:s', $value):'错误';
    }
	
	
}