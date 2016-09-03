<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Buseness\Model;
use Think\Model;
use User\Api\UserApi;

/**
 * 文档基础模型
 */
class ResourcesPositionModel extends Model{

    /* 用户模型自动完成 */
    protected $_auto = array(
    	array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('start_time', 'getTime', self::MODEL_BOTH, 'function'),
        array('end_time', 'getTime', self::MODEL_BOTH, 'function'),
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
    );
}
