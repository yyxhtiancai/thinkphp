<?php
namespace app\common\validate;
use think\Validate;
use app\common\model\Teacher;
use think\Model;
class Klass extends Model
{
    protected $rule = [
        'name'  => 'require|length:2,25',
        'teacher_id' => 'require',
    ];
}