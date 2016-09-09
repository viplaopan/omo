<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;
/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends Controller {

	//网站首页
    public function index(){
        if(IS_POST){
            $data = I("post.data");
            dump($data);
            $userinfo = array(
                array('name'=>'zhang'),
                array('name'=>'hang')
            );
            echo json_encode($userinfo);
            die;
        }

        $this->display();
    }
    public function help(){
        $this->display();
    }
    public function clause(){
        $this->display();
    }
    public function abuout(){
        $this->display();
    }
}