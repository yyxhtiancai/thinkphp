<?php
namespace app\common\validate;
use think\Validate;
use app\common\model\Teacher;
use think\Model;
class KlassCourse extends Validate
{
    protected $rule = [
        'klass_id'  => 'require',
        'course_id' => 'require'
    ];
}