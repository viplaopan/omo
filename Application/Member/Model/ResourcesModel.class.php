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
class ResourcesModel extends Model{

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
    );
	/**
     * 上传楼宇 第2步
     * @param  integer $uid 用户ID
     * @return boolean      ture-更新成功，false-更新失败
     */
    public function step1($id){
        //获取提交的数组
        $isEdit = $id ? 1 : 0;
        if($isEdit){
        	$data = $this->create();
            $res = $this->where(array('id' => $id))->save($data);
        }else{
        	$data = $this->create();
			if(session('resourcesStep')<1){
				$data['step'] = 1;
			}
            $res = $this->add($data);
        }
		
        return $res;
	
    }
    /**
     * 上传楼宇 第2步
     * @param  integer $uid 用户ID
     * @return boolean      ture-更新成功，false-更新失败
     */
    public function step2($id){
        //获取提交的多条数据
        D('ResourcesType')->where(array('rid' => $id))->delete();
		$types = I("post.type");
		$data = array();
		foreach($types as $key=>$val){
			$data[$key]['type'] = $val;
			$data[$key]['rid'] = $id;
		}
		D('ResourcesType')->addAll($data);
		
		//把数据添加到资源列表里
//		$data = array();
//      $data[0] = I("post.data1");
//      $data[1] = I("post.data2");
//      $data[2] = I("post.data3");
//      $data[3] = I("post.data4");
//      $data[4] = I("post.data5");
//      $data[5] = I("post.data6");
//		
//		foreach($data as $val){
//			
//			if($val){
//				//获取每个数组
//				foreach ($val as $k => $v) {
//                  $arr[$v['name']] = $v['value'];
//              }
//              $arr['rid'] = $id;
//              D('ResourcesType')->add($arr);
//			}
//			unset($arr);
//		}

        //步骤跳到下一步
        $data = $this->create();
		if(session('resourcesStep')<2){
			$data['step'] = 2;
		}
        $res = $this->where(array('id' => $id))->save($data);
		return $res;
    }
	/**
     * 上传楼宇 第3步
     * @param  integer $uid 用户ID
     * @return boolean      ture-更新成功，false-更新失败
     */
    public function step3($id){
        //楼宇外部图片
		$resourceOutside = I('post.resourceOutside');
		if(!empty($resourceOutside)){
			D('ResourcesImages')->where('rid = ' . $id . ' AND type = 1')->delete();//先删除			
			$inside = array();
			foreach($resourceOutside as $key=>$val){
				$inside[$key]['path'] = $val;
				$inside[$key]['type'] = 1; //1：代表内部图片
				$inside[$key]['rid'] = $id;
			}
			D('ResourcesImages')->addAll($inside);
		}
		//楼宇内部图片
		$resourceInside = I('post.resourceInside');
		if(!empty($resourceInside)){
			D('ResourcesImages')->where('rid = ' . $id . ' AND type = 2')->delete();//先删除			
			$inside = array();
			foreach($resourceInside as $key=>$val){
				$inside[$key]['path'] = $val;
				$inside[$key]['type'] = 2; //1：代表内部图片
				$inside[$key]['rid'] = $id;
			}
			D('ResourcesImages')->addAll($inside);
		}
		//服务设施数据插入
		$services = I('post.service');
		if(!empty($services)){
			D('ResourcesService')->where('rid = ' . $id)->delete();//先删除			
			$ser = array();
			foreach($services as $key=>$val){
				//获取service name
				$serviceTitle = D('Service')->where(array('id =' . $val))->getField('title');
				$ser[$key]['rid'] = $id;
				$ser[$key]['sid'] = $val; //1：代表内部图片
				$ser[$key]['service_name'] = $serviceTitle;
			}
			D('ResourcesService')->addAll($ser);
		}
		
		//更新主表信息
		$data = $this -> create();
		if(session('resourcesStep')<3){
			$data['step'] = 3;
		}
		$res = $this->where(array('id' => $id))->save($data);
		return $res;
		
    }
	/**
     * 上传楼宇 第3步
     * @param  integer $uid 用户ID
     * @return boolean      ture-更新成功，false-更新失败
     */
    public function step4($id){
    	$data = D('ResourcesTraffic')->where('rid = ' .$id)->delete();
    	$data = D('ResourcesTraffic')->create();
		
		$data['rid'] = $id;
		unset($data['id']);
    	D('ResourcesTraffic')->add($data);
		
		//更新主表信息
		$data = $this -> create();
		if(session('resourcesStep')<4){
			$data['step'] = 4;
		}
		$res = $this->where(array('id' => $id))->save($data);
		return $res;
	}
	/**
     * 上传楼宇 第3步
     * @param  integer $uid 用户ID
     * @return boolean      ture-更新成功，false-更新失败
     */
    public function step5($id){
		//更新主表信息
		$data = $this -> create();
		$data['step'] = 5;
		$res = $this->where(array('id' => $id))->save($data);
		return $res;
	}

}
